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

Auth::routes();

	Route::group(['prefix' =>'auth'], function () {
	    Route::get('home', 'Authentication\LoginController@home')->name('auth.home');
	    Route::post('index', 'Authentication\LoginController@index');
	    Route::post('logout', 'Authentication\LoginController@logout');
	    
	});	

Route::group(['middleware' => 'admin'], function() {

	
	Route::get('/home', 'HomeController@index')->name('home');


	Route::group(['prefix'=>'stadion'], function() {
		Route::get('/','DataMaster\StadionController@index')->name('stadion.index');
		Route::post('store','DataMaster\StadionController@store')->name('stadion.store');
		Route::patch('update','DataMaster\StadionController@update')->name('stadion.update');
		Route::get('destroy/{id}','DataMaster\StadionController@destroy');

	});

	Route::group(['prefix'=>'tribun'], function() {
		Route::match(['get', 'post'],'index','DataMaster\TribunController@index')->name('tribun.index');
		Route::post('store','DataMaster\TribunController@store')->name('tribun.store');
		Route::patch('update','DataMaster\TribunController@update')->name('tribun.update');
		Route::get('destroy/{id}','DataMaster\TribunController@destroy');

	});

	Route::group(['prefix'=>'mitra'], function() {
		Route::get('/','DataMaster\MitraController@index')->name('mitra.index');
		Route::get('page','DataMaster\MitraController@page')->name('mitra.page');
		Route::post('store','DataMaster\MitraController@store')->name('mitra.store');
		Route::patch('update','DataMaster\MitraController@update')->name('mitra.update');
		Route::get('destroy/{id}','DataMaster\MitraController@destroy');

	});

	Route::group(['prefix'=>'club'], function() {
		Route::get('/','DataMaster\ClubController@index')->name('club.index');
		Route::post('store','DataMaster\ClubController@store')->name('club.store');
		Route::patch('update','DataMaster\ClubController@update')->name('club.update');
		Route::get('destroy/{id}','DataMaster\ClubController@destroy');

	});

	Route::group(['prefix'=>'jadwal'], function() {
		Route::get('/','DataMaster\JadwalController@index')->name('jadwal.index');
		Route::post('store','DataMaster\JadwalController@store')->name('jadwal.store');
		Route::patch('update','DataMaster\JadwalController@update')->name('jadwal.update');
		Route::get('destroy/{id}','DataMaster\JadwalController@destroy');

	});

	Route::group(['prefix'=>'register'], function() {
		Route::get('index','Register\RegisterController@index')->name('register.index');
		Route::post('store','Register\RegisterController@store')->name('register.store');
		Route::patch('update','Register\RegisterController@update')->name('register.update');
		Route::get('destroy/{id}','Register\RegisterController@destroy');
	});

});


