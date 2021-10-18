<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestTopup;
use App\Models\PaymentSystem;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class TopupController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paymentSystems = PaymentSystem::with('currencies')->get();
        $enter_commission = TransactionType::getByName('enter')->commission;
     
        return view('accountPanel.replenishment.topup',[
            'paymentSystems' => $paymentSystems,
            'enter_commission' => $enter_commission,
        ]);
    }

    /**
     * @param RequestTopup $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(RequestTopup $request)
    {
        $extractCurrency = explode(':', $request->currency);

        if (count($extractCurrency) != 1) {
            return back()->with('error', __('Unable to read data from request'))->withInput();
        }

        $paymentSystem = PaymentSystem::where('id', $extractCurrency[0])->first();

        if (empty($paymentSystem)) {
            return back()->with('error', __('Undefined payment system'))->withInput();
        }

        $currency = $paymentSystem->currencies()->where('id', $extractCurrency[1])->first();

        if (empty($currency)) {
            return back()->with('error', __('Undefined currency'))->withInput();
        }

        $psMinimumTopupArray = @json_decode($paymentSystem->minimum_topup, true);
        $psMinimumTopup      = isset($psMinimumTopupArray[$currency->code])
            ? $psMinimumTopupArray[$currency->code]
            : 0;

        if ($request->amount < $psMinimumTopup) {
            return back()->with('error', __('Minimum balance recharge is ').$psMinimumTopup.$currency->symbol)->withInput();
        }

        session()->flash('topup.payment_system', $paymentSystem);
        session()->flash('topup.currency', $currency);
        session()->flash('topup.amount', $request->amount);
        return redirect()->route('accountPanel.topup.' . $paymentSystem->code);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function paymentMessage(Request $request)
    {
        if ($request->has('result') && $request->result == 'ok') {
            session()->flash('success', __('Balance successfully updated'));
        } elseif ($request->has('result') && $request->result == 'error') {
            session()->flash('error', __('Can not update your balance'));
        }

        return view('profile.topup');
    }
}
