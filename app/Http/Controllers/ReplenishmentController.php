<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestTopup;
use App\Models\Currency;
use App\Models\PaymentSystem;
use Illuminate\Http\Request;

class ReplenishmentController extends Controller
{
    //
    public function index() {
        $payment_systems = PaymentSystem::where('code', '!=', 'bonus')->get();
        //  $currencies = Currency::all();
        return view('accountPanel.replenishment.index', [
            'payment_systems' => $payment_systems,
        ]);
    }

    public function handle(RequestTopup $request) {
        $paymentSystemId = $request->get('payment_system');
        $currencyId = $request->get('currency');
        //$extractCurrency = explode(':', $request->currency);

        /*if (count($extractCurrency) != 1) {
            return back()->with('error', __('Unable to read data from request'))->withInput();
        }*/

        //$paymentSystem = PaymentSystem::where('id', $extractCurrency[0])->first();
        $paymentSystem = PaymentSystem::where('id', $paymentSystemId)->first();

        if (empty($paymentSystem)) {
            return back()->with('error', __('Undefined payment system'))->withInput();
        }
        if ($currencyId) {
            $currency = Currency::where('id', $currencyId)->first();
        } else{
          if ($paymentSystem->code == 'perfectmoney') {
              $currency = Currency::where('code', 'USD')->first();
          }
          if ($paymentSystem->code == 'visa_mastercard') {
              $currency = Currency::where('code', 'RUB')->first();
          }
        }

        if (empty($currency)) {
            return back()->with('error', "Неизвестная валюта")->withInput();
        }

        $psMinimumTopupArray = @json_decode($paymentSystem->minimum_topup, true);
        $psMinimumTopup = isset($psMinimumTopupArray[$currency->code]) ? $psMinimumTopupArray[$currency->code] : 0;

        if ($request->amount < $psMinimumTopup) {
            return back()->with('error', "Минимальная сумма пополнения баланса составляет" . $psMinimumTopup . $currency->symbol)->withInput();
        }

        session()->flash('topup.payment_system', $paymentSystem);
        session()->flash('topup.currency', $currency);
        session()->flash('topup.amount', $request->amount);
        return redirect()->route('accountPanel.topup.' . $paymentSystem->code);
    }

    public function newRequest(Request $request) {
        $request->validate(
            [
                'currency' => 'uuid',
                'payment_system' => 'required|uuid',
            ],
            [
                'currency.uuid' => 'Поле :attribute должно быть действительного UUID',
                'payment_system.required' => 'Поле :attribute обязательно',
                'payment_system.uuid' => 'Поле :attribute должно быть действительного UUID',
            ]
        );
        $currency = Currency::where('id', $request->get('currency'))->first();
        $payment_system = PaymentSystem::where('id', $request->get('payment_system'))->first();
        if ($currency === null) {
            return redirect()->back()->with('error', 'Валюта не найдена!');
        }
        if ($payment_system === null) {
            return redirect()->back()->with('error', 'Платёжная система не найдена!');
        }
        if ($payment_system->code == 'perfectmoney') {
            echo 'Perfect money api';
        } else if ($payment_system->code == 'coinpayments') {
            echo 'coinpayments api';
        } else {
            return redirect()->route('accountPanel.replenishment.manual');
        }
    }

    public function manual($id = null) {
        return view('accountPanel.replenishment.manual', [
            'paymentSystem' => PaymentSystem::whereId($id)->first(),
        ]);
    }

    public function getPaySystemCurrencies(Request $request) {
        if ($request->ajax()) {
            $payment_system_id = $request->get('payment_system_id');
            $payment_system = PaymentSystem::find($payment_system_id);
            if ($payment_system !== null) {
                $currencies = $payment_system->currencies()->get();
                if ($currencies === null) {
                    return json_encode([
                        'status' => 'bad',
                        'html' => 'Выберите платежную ситему',
                    ]);
                }
                foreach ($currencies as $currency) {
                    $html[] = '<label class="d-flex flex-column align-items-center justify-content-center currency-wrapper-item">
                        <input class="payment-system-radio" type="radio" name="currency" value="{{ $item->id }}" required>
                        <div class=" payment-system-item d-flex flex-column align-items-center justify-content-center">
                          <img src="' . asset("accountPanel/images/logos/" . $currency->image) . '" alt="' . $currency->image_alt . '" title="' . $currency->image_title . '">
                          <span>' . $currency->name . '</span>
                        </div>
                      </label>';;
                }

                return json_encode([
                    'status' => 'good',
                    'html' => $html,
                ]);
            } else {
                return json_encode([
                    'status' => 'bad',
                    'html' => 'Выберите платежную ситему',
                ]);
            }
        }
        return json_encode([
            'status' => 'bad',
            'html' => 'Выберите платежную ситему',
        ]);
    }
}
