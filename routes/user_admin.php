<?php

use Illuminate\Support\Facades\Route;


//nanti dikasih middleware, hehe, sekarang belom -Henry

Route::get('/news/{id}/edit', 'NewsController@viewNewsEdit');
Route::post('/news/{id}/edit', 'NewsController@update');
Route::post('/news/store', 'NewsController@store');
Route::delete('/news/{id}/delete', 'NewsController@destroy');

Route::get("/report_category/manage", 'ReportCategoryController@viewManage');
Route::post("/report_category/manage", 'ReportCategoryController@viewManage');
Route::get("/report_category/create", 'ReportCategoryController@viewCreate');

Route::get('/report_category/{id}/edit', 'ReportCategoryController@viewUpdate');
Route::post('/report_category/{id}/edit', 'ReportCategoryController@update');
Route::delete('/report_category/{id}/delete', 'ReportCategoryController@destroy');
Route::post("/report_category/store", 'ReportCategoryController@store');


Route::get('/rw/{id}/edit', 'RWAdminController@viewEdit');
Route::post('/rw/{id}/edit', 'RWAdminController@update');
Route::post('/rw/{id}/admin_change_password', 'RWAdminController@adminChangePassword');

Route::get('/rt/{id}/edit', 'RTAdminController@viewEdit');
Route::post('/rt/{id}/edit', 'RTAdminController@update');
Route::post('/rt/{id}/admin_change_password', 'RTAdminController@adminChangePassword');


Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin/ganti-password', 'HomeAdminController@viewChangePassword');
    Route::post('/admin/ganti-password', 'HomeAdminController@changePassword');
    Route::get('/admin/surat-pengantar', 'SuratController@viewTrackingByAdmin');
});


Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {

    Route::get('/news/create', 'NewsController@viewAdminCreate');
    Route::get('/news/manage', 'NewsController@viewAdminManage');
    Route::post('/news/manage', 'NewsController@viewAdminManage');

    Route::post('/rw/insertAjax', 'RWAdminController@insertAjax');
    Route::delete('/rw/{id}/delete', 'RWAdminController@deleteAjax');
    Route::get('/rw/manage', 'RWAdminController@viewAdminManage');

    Route::post('/rt/insertAjax', 'RTAdminController@insertAjax');
    Route::delete('/rt/{id}/delete', 'RTAdminController@deleteAjax');
    Route::get('/rt/manage', 'RTAdminController@viewAdminManage');

    Route::get('/', 'HomeAdminController@index');
});
