<?php
namespace App\Http\Controllers\Payment;

use App\Models\Currency;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

/**
 * Class FreeKassaController
 * @package App\Http\Controllers\Payment
 */
class FreeKassaController extends Controller
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

        $i = session('buy.i');

        if (empty($paymentSystem) || empty($currency)) {
            session()->flash('error', 'ЗАпрос не может быть обработан');
            return back();
        }

        $amount = abs(session('topup.amount'));

        /** @var User $user */
        $user = auth()->user();

        /** @var Wallet $wallet */
        $wallet = $user->wallets()->where([
            ['currency_id', $currency->id],
        ])->first();

        if (empty($wallet)) {
            $wallet = Wallet::newWallet($user, $currency);
        }

        $transaction = Transaction::enter($wallet, $amount, $paymentSystem->id);

        if (null === $transaction) {
            return redirect()->route('account.topup')->with('error', "Трпнзакия не найдена");
        }

        $transaction->source = preg_replace('/[^0-9]/', '', $transaction->id);
        $transaction->save();

        $merchantId   = env('FREEKASSA_MERCHANT_ID');
        $orderId      = $transaction->source;
        $amount       = round($amount, 2);
        $currencyCode = $currency->code;
        $memo         = env('FREEKASSA_MEMO');

        // Forming an array for signature generation
        $signature = md5($merchantId.':'.$amount.':'.env('FREEKASSA_MERCHANT_KEY').':RUB:'.$orderId);

        return view('accountPanel.ps.freekassa', [
            'currency'   => $currencyCode,
            'amount'     => $amount,
            'user'       => $user,
            'wallet'     => $wallet,
            'merchantId' => $merchantId,
            'comment'    => $memo,
            'orderId'  => $orderId,
            'signature'  => $signature,
            'i'          => $i,
        ]);
    }

    public static function getIP() {
        if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     * @throws \Exception
     */
    public function status(Request $request)
    {
        $merchant_id = env('FREEKASSA_MERCHANT_ID');
        $merchant_secret = env('FREEKASSA_MERCHANT_KEY');

        // if (!in_array(self::getIP(), array('136.243.38.147', '136.243.38.149', '136.243.38.150', '136.243.38.151', '136.243.38.189', '88.198.88.98'))) {
        //     \Log::info('Not correct IP from FreeKassa');
        //     die("hacking attempt!");
        // }

        $sign = md5($_REQUEST['MERCHANT_ID'].':'.$_REQUEST['AMOUNT'].':'.$merchant_secret.':'.$_REQUEST['MERCHANT_ORDER_ID']);

        if ($sign != $_REQUEST['SIGN']) {
            \Log::error('Wrong sign from FreeKassa');
            die('wrong sign');
        }

        /** @var Transaction $transaction */
        $transaction = Transaction::where('source', strtolower($_REQUEST['MERCHANT_ORDER_ID']))
            ->where('approved', 0)
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->first();

        if (null == $transaction) {
            \Log::error('Bad request from: '.$request->ip().'. Transaction is not found. Entire request is: '.print_r($request->all(),true));
            return response('ok');
        }

        /** @var PaymentSystem $paymentSystem */
        $paymentSystem = $transaction->paymentSystem;

        /** @var Currency $currency */
        $currency      = $transaction->currency;

        if (null == $currency) {
            \Log::error('FreeKassa. Bad request from: '.$request->ip().'. Currency not found. Entire request is: '.print_r($request->all(),true));
            return response('ok');
        }

        if ((float) $_REQUEST['AMOUNT'] < $transaction->amount) {
            \Log::error('FreeKassa. Bad request from: '.$request->ip().'. Amount is not the same with transaction. Entire request is: '.print_r($request->all(),true));
            return response('ok');
        }

        if ($transaction->result != 'success') {
            $transaction->batch_id = $_REQUEST['intid'];
            $transaction->result = 'success';
            $transaction->source = '';
            $transaction->save();
            $commission = $transaction->amount * 0.01 * $transaction->commission;

            $transaction->wallet->refill(($transaction->amount - $commission));
            $transaction->update(['approved' => true]);
            return response('ok');
        }

        \Log::error('FreeKassa hash is not passed. IP: ' . $request->ip());
        return response('ok');
    }
}
