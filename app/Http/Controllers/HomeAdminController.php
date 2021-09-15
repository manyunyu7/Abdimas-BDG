<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Mutabaah;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeAdminController extends Controller
{
    public function index(){

        $widget= [
        ];
        return view('admin.dashboard.home')->with(compact('widget'));
    }

    function viewChangePassword()
    {
        return view('admin.change_password');
    }

    function changePassword( Request $request)
    {
        $user_id = $request->id;
        $this->validate($request, [
            'new_password' => 'required|min:6',
            'old_password' => 'required|min:6'
        ]);
        $user = Admin::findOrFail($user_id);
        $hasher = app('hash');

        //If Password Sesuai
        if (!$hasher->check($request->old_password, $user->password)) {
            return back()->with(["error" => "Password Lama Tidak Sesuai"]);
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();
            if ($user) {
                return back()->with(["success" => "Password Berhasil Diperbarui"]);
            } else {
                return back()->with(["error" => "Password Gagal Diperbarui"]);
            }
        }
    }
}
