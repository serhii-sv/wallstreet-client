<?php

namespace App\Http\Controllers\AccountPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    
    public function index() {
        return view('accountPanel.calendar.index',[
        
        ]);
    }
}
