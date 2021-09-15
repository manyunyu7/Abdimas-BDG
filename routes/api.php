<?php
use App\Http\Controllers\PeopleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/test',function(){
return 'test';
});

Route::get('news/fetchAll','NewsController@fetchAll');


Route::post('people/register','PeopleController@store');
Route::post('people/login','PeopleController@login');

Route::post('people/{id}/change-password','PeopleController@changePassword');
Route::any('people/{id}','PeopleController@getUserByID');
Route::any('people/{id}/update','PeopleController@updateUserByID');
Route::post('people/{id}/update_photo','PeopleController@updatePhotoByID');

Route::get('category','ReportCategoryController@getCategory');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('people')->group(function(){
    Route::get('/fetch/all','PeopleController@fetchAll');
});


