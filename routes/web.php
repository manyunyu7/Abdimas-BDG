<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

include __DIR__.'/user_rt.php';
include __DIR__.'/user_rw.php';
include __DIR__.'/user_admin.php';
include __DIR__.'/user_keluarga.php';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();


Route::redirect('/','/login');

Route::view('login/admin','auth.login_admin');
Route::view('login','auth.login')->middleware('myauth');

Route::get('registrasi/keluarga','MyAuthController@viewRegisterKK');
Route::post('registrasi/kepala-keluarga/proceed','KeluargaController@keluargaRegister');

Route::post('/login/proc', 'Auth\LoginController@checkLogin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('keluarga/{id}/buat-surat-pengajuan', 'SuratController@viewKeluargaCreate');
Route::get('surat/buat-pengajuan', 'SuratController@viewCreate');
Route::post('surat/store', 'SuratController@store');

Route::get('/keluarga/{id_keluarga}/surat/{id_surat}/edit', 'SuratController@viewEditKeluarga')->middleware('keluarga');
Route::post('/keluarga/{id_keluarga}/surat/{id_surat}/edit', 'SuratController@updateByKeluarga')->middleware('keluarga');

Route::get('surat/{id}/edit', 'SuratController@viewEditRtRw');     // auth check at controller
Route::post('surat/{id}/update', 'SuratController@updateByRtRw');  // auth check at controller
Route::post('surat/{id}/detail', 'SuratController@edit');          // auth check at controller

