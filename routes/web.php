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
	
	//admin
	Route::get('admin', 'AdminController@index')->name('admin');
	Route::get('cms', 'CMSController@index')->name('cms');
	
	//contenedores en CMS
	Route::get('contenedores', 'ContenedorController@lista')->name('contenedores');
	
	//contenidos en CMS
	Route::get('contenidos', 'ContenidoController@lista')->name('contenidos');
	Route::get('contenidos/agregar', 'ContenidoController@agrega')->name('contenidos/agregar');
	Route::post('contenidos/agregar', 'ContenidoController@crear')->name('contenidos/agregar');
//	Route::get('contenidos/modificar', 'ContenidoController@modifica')->name('contenidos/modificar');
//	Route::post('contenidos/modificar', 'ContenidoController@modificar')->name('contenidos/modificar');
//	Route::get('contenidos/eliminar', 'ContenidoController@elimina')->name('contenidos/eliminar');
//	Route::post('contenidos/eliminar', 'ContenidoController@eliminar')->name('contenidos/eliminar');	
});