<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ShopController extends Controller
{
    //
    public function index() {
        $timestamp = 1641042061;
        $distance = $timestamp - Carbon::now()->timestamp;
        $days = floor($distance / ( 60 * 60 * 24)) < 0 ? 0 : floor($distance / (60 * 60 * 24));
        $hours = floor(($distance % (60 * 60 * 24)) / (60 * 60)) < 0 ? 0 : floor(($distance % (60 * 60 * 24)) / (60 * 60));
        $minutes = floor(($distance % (60 * 60)) / 60) < 0 ? 0 : floor(($distance % (60 * 60)) / 60);
        $seconds = floor($distance % 60) < 0 ? 0 : floor($distance % 60);

        return view('accountPanel.shop.index', [
            'diff_from_now_days' => $days,
            'diff_from_now_time' => str_pad($hours,2,'0',STR_PAD_LEFT) . ':'. str_pad($minutes,2,'0',STR_PAD_LEFT) . ':' . str_pad($seconds,2,'0',STR_PAD_LEFT),
            'timestamp' => $timestamp,
        ]);
    }
}
