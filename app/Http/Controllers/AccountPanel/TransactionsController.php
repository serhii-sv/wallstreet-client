<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;


class TransactionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $type=null) {
        $user = Auth::user();
        $transaction_types = TransactionType::whereNotIn('name', [
            'penalty',
        ])
            ->orderByDesc('created_at')
            ->get();
        $transactions = Transaction::where('user_id', $user->id)->when($type, function ($query) use ($type){
            return $query->where('type_id', $type);
        })->with('type', 'currency')->orderByDesc('created_at')->paginate(10);
        $transactions_count = Transaction::where('user_id', $user->id)->when($type, function ($query) use ($type){
            return $query->where('type_id', $type);
        })->count();
        return view('accountPanel.transactions.index',[
            'transactions' => $transactions,
            'type' => $type,
            'transactions_count' => $transactions_count,
            'transaction_types' => $transaction_types,
        ]);
    }


}
