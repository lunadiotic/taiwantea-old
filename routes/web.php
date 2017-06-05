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


Route::group(['middleware' => ['auth', 'role:admin']], function(){
	Route::get('/admin', function(){
		return 'Halaman Admin';
	});
});

Route::group(['middleware' => ['auth', 'role:manager']], function(){
	Route::get('/manager', function(){
		return 'Halaman Manager';
	});
});

Route::group(['middleware' => ['auth', 'role:supervisor']], function(){
	Route::get('/supervisor', function(){
		return 'Halaman Supervisor';
	});
});
