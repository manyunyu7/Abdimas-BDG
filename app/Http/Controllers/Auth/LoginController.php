<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Keluarga;
use App\Models\RukunTetangga;
use App\Models\RukunWarga;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function checkLogin(Request $request)
    {

        $isKeluarga = Keluarga::where('kontak', '=', $request->uname)->count();
        $isRT = RukunTetangga::where('kontak', '=', $request->uname)->count();
        $isRW = RukunWarga::where('kontak', '=', $request->uname)->count();
        $isAdmin = Admin::where('contact', '=', $request->uname)->count();

        if ($isKeluarga > 0) {
            return $this->keluargaLogin($request);
        } else if ($isRT > 0) {
            return $this->rtLogin($request);
        } else if($isRW > 0){
            return $this->rwLogin($request);
        } 
        else if ($isAdmin > 0) {
            return $this->adminLogin($request);
        }  else {
            return back()->with(["error" => "Akun tidak ditemukan"]);
        }
    }


    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'uname'   => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(
            [
                'contact' => $request->uname,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {
            return redirect()->intended('/admin');
        } else {
            return redirect('login')->withErrors([
                'error' => 'Username Atau Password Salah (Admin)'
            ]);
        }

        return back()->withInput($request->only('uname', 'remember'));
    }

    public function keluargaLogin(Request $request)
    {
        $this->validate($request, [
            'uname'   => 'required|numeric',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('keluarga')->attempt(
            [
                'kontak' => $request->uname,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {
            return redirect()->intended('/keluarga')->with(["success" => "Login Berhasil"]);
        } else {
            return redirect('/login')->withErrors([
                'error' => 'Username Atau Password Salah'
            ]);
        }

        return redirect('/login')->withInput($request->only('uname', 'password'));
    }


    public function rtLogin(Request $request)
    {
        $this->validate($request, [
            'uname'   => 'required|numeric',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('erte')->attempt(
            [
                'kontak' => $request->uname,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {
            return redirect()->intended('/rt')->with(["success" => "Login Berhasil"]);
        } else {
            return redirect('/login')->withErrors([
                'error' => 'Username Atau Password Salah'
            ]);
        }

        return redirect('/login')->withInput($request->only('uname', 'password'));
    }

    public function rwLogin(Request $request){

        $this->validate($request, [
            'uname'   => 'required|numeric',
            'password' => 'required|min:6'
        ]);

        if(Auth::guard('erwe')->attempt(
            [
            'kontak' => $request->uname,
            'password' => $request->password
            ],
            $request->get('remember')
        )) {
            return redirect()->intended('/rw')->with(["success" => "Login Berhasil"]);
        } else {
            return redirect('/login')->withErrors([
                'error' => 'Username Atau Password Salah'
            ]);
        }

        return redirect('/login')->withInput($request->only('uname','password'));
    }
}
