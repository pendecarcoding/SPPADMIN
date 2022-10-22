<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::match(['get','post'],'getkesehatansiswa/{kelas}/{idsekolah}/{nis}','KesehatanController@ApistudentKesehatan');
Route::match(['get','post'],'gethafalansiswa/{kelas}/{idsekolah}/{nis}','HafalanController@Apistudenthafalan');
Route::match(['get','post'],'login','ApiController@login');
Route::match(['get','post'],'update','ApiController@update');
Route::match(['get','post'],'gethealth','ApiController@getinfohealth');
Route::match(['get','post'],'gethafalan','ApiController@getinfohafalan');
Route::match(['get','post'],'getinfospp','ApiController@getinfospp');
