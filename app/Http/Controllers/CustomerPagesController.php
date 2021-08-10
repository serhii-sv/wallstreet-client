<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CustomerPagesController extends Controller
{
    public function aboutUs()
    {
        return view('customer.aboutus');
    }

    public function agreement()
    {
        return view('customer.agreement');
    }

    public function contacts()
    {
        return view('customer.contact');
    }

    public function documents()
    {
        return view('customer.documents');
    }

    public function faq()
    {
        return view('customer.faq');
    }

    public function investors()
    {
        return view('customer.investors');
    }

    public function homepage() {
        return view('customer.main');
    }

    public function partners()
    {
        return view('customer.partners');
    }

    public function payout()
    {
        return view('customer.payout');
    }

    public function reviews()
    {
        return view('customer.reviews');
    }
}
