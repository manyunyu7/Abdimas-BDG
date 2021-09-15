<?php

namespace App\Http\Controllers;

use App\Models\RukunTetangga;
use App\Models\RukunWarga;
use Illuminate\Http\Request;

class MyAuthController extends Controller
{
    
    function viewRegisterKK(){

        $getRT = RukunTetangga::all();

        $rt = array();
        foreach ($getRT as $key) {
            $rw = RukunWarga::find($key->id_rw);
            $rt[]=[
                "id_rt" => $key->id,
                "kode_rt" => $key->kode,
                "kontak" => $key->kontak,
                "id_rw" => $rw->id, 
                "kode_rw" => $rw->kode,
            ];
        }

        return view('auth.registrasi_kepala_keluarga')->with(compact('rt'));
        

    }


}
