<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CalendarController extends Controller
{
    
    public function index() {
        $period = $this->getMonthPeriod();
        //
        $type_withdraw = TransactionType::where('name', 'withdraw')->first();
        $type_partner = TransactionType::where('name', 'partner')->first();
        $type_dividend = TransactionType::where('name', 'dividend')->first();
        $type_bonus = TransactionType::where('name', 'bonus')->first();
        $type_transfer_in = TransactionType::where('name', 'transfer_in')->first();
        //
        $transactions = Transaction::where('user_id', Auth::user()->id)->where('approved', '=', 1)->whereNotNull('payment_system_id')->where(function ($query) use ($type_withdraw, $type_partner, $type_dividend, $type_bonus, $type_transfer_in) {
            $query->orWhere('type_id', $type_withdraw->id)->orWhere('type_id', $type_partner->id)->orWhere('type_id', $type_dividend->id)->orWhere('type_id', $type_bonus->id)->orWhere('type_id', $type_transfer_in->id);
        })->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now(),
        ])->get();
       
        $withdraws = [];
        $partners = [];
        $bonuses = [];
        $dividends = [];
        $transfers = [];
        foreach ($period as $key => $day) {
            if ($transactions->where('type_id', $type_withdraw->id)->where('created_at', '>', $day['start'])->where('created_at', '<', $day['end'])->count() > 0) {
                $withdraws[$day['start']->format('Y-m-d H:i:s')] = $transactions->where('type_id', $type_withdraw->id)->where('created_at', '>', $day['start'])->where('created_at', '<', $day['end']);
            }
            if ($transactions->where('type_id', $type_partner->id)->where('created_at', '>', $day['start'])->where('created_at', '<', $day['end'])->count() > 0) {
                $partners[$day['start']->format('Y-m-d H:i:s')] = $transactions->where('type_id', $type_partner->id)->where('created_at', '>', $day['start'])->where('created_at', '<', $day['end']);
            }
            if ($transactions->where('type_id', $type_dividend->id)->where('created_at', '>', $day['start'])->where('created_at', '<', $day['end'])->count() > 0) {
                $dividends[$day['start']->format('Y-m-d H:i:s')] = $transactions->where('type_id', $type_dividend->id)->where('created_at', '>', $day['start'])->where('created_at', '<', $day['end']);
            }
            if ($transactions->where('type_id', $type_bonus->id)->where('created_at', '>', $day['start'])->where('created_at', '<', $day['end'])->count() > 0) {
                $bonuses[$day['start']->format('Y-m-d H:i:s')] = $transactions->where('type_id', $type_bonus->id)->where('created_at', '>', $day['start'])->where('created_at', '<', $day['end']);
            }
            if ($transactions->where('type_id', $type_transfer_in->id)->where('created_at', '>', $day['start'])->where('created_at', '<', $day['end'])->count() > 0) {
                $transfers[$day['start']->format('Y-m-d H:i:s')] = $transactions->where('type_id', $type_transfer_in->id)->where('created_at', '>', $day['start'])->where('created_at', '<', $day['end']);
            }
        }
        return view('accountPanel.calendar.index', [
            'partners' => $partners,
            'bonuses' => $bonuses,
            'dividends' => $dividends,
            'transfers' => $transfers,
            'withdraws' => $withdraws,
        ]);
    }
    
    public function getMonthPeriod() {
        $period = [];
        $current_week_count = now()->daysInMonth;
        for ($i = 0; $i < $current_week_count; $i++) {
            if (now()->startOfMonth()->addDay($i) < now()) {
                if (now()->startOfMonth()->addDay($i) < now()->startOfMonth()) {
                    $period[$i]['start'] = now()->startOfMonth();
                } else {
                    $period[$i]['start'] = now()->startOfMonth()->addDay($i);
                }
                if (now()->startOfMonth()->addDay($i) > now()) {
                    $period[$i]['end'] = now();
                } else {
                    $period[$i]['end'] = now()->startOfMonth()->addDay($i)->endOfDay();
                }
            }
        }
        return $period;
    }
}
