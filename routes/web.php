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
Route::get('/', function(){
	return redirect()->route('home');
});

Route::get('/home', 'WebController@index')->name('home');

Route::get('notAuthorized', function (){
	return view('notAuthorized');
})->name('notAuthorized');

//Webservice
Route::get('webservice', 'Juridico\WebServiceController@index')->name('test');
Route::post('webservice', 'Juridico\WebServiceController@test')->name('searchExpediente');



//rutas para el funcionamiento del sistema de autenticación
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	
	//intranet
	Route::get('admin', 'Administracion\AdminController@index')->name('admin');
		
	//ADMIN USUARIOS	
	//index administracion
	Route::get('useradmin', 'Administracion\UseradminController@index')->name('useradmin')->middleware('role:superAdmin');
	
	Route::get('user/inactivos', 'Administracion\UserController@inactivos')->name('user.index.inactivos')->middleware('role:superAdmin');
	Route::post('user/restore', 'Administracion\UserController@restore')->name('user.restore')->middleware('role:superAdmin');
	Route::resource('user', 'Administracion\UserController')->middleware('role:superAdmin');
	//FIN USUARIOS
	
	//CMS
	//index cms
	Route::get('cms', 'CMS\CMSController@index')->name('cms')->middleware('role:cmsAdmin');
	
	//menuitems en CMS
	Route::post('menuitem/up', 'CMS\MenuitemController@upMenu')->name('menuitem.up')->middleware('role:cmsAdmin');
	Route::post('menuitem/down', 'CMS\MenuitemController@downMenu')->name('menuitem.down')->middleware('role:cmsAdmin');
	Route::post('menuitem/activar}', 'CMS\MenuitemController@activarMenuitem')->name('menuitem.activar')->middleware('role:cmsAdmin');
	Route::get('menuitem/inactivos}', 'CMS\MenuitemController@inactivos')->name('menuitem.index.inactivos')->middleware('role:cmsAdmin');
	Route::resource('menuitem', 'CMS\MenuitemController')->middleware('role:cmsAdmin');
			
	//contenedores en CMS
	Route::post('contenedor/deassign', 'CMS\ContenedorController@deassignContenedor')->name('contenedor.deassign')->middleware('role:cmsAdmin');
	Route::post('contenedor/up', 'CMS\ContenedorController@upContenedor')->name('contenedor.up')->middleware('role:cmsAdmin');
	Route::post('contenedor/down', 'CMS\ContenedorController@downContenedor')->name('contenedor.down')->middleware('role:cmsAdmin');
	Route::post('contenido/deassign', 'CMS\ContenedorController@deassignContenido')->name('contenido.deassign')->middleware('role:cmsAdmin');
	Route::post('contenido/assign}', 'CMS\ContenedorController@assignContenido')->name('contenido.assign')->middleware('role:cmsAdmin');
	Route::post('contenedor/activar}', 'CMS\ContenedorController@activarContenedor')->name('contenedor.activar')->middleware('role:cmsAdmin');
	Route::get('contenedor/inactivos}', 'CMS\ContenedorController@inactivos')->name('contenedor.index.inactivos')->middleware('role:cmsAdmin');
	Route::resource('contenedor', 'CMS\ContenedorController')->middleware('role:cmsAdmin');

	//contenidos en CMS
	Route::post('contenido/up', 'CMS\ContenidoController@upContenido')->name('contenido.up')->middleware('role:cmsAdmin');
	Route::post('contenido/down', 'CMS\ContenidoController@downContenido')->name('contenido.down')->middleware('role:cmsAdmin');
	Route::post('contenido/activar}', 'CMS\ContenidoController@activarContenido')->name('contenido.activar')->middleware('role:cmsAdmin');
	Route::get('contenido/inactivos}', 'CMS\ContenidoController@inactivos')->name('contenido.index.inactivos')->middleware('role:cmsAdmin');
	Route::resource('contenido', 'CMS\ContenidoController')->middleware('role:cmsAdmin');
	//FIN CMS
	
	//CONTABLE
	//dashboard contable
	Route::get('contable', 'Contable\ContableController@index')->name('contable')->middleware('role:contableAdmin');
	
	//reportes
	Route::get('reportes','EmpresaController@listadoReportes')->name('reportes.listadoReportes')->middleware('role:contableAdmin');
	Route::post('reportes/reporteUno','EmpresaController@reporteUno')->name('reporte.reporteUno')->middleware('role:contableAdmin');
	Route::post('reportes/imprimir','EmpresaController@reporteDos')->name('reporte.reporteDos')->middleware('role:contableAdmin');
	
	//cargos
	Route::post('cargo/salario', 'Contable\CargoController@altaSalarioMinimo')->name('cargo.altaSalarioMinimo')->middleware('role:contableAdmin');
	Route::get('cargo/inactivos', 'Contable\CargoController@inactivos')->name('cargo.index.inactivos')->middleware('role:contableAdmin');
	Route::post('cargo/activar', 'Contable\CargoController@activar')->name('cargo.activar')->middleware('role:contableAdmin');
	Route::resource('cargo', 'Contable\CargoController')->middleware('role:contableAdmin');
	
	//parametros generales
	Route::get('parametrogeneral/search', 'Contable\ParametroGeneralController@search')->name('parametrogeneral.search')->middleware('role:contableAdmin');
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
	Route::resource('persona', 'PersonaController')->middleware('role:contableAdmin');
	
	//empleado
	Route::post('empleado/contrato/editar/guardar', 'Contable\EmpleadoController@guardarEditContrato')->name('empleado.guardarEditContrato')->middleware('role:contableAdmin');
	Route::get('empleado/contrato/editar/{idEmpleado}', 'Contable\EmpleadoController@editarContrato')->name('empleado.editarContrato')->middleware('role:contableAdmin');
	Route::get('empleado/search', 'Contable\EmpleadoController@search')->name('empleado.search')->middleware('role:contableAdmin');
	Route::post('asociarEmpresa/{idpersona}', 'Contable\EmpleadoController@asociarEmpresa')->name('empleado.asociarEmpresa')->middleware('role:contableAdmin');
	Route::get('formCrear/{idpersona}', 'Contable\EmpleadoController@formCrear')->name('empleado.formCrear')->middleware('role:contableAdmin');
	Route::get('formCargarHorario/{idempleado}', 'Contable\EmpleadoController@formCargarHorario')->name('empleado.formCargarHorario')->middleware('role:contableAdmin');
	Route::post('cargarHorario', 'Contable\EmpleadoController@cargarHorario')->name('empleado.cargarHorario')->middleware('role:contableAdmin');
	Route::get('editHorarioPrincipal/{idempleado}/{idHorarioModificar}', 'Contable\EmpleadoController@editHorarioPrincipal')->name('empleado.editHorarioPrincipal')->middleware('role:contableAdmin');
	Route::post('guardarHorarioPrin', 'Contable\EmpleadoController@guardarHorarioPrin')->name('empleado.guardarHorarioPrin')->middleware('role:contableAdmin');
	Route::post('formHorarioEspecial', 'Contable\EmpleadoController@formHorarioEspecial')->name('empleado.formHorarioEspecial')->middleware('role:contableAdmin');
	Route::post('guardarHorarioEsp', 'Contable\EmpleadoController@guardarHorarioEsp')->name('empleado.guardarHorarioEsp')->middleware('role:contableAdmin');
	Route::post('empleado/horario/borrar', 'Contable\EmpleadoController@borrarHorarioEsp')->name('empleado.borrarHorarioEsp')->middleware('role:contableAdmin');
	Route::post('empleado/desvincular', 'Contable\EmpleadoController@desvincularEmpresa')->name('empleado.desvincularEmpresa')->middleware('role:contableAdmin');
		
		
	//registro horas reloj
	Route::get('reloj/lista', 'Contable\RegistroHoraController@listaEmpleados')->name('reloj.listaEmpleados')->middleware('role:contableAdmin');
	Route::post('reloj/crear', 'Contable\RegistroHoraController@formMarcas')->name('reloj.formMarcas')->middleware('role:contableAdmin');
	Route::post('reloj/crear/guardar', 'Contable\RegistroHoraController@guardarMarcas')->name('reloj.guardarMarcas')->middleware('role:contableAdmin');
	Route::post('reloj/editar', 'Contable\RegistroHoraController@editarMes')->name('reloj.editarMes')->middleware('role:contableAdmin');
	//Route::post('reloj/editar/guardar', 'Contable\RegistroHoraController@guardarMarcasEdit')->name('reloj.guardarMarcasEdit')->middleware('role:contableAdmin');
	Route::post('reloj/ver', 'Contable\RegistroHoraController@verMarcas')->name('reloj.verMarcas')->middleware('role:contableAdmin');
	
	//pagos
	Route::post('pago/extra/alta', 'Contable\PagoController@altaPartidaExtra')->name('pago.altaPartidaExtra')->middleware('role:contableAdmin');
	Route::post('pago/adelanto/alta', 'Contable\PagoController@altaAdelanto')->name('pago.altaAdelanto')->middleware('role:contableAdmin');
	Route::post('pago/viatico/alta', 'Contable\PagoController@altaViatico')->name('pago.altaViatico')->middleware('role:contableAdmin');
	Route::post('pago/ficto/alta', 'Contable\PagoController@altaFicto')->name('pago.altaFicto')->middleware('role:contableAdmin');
	Route::get('viaticos', 'Contable\PagoController@viaticos')->name('pago.viaticos')->middleware('role:contableAdmin');
	Route::get('viaticos/inactivos', 'Contable\PagoController@viaticosInactivos')->name('pago.viaticos.inactivos')->middleware('role:contableAdmin');
	Route::get('adelantos', 'Contable\PagoController@adelantos')->name('pago.adelantos')->middleware('role:contableAdmin');
	Route::get('adelantos/inactivos', 'Contable\PagoController@adelantosInactivos')->name('pago.adelantos.inactivos')->middleware('role:contableAdmin');
	Route::get('extras', 'Contable\PagoController@extras')->name('pago.extras')->middleware('role:contableAdmin');
	Route::get('extras/inactivos', 'Contable\PagoController@extrasInactivos')->name('pago.extras.inactivos')->middleware('role:contableAdmin');
	Route::get('fictos', 'Contable\PagoController@fictos')->name('pago.fictos')->middleware('role:contableAdmin');
	Route::get('fictos/inactivos', 'Contable\PagoController@fictosInactivos')->name('pago.fictos.inactivos')->middleware('role:contableAdmin');
	Route::post('pago/activar', 'Contable\PagoController@activar')->name('pago.activar')->middleware('role:contableAdmin');
	Route::get('pago/create/{idTipo}', 'EmpresaController@create')->name('pago.create')->middleware('role:contableAdmin');	
	Route::resource('pago', 'Contable\PagoController')->middleware('role:contableAdmin');
	
	//haberes
	Route::post('haberes/empleados','Contable\HaberesController@listaEmpleados')->name('haberes.listaEmpleados')->middleware('role:contableAdmin');
	Route::post('haberes/aguinaldo','Contable\HaberesController@calculoAguinaldo')->name('haberes.calculoAguinaldo')->middleware('role:contableAdmin');	
	Route::post('haberes/salariovacacional','Contable\HaberesController@calculoSalVacacional')->name('haberes.calculoSalVacacional')->middleware('role:contableAdmin');	
	Route::post('haberes/liquidacion','Contable\HaberesController@calculoLiquidacion')->name('haberes.calculoLiquidacion')->middleware('role:contableAdmin');		
	Route::resource('haberes', 'Contable\HaberesController')->middleware('role:contableAdmin');
	
	//JURIDICO
	//dashboard juridico
	Route::get('juridico', 'Juridico\JuridicoController@index')->name('juridico')->middleware('role:invitado,juridicoAdmin');
	
	//clientes
	Route::get('cliente/search', 'Juridico\ClienteController@search')->name('cliente.search')->middleware('role:juridicoAdmin');
	Route::get('cliente/fisica', 'Juridico\ClienteController@createFisica')->name('cliente.create.fisica')->middleware('role:juridicoAdmin');
	Route::get('cliente/juridica', 'Juridico\ClienteController@createJuridica')->name('cliente.create.juridica')->middleware('role:juridicoAdmin');
	Route::get('cliente/inactivos', 'Juridico\ClienteController@inactivos')->name('cliente.index.inactivos')->middleware('role:juridicoAdmin');
	Route::post('cliente/activar', 'Juridico\ClienteController@activar')->name('cliente.activar')->middleware('role:juridicoAdmin');
	Route::resource('cliente', 'Juridico\ClienteController')->middleware('role:juridicoAdmin');
	
	//expedientes
	Route::get('expediente/create/manual', 'Juridico\ExpedienteController@createManual')->name('expediente.create.manual')->middleware('role:juridicoAdmin');
	Route::get('expediente/search', 'Juridico\ExpedienteController@search')->name('expediente.search')->middleware('role:juridicoAdmin');
	Route::post('expediente/permiso/{expediente}', 'Juridico\ExpedienteController@addPermiso')->name('expediente.addPermiso')->middleware('role:juridicoAdmin');
	Route::post('expediente/delpermiso/{expediente}', 'Juridico\ExpedienteController@delPermiso')->name('expediente.delPermiso')->middleware('role:juridicoAdmin');
	Route::resource('expediente', 'Juridico\ExpedienteController')->middleware('role:juridicoAdmin,invitado');
	
	//recordatorios
	Route::resource('recordatorio', 'Juridico\RecordatorioController')->middleware('role:juridicoAdmin,invitado');
	
	//reportes
	Route::post('reporte/expediente', 'Juridico\ReporteController@storeExpediente')->name('reporte.store.expediente')->middleware('role:juridicoAdmin');
	Route::get('reporte/create/expediente', 'Juridico\ReporteController@createExpediente')->name('reporte.create.expediente')->middleware('role:juridicoAdmin');
	Route::resource('reporte', 'Juridico\ReporteController')->middleware('role:juridicoAdmin');
	
	//Pasos expediente
	Route::get('paso/download/{archivo}', 'Juridico\PasoController@download')->name('paso.download')->middleware('role:juridicoAdmin,invitado');
	Route::get('paso/create/{expediente}/{paso}', 'Juridico\PasoController@create')->name('paso.create')->middleware('role:juridicoAdmin,invitado');
	Route::resource('paso', 'Juridico\PasoController',['except' => ['create']])->middleware('role:juridicoAdmin,invitado');
	
	//Archivos Paso
	Route::resource('archivo', 'Juridico\ArchivoController',['except' => ['create','edit','show','index','update']])->middleware('role:juridicoAdmin,invitado');
	
	//OCR
	Route::get('readocr', 'Juridico\OCRController@readOCR')->name('ocr.read');
	Route::post('readocr', 'Juridico\OCRController@ocrtext')->name('ocr.write');
	
	
});