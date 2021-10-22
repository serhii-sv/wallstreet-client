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
            session()->flash('success', __('Balance successfully updated'));
        } elseif ($status == 'error') {
            session()->flash('error', __('Can not update your balance'));
        }
        $payment_systems = PaymentSystem::all();
        return view('accountPanel.replenishment.index',[
            'payment_systems' => $payment_systems,
        ]);
    }
}
