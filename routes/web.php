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

/*Route::get('/', function () {
    return view('index');
});
*/

Route::get('/', 'WebController@index')->name('home');

//rutas para el funcionamiento del sistema de autenticación
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	
	//archivos
	Route::get('admin', 'AdminController@index')->name('admin');
	Route::get('cms', 'CMSController@index')->name('cms');
});

//modificacion prueba

