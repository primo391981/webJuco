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

//Webservice
Route::get('webservice', 'Juridico\WebServiceController@index')->name('test');
Route::post('webservice', 'Juridico\WebServiceController@test')->name('searchExpediente');

//OCR
Route::get('ocr', 'Juridico\OCRController@ocrtext')->name('ocr');

//rutas para el funcionamiento del sistema de autenticación
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	
	//admin
	Route::get('admin', 'Administracion\AdminController@index')->name('admin');
	
	//index administracion
	Route::get('useradmin', 'Administracion\UseradminController@index')->name('useradmin')->middleware('role:superAdmin');
	//usuarios
	Route::get('user/list/{estado?}', 'Administracion\UserController@lista')->name('user.list')->middleware('role:superAdmin');
	Route::post('user/restore', 'Administracion\UserController@restore')->name('user.restore')->middleware('role:superAdmin');
	Route::resource('user', 'Administracion\UserController')->middleware('role:superAdmin');
	//Route::get('adminusuarios', 'Administracion\UserController@index')->name('adminusuarios')->middleware('role:superAdmin');
	//Route::get('usuarios/{estado?}', 'Administracion\UserController@lista')->name('usuarios')->middleware('role:superAdmin');
	//Route::post('del_usuario', 'Administracion\UserController@eliminaRecupera')->name('del_usuario')->middleware('role:superAdmin');
	//Route::get('edit_usuario/{id}', 'Administracion\UserController@edita')->name('edit_usuario')->middleware('role:superAdmin');
	//Route::post('edit_usuario/{id}', 'Administracion\UserController@modificar')->name('edit_usuario')->middleware('role:superAdmin');
	
	//index cms
	Route::get('cms', 'CMS\CMSController@index')->name('cms')->middleware('role:cmsAdmin');
	
	//menuitems en CMS
	Route::post('upmenuitem', 'CMS\MenuitemController@upMenu')->name('menuitem.up')->middleware('role:cmsAdmin');
	Route::post('downmenuitem', 'CMS\MenuitemController@downMenu')->name('menuitem.down')->middleware('role:cmsAdmin');
	Route::resource('menuitem', 'CMS\MenuitemController')->middleware('role:cmsAdmin');
			
	//contenedores en CMS
	Route::post('deassigncontenedor', 'CMS\ContenedorController@deassignContenedor')->name('contenedor.deassign')->middleware('role:cmsAdmin');
	Route::post('upcontenedor', 'CMS\ContenedorController@upContenedor')->name('contenedor.up')->middleware('role:cmsAdmin');
	Route::post('downcontenedor', 'CMS\ContenedorController@downContenedor')->name('contenedor.down')->middleware('role:cmsAdmin');
	Route::post('deassigncontenido', 'CMS\ContenedorController@deassignContenido')->name('contenido.deassign')->middleware('role:cmsAdmin');
	Route::post('assigncontenido/{contenido}', 'CMS\ContenedorController@assignContenido')->name('contenido.assign')->middleware('role:cmsAdmin');
	Route::resource('contenedor', 'CMS\ContenedorController')->middleware('role:cmsAdmin');

	//contenidos en CMS
	Route::get('searchcontenido', 'CMS\ContenidoController@search')->name('contenido.search')->middleware('role:cmsAdmin');
	Route::post('upcontenido', 'CMS\ContenidoController@upContenido')->name('contenido.up')->middleware('role:cmsAdmin');
	Route::post('downcontenido', 'CMS\ContenidoController@downContenido')->name('contenido.down')->middleware('role:cmsAdmin');
	Route::resource('contenido', 'CMS\ContenidoController')->middleware('role:cmsAdmin');

});