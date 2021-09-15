<?php

use Illuminate\Support\Facades\Route;


//nanti dikasih middleware, hehe, sekarang belom -Henry

Route::get('rt/{id}/keluarga','RTController@viewListKeluarga'); //auth check at controller


Route::group(['middleware' => ['rt']], function () {

    Route::get('/rt','RTHomeController@home');
    Route::get('/rt/{id}/getKeluargaAjax', 'RTController@getKeluargaAjax');
    Route::get('/rt/{id}/ganti-password', 'RTController@viewChangePassword');
    Route::post('/rt/{id}/ganti-password', 'RTController@changePassword');


    Route::get('/rt/{id}/manage-tanda-tangan', 'RTController@viewManageTTD');
    Route::get('/rt/{id}/manage-cap', 'RTController@viewManageCap');
    Route::post('/rt/new-ttd', 'RTController@storeTTD');
    Route::post('/rt/new-cap', 'RTController@storeCap');

  
    
    Route::get('/list_keluarga','RTController@listKeluarga');
    Route::get('/rt/{id}/surat-pengantar', 'SuratController@viewTrackingByRT');

});



