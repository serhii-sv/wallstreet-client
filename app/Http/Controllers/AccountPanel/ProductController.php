<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Wallet;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products = new Product();
        if (\request()->sort) {
            $products = $products->orderBy('price', \request()->sort == 'price_highest_first' ? 'desc' : 'asc' );
        }

        if (\request()->title) {
            $products = $products->where('title', 'like', '%'  . \request()->title . '%');
        }

        $products = $products->where('active', 1)->paginate(12);

        return view('accountPanel.products.index', [
            'products' => $products
        ]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($slug)
    {
        return view('accountPanel.products.show', [
            'product' => Product::findBySlug($slug)
        ]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function buy($slug)
    {
        return view('accountPanel.products.buy', [
            'product' => Product::findBySlug($slug)
        ]);
    }

    public function pay(Request $request, $id)
    {
        $request->validate([
            'currency_id' => 'required'
        ], [
            'currency_id.required' => 'Выберите валюту для оплаты'
        ]);

        $user = auth()->user();

        $product = Product::findOrFail($id);

        $wallet = $user->wallets()->where('currency_id', $request->currency_id)->first();

        $usdCurrency = Currency::where('code', 'USD')->first();

        $amountInSelectedCurrency = (new Wallet())->convertToCurrency(Currency::find($request->currency_id), $usdCurrency, $product->price);

        if ($amountInSelectedCurrency > $wallet->balance) {
            return redirect()->back()->with('error', 'Недостаточно средств для покупки!');
        }

        if ($product->in_stock == 0) {
            return redirect()->back()->with('error', 'Продукт закончился и недоступен к покупке!');
        }

        if($wallet->removeAmount($amountInSelectedCurrency)) {
            $user->userProducts()->attach($product->id);
            $product->in_stock -=1;
            $product->save();

            return redirect()->route('accountPanel.products.index')->with('short_success', 'Продукт успешно преобретен!');
        }

        return redirect()->back()->with('error', 'Ошибка! Попробуйте позже');
    }
}
