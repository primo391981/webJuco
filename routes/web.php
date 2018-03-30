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
	//usuarios
	Route::get('adminusuarios', 'Administracion\UserController@index')->name('adminusuarios')->middleware('role:superAdmin');
	Route::get('usuarios', 'Administracion\UserController@lista')->name('usuarios')->middleware('role:superAdmin');
	Route::post('usuario_activa_desactiva', 'Administracion\UserController@activaDesactiva')->name('usuario_activa_desactiva')->middleware('role:superAdmin');
	
	//admin
	Route::get('admin', 'Administracion\AdminController@index')->name('admin');
	
	//index cms
	Route::get('cms', 'CMS\CMSController@index')->name('cms')->middleware('role:cmsAdmin');
	
	//contenedores en CMS
	Route::get('menuitems', 'CMS\MenuitemController@lista')->name('menuitems')->middleware('role:cmsAdmin');
	
	//contenedores en CMS
	Route::get('contenedores', 'CMS\ContenedorController@lista')->name('contenedores')->middleware('role:cmsAdmin');
	Route::get('add_contenedor', 'CMS\ContenedorController@agrega')->name('add_contenedor')->middleware('role:cmsAdmin');
	Route::post('add_contenedor', 'CMS\ContenedorController@crear')->name('add_contenedor')->middleware('role:cmsAdmin');
//	Route::get('edit_contenedor/{id}', 'ContenedorController@modifica')->name('edit_contenedor');
//	Route::post('edit_contenedor', 'ContenedorController@modificar')->name('edit_contenedor');
//	Route::post('del_contenedor', 'ContenedorController@eliminar')->name('del_contenedor');

	//contenidos en CMS
	Route::get('contenidos', 'CMS\ContenidoController@lista')->name('contenidos')->middleware('role:cmsAdmin');
	Route::get('add_contenido', 'CMS\ContenidoController@agrega')->name('add_contenido')->middleware('role:cmsAdmin');
	Route::post('add_contenido', 'CMS\ContenidoController@crear')->name('add_contenido')->middleware('role:cmsAdmin');
//	Route::get('edit_contenido/{id}', 'ContenidoController@modifica')->name('edit_contenido');
//	Route::post('edit_contenido', 'ContenidoController@modificar')->name('edit_contenido');
//	Route::post('del_contenido', 'ContenidoController@eliminar')->name('del_contenido');	
});