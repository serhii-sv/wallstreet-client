<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\PaymentSystem;
use Illuminate\Http\Request;

class ReplenishmentController extends Controller
{
    //
    public function index() {
        $payment_systems = PaymentSystem::all();
        $currencies = Currency::all();
        return view('accountPanel.replenishment.index', [
            'payment_systems' => $payment_systems,
            'currencies' => $currencies,
        ]);
    }
    
    public function newRequest(Request $request) {
        $request->validate([
            'currency' => 'required|uuid',
            'payment_system' => 'required|uuid',
        ]);
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
    
    public function manual() {
        
        return view('accountPanel.replenishment.manual');
    }
}
