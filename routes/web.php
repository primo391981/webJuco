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


//render sitio web
Route::get('/', 'WebController@index')->name('home');

Route::get('notAuthorized', function (){
	return view('notAuthorized');
})->name('notAuthorized');

//Webservice
Route::get('webservice', 'Juridico\WebServiceController@index')->name('test');
Route::post('webservice', 'Juridico\WebServiceController@test')->name('searchExpediente');

//OCR
Route::get('ocr', 'Juridico\OCRController@ocrtext')->name('ocr');

//rutas para el funcionamiento del sistema de autenticación
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	
	//intranet
	Route::get('admin', 'Administracion\AdminController@index')->name('admin');
		
	//ADMIN USUARIOS	
	//index administracion
	Route::get('useradmin', 'Administracion\UseradminController@index')->name('useradmin')->middleware('role:superAdmin');
	
	Route::get('user/list/{estado?}', 'Administracion\UserController@lista')->name('user.list')->middleware('role:superAdmin');
	Route::post('user/restore', 'Administracion\UserController@restore')->name('user.restore')->middleware('role:superAdmin');
	Route::resource('user', 'Administracion\UserController')->middleware('role:superAdmin');
	//FIN USUARIOS
	
	//CMS
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
	//FIN CMS
	
	//CONTABLE
	//dashboard contable
	Route::get('contable', 'Contable\ContableController@index')->name('contable')->middleware('role:contableAdmin');
	
	//cargos
	Route::get('cargo/inactivos', 'Contable\CargoController@inactivos')->name('cargo.index.inactivos')->middleware('role:contableAdmin');
	Route::post('cargo/activar', 'Contable\CargoController@activar')->name('cargo.activar')->middleware('role:contableAdmin');
	Route::resource('cargo', 'Contable\CargoController')->middleware('role:contableAdmin');
	
	//parametros generales
	Route::get('parametrogeneral/inactivos', 'Contable\ParametroGeneralController@inactivos')->name('parametrogeneral.index.inactivos')->middleware('role:contableAdmin');
	Route::post('parametrogeneral/activar', 'Contable\ParametroGeneralController@activar')->name('parametrogeneral.activar')->middleware('role:contableAdmin');
	Route::resource('parametrogeneral', 'Contable\ParametroGeneralController')->middleware('role:contableAdmin');
	
	//empresa
	
	Route::get('desactivada', 'EmpresaController@desactivada')->name('empresa.desactivada')->middleware('role:contableAdmin');
	//primero lo que aparece en la barra,segundo la ubicacion en carpetas del controlador, tres el nombre que se le da al metod
	Route::get('restaurar/{id}', 'EmpresaController@restaurar')->name('empresa.restaurar')->middleware('role:contableAdmin');	
	Route::resource('empresa', 'EmpresaController')->middleware('role:contableAdmin');
	
	//persona
	Route::get('desactivado', 'PersonaController@desactivado')->name('persona.desactivado')->middleware('role:contableAdmin');
	Route::get('restauraremp/{id}', 'PersonaController@restaurar')->name('persona.restaurar')->middleware('role:contableAdmin');
	Route::resource('persona', 'PersonaController')->middleware('role:contableAdmin');
	
	//empleado
	Route::post('asociarEmpresa/{idpersona}', 'Contable\EmpleadoController@asociarEmpresa')->name('empleado.asociarEmpresa')->middleware('role:contableAdmin');
	Route::post('desasociarEmpresa/{idpersona}/{idempresa}', 'Contable\EmpleadoController@asociarEmpresa')->name('empleado.desasociarEmpresa')->middleware('role:contableAdmin');
	Route::post('horarioTrabajo/{idpersona}/{idempresa}', 'Contable\EmpleadoController@asociarEmpresa')->name('empleado.horarioTrabajo')->middleware('role:contableAdmin');
	Route::get('formCrear/{idpersona}', 'Contable\EmpleadoController@formCrear')->name('empleado.formCrear')->middleware('role:contableAdmin');
	Route::get('formCargarHorario/{idempleado}', 'Contable\EmpleadoController@formCargarHorario')->name('empleado.formCargarHorario')->middleware('role:contableAdmin');
	Route::post('cargarHorario', 'Contable\EmpleadoController@cargarHorario')->name('empleado.cargarHorario')->middleware('role:contableAdmin');
	Route::get('editarHorario/{idempleado}/{idhorario}', 'Contable\EmpleadoController@formEditarHorario')->name('empleado.formEditarHorario')->middleware('role:contableAdmin');
	Route::post('editarHorario', 'Contable\EmpleadoController@editarHorario')->name('empleado.editarHorario')->middleware('role:contableAdmin');
	
	//registro horas reloj
	Route::get('listaEmpleados', 'Contable\RegistroHoraController@listaEmpleados')->name('reloj.listaEmpleados')->middleware('role:contableAdmin');
	Route::post('compruebaMes', 'Contable\RegistroHoraController@compruebaMes')->name('reloj.compruebaMes')->middleware('role:contableAdmin');
	
	
	//JURIDICO
	//dashboard juridico
	Route::get('juridico', 'Juridico\JuridicoController@index')->name('juridico')->middleware('role:juridicoAdmin');
	
	//clientes
	Route::get('cliente/search', 'Juridico\ClienteController@search')->name('cliente.search')->middleware('role:juridicoAdmin');
	Route::get('cliente/fisica', 'Juridico\ClienteController@createFisica')->name('cliente.create.fisica')->middleware('role:juridicoAdmin');
	Route::get('cliente/juridica', 'Juridico\ClienteController@createJuridica')->name('cliente.create.juridica')->middleware('role:juridicoAdmin');
	Route::get('cliente/inactivos', 'Juridico\ClienteController@inactivos')->name('cliente.index.inactivos')->middleware('role:juridicoAdmin');
	Route::post('cliente/activar', 'Juridico\ClienteController@activar')->name('cliente.activar')->middleware('role:juridicoAdmin');
	Route::resource('cliente', 'Juridico\ClienteController')->middleware('role:juridicoAdmin');
	
});