<?php

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

Route::get('/', function () {
    return view('auth.login');
})->name('index');

Route::post('/api/login', 'Api\ApiController@login')->name('apiLogin');

Route::group(['middleware' => 'authuser'], function() {
	Route::get('/post', 'Api\ApiController@index')->name('apiIndex');
	Route::get('/post/add', function() {
		return view('partial.add');
	});
	Route::post('/post/store', 'Api\ApiController@store')->name('apiStore');
	Route::get('/post/edit/{id}', 'Api\ApiController@edit');
	Route::delete('/post/delete/{id}', 'Api\ApiController@delete')->name('apiDestroy');
	Route::put('/post/update', 'Api\ApiController@update')->name('apiUpdate');
	Route::post('/post/logout', 'Api\ApiController@logout')->name('apiLogout');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
