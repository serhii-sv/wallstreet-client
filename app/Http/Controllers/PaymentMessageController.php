<?php

namespace App\Http\Controllers;

use App\Models\PaymentSystem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PaymentMessageController extends BaseController
{
    public function message(Request $request, $status='ok')
    {
        if ($status == 'ok') {
            session()->flash('success', "Баланс успешно обновлен");
        } elseif ($status == 'error') {
            session()->flash('error', "Баланс не обновлен");
        }
        $payment_systems = PaymentSystem::where('code', '!=', 'bonus')->get();
        return view('accountPanel.replenishment.index',[
            'payment_systems' => $payment_systems,
        ]);
    }
}
