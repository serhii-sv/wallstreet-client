<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class IsoController extends Controller
{
    //
    public function index() {
        $timestamp = 1650931200;
        $diff_from_now = Carbon::parse($timestamp)->diffInDays();
        return view('accountPanel.ico.index', [
            'diff_from_now' => $diff_from_now,
        ]);
    }
}
