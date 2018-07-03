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
	    // Route::get('home', 'Authentication\LoginController@home')->name('auth.home');
	    Route::post('index', 'Authentication\LoginController@index');
	    Route::post('logout', 'Authentication\LoginController@logout');

	});


Route::group(['middleware' => 'admin'], function() {

	Route::get('home', 'Dashboard\DashboardController@index')->name('dashboard.home');

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
		Route::get('edittribun/{gttop}/{gtcode}','DataMaster\TribunController@edittribun');

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
		Route::get('createjadwal','DataMaster\JadwalController@createjadwal')->name('jadwal.createjadwal');
		Route::get('createtribun','DataMaster\JadwalController@createtribun')->name('jadwal.createtribun');
		Route::get('edit/{gttoptrib}/{gtcodetrib}','DataMaster\JadwalController@edit')->name('jadwal.edit');
		Route::post('store','DataMaster\JadwalController@store')->name('jadwal.store');
		Route::patch('update','DataMaster\JadwalController@update')->name('jadwal.update');
		Route::get('destroy/{gttoptrib}/{gtcodetrib}','DataMaster\JadwalController@destroy');
		Route::get('edittribun/{gttop}/{gtcode}','DataMaster\JadwalController@edittribun');
		Route::post('storetrib','DataMaster\JadwalController@storetrib')->name('jadwal.storetrib');
		Route::patch('updatetrib','DataMaster\JadwalController@updatetrib')->name('jadwal.updatetrib');
		Route::get('destroytrib{gtcodetrib}','DataMaster\JadwalController@destroytrib')->name('jadwal.destroytrib');

	});

	Route::group(['prefix'=>'member'], function() {
		Route::get('index','Member\MemberController@index')->name('member.index');
		Route::get('page','Member\MemberController@page')->name('member.page');
		Route::post('store','Member\MemberController@store')->name('member.store');
		Route::patch('update','Member\MemberController@update')->name('member.update');
		Route::get('approve','Member\MemberController@approve')->name('member.approve');
		Route::get('destroy/{id}','Member\MemberController@destroy');
	});

	Route::group(['prefix'=>'previledge'], function() {
		Route::get('index','Previledge\PreviledgeController@index')->name('member.index');
	});

	Route::group(['prefix'=>'register'], function() {
		Route::get('index','Register\RegisterController@index')->name('register.index');
		Route::get('page','Register\RegisterController@page')->name('member.page');
		Route::get('approve','Register\RegisterController@approve')->name('register.approve');
	});

	Route::group(['prefix'=>'merchandise'], function() {
		Route::get('/','Merchandise\MerchandiseController@index')->name('merchandise.index');
		Route::post('store','Merchandise\MerchandiseController@store')->name('merchandise.store');
		Route::patch('update','Merchandise\MerchandiseController@update')->name('merchandise.update');
		Route::get('destroy/{id}','Merchandise\MerchandiseController@destroy');
	});

	Route::group(['prefix'=>'news'], function() {
		Route::get('/','News\NewsController@index')->name('news.index');
		Route::post('store','News\NewsController@store')->name('news.store');
		Route::patch('update','News\NewsController@update')->name('news.update');
		Route::get('destroy/{id}','News\NewsController@destroy');
	});

	Route::group(['prefix'=>'faq'], function() {
		Route::get('/','faq\FaqController@index')->name('faq.index');
		Route::post('store','faq\FaqController@store')->name('faq.store');
		Route::patch('update','faq\FaqController@update')->name('faq.update');
		Route::get('destroy/{id}','faq\FaqController@destroy');
	});

	Route::group(['prefix' => 'report'], function(){
		Route::get('/','Report\ReportController@index')->name('report.index');
		Route::group(['prefix' => 'club'], function(){
			Route::get('/','Report\ReportController@club')->name('report.club');
			Route::get('/detail/{clubId}','Report\ReportController@clubReport')->name('report.club');
		});
	});


	Route::group(['prefix'=>'biaya'], function() {
		Route::match(['get', 'post'],'/','Biaya\BiayaController@index')->name('biaya.index');
		Route::get('page','Biaya\BiayaController@page')->name('biaya.page');
		Route::post('store','Biaya\BiayaController@store')->name('biaya.store');
		Route::patch('update','Biaya\BiayaController@update')->name('biaya.update');
		Route::get('destroy/{gttoptrib}/{gtcodetrib}','Biaya\BiayaController@destroy');
	});

	Route::group(['prefix'=>'pertandingan'], function() {
		Route::get('/','Pertandingan\PertandinganController@index')->name('pertandingan.index');
		Route::post('store','Pertandingan\PertandinganController@store')->name('pertandingan.store');
		Route::patch('update','Pertandingan\PertandinganController@update')->name('pertandingan.update');
		Route::get('destroy/{id}','Pertandingan\PertandinganController@destroy');
	});

	Route::group(['prefix'=>'master-biaya'], function() {
		Route::get('/','DataMaster\MasterBiayaController@index')->name('master-biaya.index');
		Route::get('page','DataMaster\MasterBiayaController@page')->name('master-biaya.page');
		Route::post('store','DataMaster\MasterBiayaController@store')->name('master-biaya.store');
		Route::patch('update','DataMaster\MasterBiayaController@update')->name('master-biaya.update');
		Route::get('destroy/{id}','DataMaster\MasterBiayaController@destroy');
	});

});
