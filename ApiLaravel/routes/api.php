<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => "auth:api"], function() {
	Route::resource('post', 'PostController');
	Route::get('exportpost', 'ExportImportController@export');
});

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
route::post('passwordupdate', 'Auth\LoginController@passwordupdate')->name('passwordupdate');
Route::post('existemail', 'Auth\LoginController@existemail');
Route::post('register', 'Auth\RegisterController@register');
