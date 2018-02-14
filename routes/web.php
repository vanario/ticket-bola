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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' =>'auth'], function () {
    Route::post('login', 'Authentication\LoginController@login');
    Route::get('home', 'Authentication\LoginController@home')->name('auth.home');
    Route::post('index', 'Authentication\LoginController@index');
    
    Route::group(['middleware' => 'jwt.auth'], function () {
	    Route::get('user', 'Authentication\LoginController@getAuthUser');
	    });
});

Route::group(['prefix'=>'stadion'], function() {
	Route::get('/','DataMaster\StadionController@index')->name('stadion.index');
	Route::post('store','DataMaster\StadionController@store')->name('stadion.store');
	Route::get('edit','DataMaster\StadionController@edit');
	Route::patch('update','DataMaster\StadionController@update')->name('stadion.update');
	Route::get('destroy/{id}','DataMaster\StadionController@destroy');

});




