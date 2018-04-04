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
	Route::get('usuarios/{estado?}', 'Administracion\UserController@lista')->name('usuarios')->middleware('role:superAdmin');
	Route::post('del_usuario', 'Administracion\UserController@eliminaRecupera')->name('del_usuario')->middleware('role:superAdmin');
	Route::get('edit_usuario/{id}', 'Administracion\UserController@edita')->name('edit_usuario')->middleware('role:superAdmin');
	Route::post('edit_usuario/{id}', 'Administracion\UserController@modificar')->name('edit_usuario')->middleware('role:superAdmin');
	
	//admin
	Route::get('admin', 'Administracion\AdminController@index')->name('admin');
	
	//index cms
	Route::get('cms', 'CMS\CMSController@index')->name('cms')->middleware('role:cmsAdmin');
	
	//menuitems en CMS
	Route::get('menuitems', 'CMS\MenuitemController@lista')->name('menuitems')->middleware('role:cmsAdmin');
			
	//contenedores en CMS
	Route::resource('contenedor', 'CMS\ContenedorController')->middleware('role:cmsAdmin');
	
	//contenidos en CMS
	Route::resource('contenido', 'CMS\ContenidoController')->middleware('role:cmsAdmin');
	
	/*
	Route::get('contenidos', 'CMS\ContenidoController@lista')->name('contenidos')->middleware('role:cmsAdmin');
	Route::get('add_contenido', 'CMS\ContenidoController@agrega')->name('add_contenido')->middleware('role:cmsAdmin');
	Route::post('add_contenido', 'CMS\ContenidoController@crear')->name('add_contenido')->middleware('role:cmsAdmin');
//	Route::get('edit_contenido/{id}', 'ContenidoController@modifica')->name('edit_contenido');
//	Route::post('edit_contenido', 'ContenidoController@modificar')->name('edit_contenido');
//	Route::post('del_contenido', 'ContenidoController@eliminar')->name('del_contenido');	
*/
});