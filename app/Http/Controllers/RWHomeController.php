<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RWHomeController extends Controller
{
    public function home(){
        return view('rw.dashboard.home');
    }
}
