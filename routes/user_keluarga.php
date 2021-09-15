<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['keluarga']], function () {
    Route::get('/keluarga', 'KeluargaController@dashboard');
    Route::get('/keluarga/tambah-keluarga', 'KeluargaController@viewAddNew');
    Route::get('/keluarga/{id}/ganti-password', 'KeluargaController@viewChangePassword');
    Route::post('/keluarga/{id}/ganti-password', 'KeluargaController@changePassword');
    //Lihat Detail Keluarga
    Route::get('/keluarga/{id}/info', 'KeluargaController@viewInfo');
    Route::get('/keluarga/{id}/edit', 'KeluargaController@viewEdit');
    Route::post('/keluarga/{id}/changeKKPhoto', 'KeluargaController@changeKKPhoto');
    Route::post('/keluarga/updateData', 'KeluargaController@keluargaUpdate');
    Route::get('/keluarga/getAnggotaAjax/{id}', 'KeluargaController@getAnggotaAjax');
    Route::get('/keluarga/{id}/status-surat', 'SuratController@viewTrackingByKeluarga');
});



//Crud Member
Route::get('/member/{id}/edit', 'KeluargaController@viewEditMember');
Route::get('/member/{id}/detail', 'KeluargaController@viewDetailMember');
Route::post('/member/{id}/update', 'KeluargaController@updateMember');
Route::delete('/member/{id}/deleteAjax', 'KeluargaController@deleteMemberAjax');

Route::get('keluarga/{id}/anggota/tambah', 'KeluargaController@viewAddMember');
Route::get('keluarga/{id}/anggota', 'KeluargaController@viewManageMember');
Route::post('keluarga/{id}/anggota/simpan', 'KeluargaController@storeMember');
Route::get('keluarga/download/{id}','KeluargaController@generatePDF');
Route::get('keluarga/download/raw/{id}','KeluargaController@generatePDFraw');

Route::group(['prefix' => 'keluarga', 'middleware' => ['keluarga']], function () {
    Route::get('/news/create', 'NewsController@viewAdminCreate');
    Route::get('/news/manage', 'NewsController@viewAdminManage');
    Route::post('/news/manage', 'NewsController@viewAdminManage');

    Route::post('/rw/insertAjax', 'RWAdminController@insertAjax');
    Route::delete('/rw/{id}/delete', 'RWAdminController@deleteAjax');
    Route::get('/rw/manage', 'RWAdminController@viewAdminManage');

    Route::post('/rt/insertAjax', 'RTAdminController@insertAjax');
    Route::delete('/rt/{id}/delete', 'RTAdminController@deleteAjax');
    Route::get('/rt/manage', 'RTAdminController@viewAdminManage');
});
