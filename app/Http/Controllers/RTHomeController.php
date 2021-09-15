<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RTHomeController extends Controller
{
    public function home(){

        
        $countWarga=100;
        $countSurat=100;
        $countKeluarga=100;
        $widget=[
            "countWarga"=>$countWarga,
            "countSurat"=>$countSurat,
            "countKeluarga"=>$countKeluarga,
        ];

        return view('rt.dashboard.home')->with(compact('widget'));
    }
}
