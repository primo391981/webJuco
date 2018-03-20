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
	Route::get('add_contenido', 'ContenidoController@agrega')->name('add_contenido');
	Route::post('add_contenido', 'ContenidoController@crear')->name('add_contenido');
//	Route::get('edit_contenido/{id}', 'ContenidoController@modifica')->name('edit_contenido');
//	Route::post('edit_contenido', 'ContenidoController@modificar')->name('edit_contenido');

//	Route::post('del_contenido', 'ContenidoController@eliminar')->name('del_contenido');	
});