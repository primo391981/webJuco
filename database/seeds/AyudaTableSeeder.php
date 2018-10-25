<?php

use Illuminate\Database\Seeder;

class AyudaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ayuda')->insert([
            'ruta' => 'admin',
			'texto'=>'<p><strong>Selección de módulo</strong></p>
			<p>Ingrese al módulo</p>',
        ]);
		
		 DB::table('ayuda')->insert([
            'ruta' => 'cms',
			'texto'=>'<p>Administración de contenidos del sitio web</p>',
        ]);
		
		DB::table('ayuda')->insert([
            'ruta' => 'user.index',
			'texto'=>'<p><strong>Listado de usuarios activos</strong></p>
<p>Crear nuevo usuario en el sistema pulsar el botón <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i></button></p> 
<p>Filtrar datos: ingresar texto en el campo "Buscar".</p>
<p>Editar datos de usuario pulsar el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button></p>
<p>Eliminar usuario del sistema pulsar el botón <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></p>',
        ]);
		
		DB::table('ayuda')->insert([
            'ruta' => 'user.create',
			'texto'=>'<p><strong>Agregar nuevo usuario</strong></p>
<p>Completar los datos del forumlario, seleccionar los roles que se le van asignar al usuario y pulsar el botón <button type="button" class="btn btn-primary"><i class="fas fa-check"></i> Confirmar</button></p>',
        ]);
		
		DB::table('ayuda')->insert([
            'ruta' => 'user.index.inactivos',
			'texto'=>'<p><strong>Listado de usuarios inactivos</strong></p>
			<p>Filtrar datos: ingresar texto en el campo "Buscar".</p>
<p>Restaurar usuario: pulsar el botón <button type="button" class="btn btn-primary"><i class="fas fa-recycle"></i></button></p>',
        ]);
		
		DB::table('ayuda')->insert([
            'ruta' => 'menuitem.index',
			'texto'=>'<p><strong>Listado de menu items activos</strong></p>
<p>Crear nuevo menu item pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-plus"></i></button></p> 
<p>Filtrar datos: ingresar texto en el campo "Buscar".</p>
<p>Editar datos de menu item el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button></p>
<p>Eliminar menu item pulsar el botón <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></p>
<p>Cambiar orden del menu principal del sitio web: pulsar los botones <button type="button" class="btn btn-default"><i class="fas fa-level-up-alt"></i></button> y <button type="button" class="btn btn-default"><i class="fas fa-level-down-alt"></i></button></p>',
        ]);
		
		DB::table('ayuda')->insert([
            'ruta' => 'menuitem.create',
			'texto'=>'<p><strong>Agregar nuevo menu item</strong></p>
<p>Completar los datos del forumlario y pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-check"></i> Confirmar</button></p>',
        ]);
		
		DB::table('ayuda')->insert([
            'ruta' => 'menuitem.edit',
			'texto'=>'<p><strong>Modificar un menu item</strong></p>
<p>Completar los datos del forumlario y pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-check"></i> Confirmar</button></p>',
        ]);
		
		DB::table('ayuda')->insert([
            'ruta' => 'menuitem.index.inactivos',
			'texto'=>'<p><strong>Listado de menu item inactivos</strong></p>
<p>Restaurar menu item pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-recycle"></i></button></p>',
        ]);
		
		DB::table('ayuda')->insert([
            'ruta' => 'contenedor.index',
			'texto'=>'<p><strong>Listado contenedores activos</strong></p>
<p>Crear nuevo contenedor pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-plus"></i></button></p> 
<p>Filtrar datos: ingresar texto en el campo "Buscar".</p>
<p>Editar datos de contenedor pulsar el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button></p>
<p>Asociar contenido a contenedor pulsar el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button>, pulsar el boton <button type="button" class="btn btn-info"><i class="fas fa-plus"></i></button> buscar el contenido deseado y pulsar el botón <button type="button" class="btn btn-default"><i class="fas fa-check"></i></button></p>
<p>Eliminar contenedor pulsar el botón <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></p>',
        ]);
		
		DB::table('ayuda')->insert([
            'ruta' => 'contenedor.create',
			'texto'=>'<p><strong>Agregar nuevo contenedor</strong></p>
<p>Completar los datos del forumlario y pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-check"></i> Confirmar</button></p>',
        ]);
		
		DB::table('ayuda')->insert([
            'ruta' => 'contenedor.edit',
			'texto'=>'<p><strong>Editar un contenedor</strong></p>
<p>Completar los datos del forumlario y pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-check"></i> Confirmar</button></p>
<p>Asociar contenido a contenedor pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-plus"></i></button> buscar el contenido deseado y pulsar el botón <button type="button" class="btn btn-default"><i class="fas fa-check"></i></button></p>',
        ]);
		
		DB::table('ayuda')->insert([
            'ruta' => 'contenedor.index.inactivos',
			'texto'=>'<p><strong>Listado de menu item inactivos</strong></p>
<p>Restaurar menu item pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-recycle"></i></button></p>
<p><strong>Listado de contenedores inactivos</strong></p>
<p>Restaurar contenedor pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-recycle"></i></button></p>',
        ]);

    }
}
/*
ADMIN DE USUARIO











-------------------------------------------------------------------------------
<p><strong>Listado contenidos activos</strong></p>
<p>Crear nuevo contenido pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-plus"></i></button></p> 
<p>Filtrar datos: ingresar texto en el campo "Buscar".</p>
<p>Editar datos de contenido pulsar el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button></p>
<p>Eliminar contenido pulsar el botón <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></p>

<p><strong>Agregar nuevo contenido</strong></p>
<p>Completar los datos del forumlario y pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-check"></i> Confirmar</button></p>

<p><strong>Listado de contenidos inactivos</strong></p>
<p>Restaurar contenido pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-recycle"></i></button></p>


JURIDICO
<p><strong>Listado clientes activos</strong></p>
<p>Crear nuevo cliente pulsar el botón <button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button> y seleccionar el tipo de cliente.</p> 
<p>Filtrar datos: ingresar texto en el campo "Buscar".</p>
<p>Ver detalle cliente pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-info-circle"></i></button></p>
<p>Agregar archivo cliente pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-info-circle"></i></button>, luego <button type="button" class="btn btn-warning"><i class="fas fa-plus"></i></button> y pulsar <button type="button" class="btn btn-primary">guardar</button></p>
<p>Editar datos de cliente pulsar el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button></p>
<p>Eliminar cliente pulsar el botón <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></p>

<p><strong>Detalle cliente</strong></p>
<p>Agregar archivo cliente pulsar el botón  <button type="button" class="btn btn-warning"><i class="fas fa-plus"></i></button> cargar el archivo y pulsar <button type="button" class="btn btn-primary">guardar</button></p>
<p>Eliminar archivo pulsar boton <button type="button" class="btn btn-danger"><i class="fas fa-times"></i></button></p>
<p>Descargar archivo: presionar sobre el nombre del archivo</p>

<p><strong>Agregar nuevo cliente</strong></p>
<p>Completar los datos del forumlario y pulsar el botón <button type="button" class="btn btn-success"><i class="fas fa-check"></i> Confirmar</button></p>

<p><strong>Listado de clientes inactivos</strong></p>
<p>Restaurar cliente pulsar el botón <button type="button" class="btn btn-primary"><i class="fas fa-recycle"></i></button></p>
--------------------------------------------------------------------------------
<p><strong>Listado expedientes activos</strong></p>
<p>Crear nuevo expediente pulsar el botón <button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></p> 
<p>Filtrar datos: ingresar texto en el campo "Buscar".</p>
<p>Ver detalle expediente pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-info-circle"></i></button></p>
<p>Editar datos de expediente pulsar el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button> llenar el formulario y pulsar <button type="button" class="btn btn-success"><i class="fas fa-check"></i> Confirmar</button> </p>

<p><strong>Agregar nuevo expediente</strong></p>
<p>Completar los datos del forumlario con la IUE y pulsar el botón <button type="button" class="btn btn-success">Consultar</button>, completar el formulario con los datos correspondiente y pulsar <button type="button" class="btn btn-success">Guardar</button></p>

<p><strong>Detalle expediente</strong></p>
<p>Nuevo recordatorio: pulsar el botón <button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button> completar formulario y pulsar boton <button type="button" class="btn btn-primary">guardar</button></p>
<p>Eliminar recordatorio pulsar boton <button type="button" class="btn btn-danger"><i class="fas fa-times"></i></button></p>
<p>Ver pasos expedientes pulsar <button type="button" class="btn btn-primary">Transiciones</button></p>
<p>Ver pasos actual: pulsar boton junto al texto "PASO ACTUAL"</p>
<p>Siguiente paso: pulsar botón debajo del texto "SIGUIENTES PASOS", completar con los datos necesarios (archivos y descripcion) </p>
<p>Asignar nuevo usuario a expediente: pulsar botón <button type="button" class="btn btn-info"><i class="fas fa-plus"></i></button>, luego seleccionar usuario - permiso y pulsar  <button type="button" class="btn btn-primary">guardar</button></p>
<p>Eliminar usuario asigando pulsar boton <button type="button" class="btn btn-danger"><i class="fas fa-times"></i></button></p>
<p>Asignar nuevo archivo a expediente: pulsar botón <button type="button" class="btn btn-warning"><i class="fas fa-plus"></i></button>, luego seleccionar archivo y pulsar  <button type="button" class="btn btn-primary">guardar</button></p>
-----------------------------------------------------------------------------------
<p><strong>Texto OCR</strong></p>
<p>Seleccionar archivo y pulsar botón <button type="button" class="btn btn-success"><i class="fas fa-check"></i></button></p>
-----------------------------------------------------------------------------------------------
<p><strong>Listado Reportes</strong></p>
<p>Pulsar botón <button type="button" class="btn btn-info"><i class="fas fa-info-circle"></i></button> para ver detalle del reporte</p>
<p>Eliminar reporte pulsar el botón <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></p>

<p><strong>Nuevo Reportes</strong></p>
<p>Gernecial: llenar el formulario con las fechas correspondientes y pulsar <button type="button" class="btn btn-success">Confirmar</button></p>

<p><strong>Nuevo Reportes</strong></p>
<p>Expediente: Seleccionar el deseado y pulsar <button type="button" class="btn btn-default"><i class="fas fa-check"></i></button></p>
---------------------------------------------------------------------------
CONTABLE
<p><strong>Listado Empresas activas</strong></p>
<p>Crear nuva empresa pulsar el botón <button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></p> 
<p>Pulsar botón <button type="button" class="btn btn-info"><i class="fas fa-info-circle"></i></button> para ver detalle empresa</p>
<p>Eliminar empresa pulsar el botón <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></p>
<p>Filtrar datos: ingresar texto en el campo "Buscar".</p>
<p>Editar datos empresa pulsar el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button></p>

<p><strong>Agregar nueva empresa </strong></p>
<p>Completar los datos del forumlario y pulsar el botón <button type="button" class="btn btn-warning"><i class="fas fa-check"></i> Confirmar</button></p>

<p><strong>Listado de empresas inactivas</strong></p>
<p>Restaurar contenedor pulsar el botón <button type="button" class="btn btn-info"><i class="fas fa-recycle"></i></button></p>
-------------------------------------------------------
<p><strong>Listado Empleados activos</strong></p>
<p>Nuevo empleado pulsar el botón <button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></p> 
<p>Pulsar botón <button type="button" class="btn btn-info"><i class="fas fa-info-circle"></i></button> para ver detalle empleado</p>
<p>Eliminar empleado pulsar el botón <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></p>
<p>Filtrar datos: ingresar texto en el campo "Buscar".</p>
<p>Editar datos empleado pulsar el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button></p>

<p><strong>Detalle</strong></p>
<p>Asociar empleado a empresa pulsar boton <button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></p>
<p>Elimnar empleado de empresa pulsar boton <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></p>
<p>Editar datos contrato pulsar el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button> del titulo "DETALLE CONTRATO"</p>
<p>Editar datos horario pulsar el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button> del titulo "DETALLE HORARIO"</p>
<p>Ingreso de horario especial: llenar el formulario con los dias correspondientes y pulsar boton <button type="button" class="btn btn-success">Nuevo</button></p>
<p>Ver informacion de horarios especiales pulsar boton <button type="button" class="btn btn-info">Horarios</button></p>
<p>Elimnar horario especial  pulsar boton <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button> en el listado de horarios especiales</p>

<p><strong>Modificar contrato</strong></p>
<p>Completar el formulario y pulsar el boton <button type="button" class="btn btn-warning">Confirmar</button></p>

<p><strong>Modificar Horario</strong></p>
<p>Completar el formulario y pulsar el boton <button type="button" class="btn btn-warning">Confirmar horario</button></p>

<p><strong>Ingreso Horario especial</strong></p>
<p>Completar el formulario y pulsar el boton <button type="button" class="btn btn-warning">Confirmar horario</button></p>
------------------------------------------------------------------
<p><strong>Marcas Reloj</strong></p>
<p>Nueva marca reloj: seleccionar mes/año y pulsar el botón <button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></p> 
<p>Detalle marcas: seleccionar mes/año y Pulsar botón <button type="button" class="btn btn-info"><i class="fas fa-info-circle"></i></button> para ver detalle marcas</p>
<p>Filtrar datos: ingresar texto en el campo "Buscar".</p>
<p>Editar datos marcas: seleccionar mes/año y pulsar el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button></p>

<p><strong>Ingreso Marcas Reloj</strong></p>
<p>#I - referencia a la media hora descanso. Tildar si la media hora de descanso fue trabajada.</p>
<p>Completar el formulario con las horas trabajadas y pulsar botón <button type="button" class="btn btn-warning">Confirmar</button></p>
----------------------------------------------------------------------------------
<p><strong>Listado cargos activos</strong></p>
<p>Nuevo cargo pulsar el botón <button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></p> 
<p>Nuevo Salario nominal para un cargo pulsar el botón <button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button> junto al texto "SALARIO NOMINAL VIGENTE", compltar el formulario que se despliega y pulsar el botón <button type="button" class="btn btn-warning"><i class="fas fa-check"></i> Confirmar</button></p>
<p>Filtrar datos: ingresar texto en el campo "Buscar".</p>
<p>Editar datos cargo pulsar el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button></p>
<p>Eliminar cargo pulsar boton <button type="button" class="btn btn-danger"><i class="fas fa-times"></i></button></p>
 
<p><strong>Agregar nuevo cargo</strong></p>
<p>Completar los datos del forumlario y pulsar el botón <button type="button" class="btn btn-warning"><i class="fas fa-check"></i> Confirmar</button></p>

<p><strong>Modificar cargo</strong></p>
<p>Completar el formulario y pulsar el boton <button type="button" class="btn btn-warning"> Confirmar</button></p>
-------------------------------------------------------------------------------------------
<p><strong>Listado pagos activos</strong></p>
<p>Nuevo pago pulsar el botón <button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button></p> 
<p>Filtrar datos: ingresar texto en el campo "Buscar".</p>
<p>Editar datos pago pulsar el botón <button type="button" class="btn btn-warning"><i class="far fa-edit"></i></button></p>
<p>Eliminar pago pulsar boton <button type="button" class="btn btn-danger"><i class="fas fa-times"></i></button></p>
 
<p><strong>Agregar nuevo pago </strong></p>
<p>Completar los datos del forumlario y pulsar el botón <button type="button" class="btn btn-warning"><i class="fas fa-check"></i> Confirmar</button></p>

<p><strong>Modificar pago</strong></p>
<p>Completar el formulario y pulsar el boton <button type="button" class="btn btn-warning"> Confirmar</button></p>
------------------------------------------------------------------------------------------
<p><strong>Liquidación de haberes</strong></p>
<p>Completar el formulario con el tipo de haber a calcualr y pulsar el boton <button type="button" class="btn btn-warning"> Cargar Empleados</button></p>

<p><strong>Calcular sueldos</strong></p>
<p>Comprobar que todos los campos esten correctos y pulsar botón  <button type="button" class="btn btn-warning"> Calcular</button></p>
---------------------------------------------------------------------------------------------
<p><strong>Reportes</strong></p>
<p>Elegir el tipo de reporte, llenar el formulario correspondiente y pulsar <button type="button" class="btn btn-warning"> Ver reporte</button></p>
<p>Impresión de recibos por empresa: elegir el reporte correspondiente, llenar el formulario y pulsar <button type="button" class="btn btn-warning"> Descargar recibos</button></p>

*/