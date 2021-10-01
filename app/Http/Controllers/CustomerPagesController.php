<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Language;
use App\Models\News;
use App\Models\Rate;
use App\Models\RateGroup;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CustomerPagesController extends Controller
{
    public function aboutUs() {
        //$texts = Storage::disk('lang')->exists($lang . '.json') ? json_decode(Storage::disk('lang')->get($lang . '.json'), true) : [];
        return view('customer.aboutus');
    }
    
    public function agreement() {
        return view('customer.agreement');
    }
    
    public function contacts() {
        return view('customer.contact');
    }
    
    public function documents() {
        return view('customer.documents');
    }
    
    public function faq() {
        $lang_code = session()->get('lang');
        if ($lang_code !== null) {
            $lang = Language::where('code', $lang_code)->first();
        } else {
            $lang = Language::where('default', true)->first();
        }
        if ($lang !== null) {
            $faqs = Faq::where('language_id', $lang->id)->get();
        } else {
            $faqs = null;
        }
        return view('customer.faq', [
            'faqs' => $faqs,
        ]);
    }
    
    public function investors() {
        return view('customer.investors');
    }
    
    public function homepage() {
        $rate_groups = RateGroup::all();
        $rates = Rate::all();
        return view('customer.main', [
            'rate_groups' => $rate_groups,
            'rates' => $rates,
        ]);
    }
    
    public function partners() {
        return view('customer.partners');
    }
    
    public function payout() {
        return view('customer.payout');
    }
    
    public function reviews() {
        return view('customer.reviews');
    }
    
    public function news($id = null) {
        if ($id) {
            return view('customer.news.show', [
                'news' => News::where('id', $id)->firstOrFail(),
            ]);
        } else {
            return view('customer.news.index', [
                'news' => News::paginate(9),
            ]);
        }
    }
}
