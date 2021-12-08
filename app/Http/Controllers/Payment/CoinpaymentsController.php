<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Modules\PaymentSystems\CoinpaymentsModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class CoinpaymentsController
 * @package App\Http\Controllers\Payment
 */
class CoinpaymentsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function topUp()
    {
        /** @var PaymentSystem $paymentSystem */
        $paymentSystem = session('topup.payment_system');

        /** @var Currency $currency */
        $currency = session('topup.currency');

        if (empty($paymentSystem) || empty($currency)) {
            return redirect()->route('accountPanel.replenishment')->with('error', 'Нельзя обработать ваш запрос, попробуйте еще раз.');
        }

        $amount = abs(session('topup.amount'));
        $user          = Auth::user();
        $wallet        = $user->wallets()->where([
            ['currency_id', $currency->id],
//            ['payment_system_id', $paymentSystem->id],
        ])->first();

        if (empty($wallet)) {
            $wallet = Wallet::newWallet($user, $currency);
        }

        $transaction    = Transaction::enter($wallet, $amount, $paymentSystem->id);

        try {
            $topupTransaction = CoinpaymentsModule::createTopupTransaction($transaction);
        } catch (\Exception $e) {
            return redirect()->route('accountPanel.replenishment')->with('error', $e->getMessage());
        }

        return view('accountPanel.ps.coinpayments', [
            'currency'       => $currency,
            'transaction'    => $transaction,
            'user'           => $user,
            'wallet'         => $wallet,
            'paymentSystem'  => $paymentSystem,
            'receiveAddress' => $topupTransaction['address'],
            'confirmsNeeded' => $topupTransaction['confirms_needed'],
            'timeout'        => $topupTransaction['timeout'],
            'buyerStatusUrl' => $topupTransaction['status_url'],
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function status(Request $request)
    {
        $merchant_id = config('money.coinpayments_merchant_id');
        $secret      = config('money.coinpayments_ipn_secret');

        if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
            \Log::info('Coinpayments. Strange request from: '.$request->ip().', No HMAC signature sent. '.print_r($request->all(),true));
            return response('ok');
        }

        $merchant = $request->has('merchant') ? $request->merchant : '';

        if (empty($merchant)) {
            \Log::info('Coinpayments. Strange request from: '.$request->ip().', No Merchant ID passed. '.print_r($request->all(),true));
            return response('ok');
        }

        if ($merchant != $merchant_id) {
            \Log::info('Coinpayments. Strange request from: '.$request->ip().', Invalid Merchant ID. '.print_r($request->all(),true));
            return response('ok');
        }

        $rawRequest = file_get_contents('php://input');

        if ($rawRequest === FALSE || empty($rawRequest)) {
            \Log::info('Coinpayments. Strange request from: '.$request->ip().', Error reading POST data. '.print_r($request->all(),true));
            return response('ok');
        }

        $hmac = hash_hmac("sha512", $rawRequest, $secret);

        if ($hmac != $_SERVER['HTTP_HMAC']) {
            \Log::info('Coinpayments. Strange request from: '.$request->ip().', HMAC signature does not match. '.print_r($request->all(),true));
            return response('ok');
        }

        if (!$request->has('amount1') ||
            !$request->has('currency1') ||
            !$request->has('status') ||
            !$request->has('txn_id') ||
            !$request->has('invoice')) {
            \Log::info('Coinpayments. Strange request from: '.$request->ip().'. Entire request is: '.print_r($request->all(),true));
            return response('ok');
        }

        /** @var PaymentSystem $paymentSystem */
        $paymentSystem = PaymentSystem::where('code', 'coinpayments')->first();
        /** @var Currency $currency */
        $currency      = Currency::where('code', strtoupper($request->currency1))->first();

        if (null == $currency) {
            \Log::info('Strange request from: '.$request->ip().'. Currency not found. Entire request is: '.print_r($request->all(),true));
            return response('ok');
        }

        /** @var Transaction $transaction */
        $transaction = Transaction::where('id', $request->invoice)
            ->where('currency_id', $currency->id)
            ->where('payment_system_id', $paymentSystem->id)
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->first();

        if (null === $transaction) {
            \Log::info('Strange request from: '.$request->ip().'. Transaction not found. Entire request is: '.print_r($request->all(),true));
            return response('ok');
        }

        if ($transaction->result != 'complete' && $request->status >= 100 && $request->status_text == 'Complete') {
            $transaction->batch_id = $request->txn_id;
            $transaction->result = 'complete';
            $transaction->source = '';
            $transaction->save();
            $commission = $transaction->amount * 0.01 * $transaction->commission;

            $transaction->wallet->refill(($transaction->amount-$commission));
            $transaction->update(['approved' => true]);
            CoinpaymentsModule::getBalances(); // обновляем баланс нашего внешнего кошелька в БД
            return response('ok');
        }

        \Log::info('Coinpayments transaction is not passed. IP: '.$request->ip().'. '.print_r($request->all(),true));
        return response('ok');
    }
}
