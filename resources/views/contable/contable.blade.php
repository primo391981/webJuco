@extends('layouts.layout_intranet')

@section('navbar')
<a class="navbar-brand" href="#"><strong>CONTABLE @yield('seccion')</strong></a>
@endsection

@section('menu-lateral')
<li>
    <a href="#"><i class="fas fa-building"></i> Empresas <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('empresa.index') }}"><i class="fas fa-list-ul"></i> Activas</a></li>
			 <li><a href="{{ route('empresa.create') }}"><i class="fas fa-plus"></i> Agregar nueva</a></li>
			<li><a href="{{ route('empresa.desactivada') }}"><i class="fas fa-list-ul"></i> Inactivas</a></li>
        </ul>
</li>
<li>
    <a href="#"><i class="fas fa-users"></i> Empleados <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			<li><a href="{{ route('persona.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
			<li><a href="{{ route('persona.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
			<li><a href="{{ route('persona.desactivado') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
		</ul>
</li>
<li>
    <a href="{{ route('reloj.listaEmpleados') }}"><i class="fas fa-clock"></i> Marcas reloj </a>
</li>
<li>
    <a href="#"><i class="fas fa-briefcase"></i> Cargos <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('cargo.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
			 <li><a href="{{ route('cargo.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
			 <li><a href="{{ route('cargo.index.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
        </ul>
</li>
<li>
    <a href="#"><i class="fas fa-money-bill-alt"></i> Pagos <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			<li>
				<a href="#"><i class="fas fa-credit-card"></i> Adelantos <i class="fas fa-caret-down"></i></a>
					<ul class="nav nav-third-level">
						<li><a href="{{ route('pago.adelantos') }}"><i class="fas fa-list-ul"></i> Activos</a></li>	
						<li><a href="{{ route('pago.create',['idTipo' => 2]) }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
						<li><a href="{{ route('pago.adelantos.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
					</ul>					
			</li>
			<li>
				<a href="#"><i class="fas fa-book"></i> Viáticos <i class="fas fa-caret-down"></i></a>
					<ul class="nav nav-third-level">
						<li><a href="{{ route('pago.viaticos') }}"><i class="fas fa-list-ul"></i> Activos</a></li>	
						<li><a href="{{ route('pago.create', ['idTipo' => 1]) }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
						<li><a href="{{ route('pago.viaticos.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
					</ul>
			</li>
			<li>
				<a href="#"><i class="fas fa-dollar-sign"></i> Partidas Extras <i class="fas fa-caret-down"></i></a>
					<ul class="nav nav-third-level">
						<li><a href="{{ route('pago.extras') }}"><i class="fas fa-list-ul"></i> Activas</a></li>	
						<li><a href="{{ route('pago.create', ['idTipo' => 3]) }}"><i class="fas fa-plus"></i> Agregar nueva</a></li>
						<li><a href="{{ route('pago.extras.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivas</a></li>
					</ul>
			</li>
			<li>
				<a href="#"><i class="fas fa-dollar-sign"></i> Fictos <i class="fas fa-caret-down"></i></a>
					<ul class="nav nav-third-level">
						<li><a href="{{ route('pago.fictos') }}"><i class="fas fa-list-ul"></i> Activos</a></li>	
						<li><a href="{{ route('pago.create', ['idTipo' => 4]) }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
						<li><a href="{{ route('pago.fictos.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
					</ul>
			</li>
        </ul>
</li>
<li>
    <a href="{{ route('haberes.index') }}"><i class="fas fa-hand-holding-usd"></i> Liquidación de Haberes</a>
		
</li>
<li>
    <a href="#"><i class="fas fa-cogs"></i> Parametros Generales <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('parametrogeneral.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
			 <li><a href="{{ route('parametrogeneral.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
			 <li><a href="{{ route('parametrogeneral.index.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
        </ul>
</li>
<li>
    <a href="{{route ('reportes.listadoReportes')}}"><i class="fas fa-clipboard-list"></i> Reportes </a>
</li>		
@endsection

@section('content')
<br>
<div class="row">
	<div class="col-xs-12 text-center">
		<h3>Bienvenido a la administración contable</h3>
		<hr>
	</div>
</div>
<div class="row">
	
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-warning">
			  <div class="panel-heading text-center"><h1><i class="fas fa-building"></i> Empresas</h1></div>
			  <div class="panel-body text-warning">
					<p>Sección dedicada a la organización de las empresas, donde cada empresa sera identificada por su RUT, Grupo y Subgrupo de las categorias según el ministerio de trabajo y seguridad social.</p>
					<p><strong>Funcionalidades:</strong></p>
					<p><i class="fas fa-list-ul"></i> Listado de empresas Activas</p>
					<p><i class="fas fa-plus"></i> Agregar nueva empresa</p>
					<p><i class="fas fa-edit"></i> Modificar empresa</p>
					<p><i class="fas fa-trash-alt"></i> Eliminar empresa</p>
					<p><i class="fas fa-list-ul"></i>Listado de empresas Inactivas</p>				
			  </div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-warning">
			  <div class="panel-heading text-center"><h1><i class="fas fa-users"></i> Empleados</h1></div>
			  <div class="panel-body text-warning">
					<p>Empleados es la sección para la adminsitación de cada empleado por <i class="fas fa-building"></i> empresa donde se le asigna un contrato de trabajo y la carga de <i class="fas fa-clock"></i> marcas reloj.</p>
					<p><strong>Funcionalidades:</strong></p>
					<p><i class="fas fa-list-ul"></i> Listado de empelados activos</p>
					<p><i class="fas fa-plus"></i> Agregar nuevo empleado</p>
					<p><i class="fas fa-list-ul"></i> Listado de empleados Inactivos</p>
					<p><i class="fas fa-handshake"></i> Asociar empleado a una empresa</p>
					<br>
			  </div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-warning">
			  <div class="panel-heading text-center"><h1><i class="fas fa-clock"></i> Marcas Reloj</h1></div>
			  <div class="panel-body text-warning">
					<p>Las marcas reloj vienen asociadas a las cargar horaria realizada por un <i class="fas fa-user"></i> empleado en su jornada de trabajo. Dependiendo del tipo de contrato de trabajo (Mensual o Jornalero) que tenga el <i class="fas fa-user"></i> empleado es la forma en la cual se cargan las horas.</p>
					<p><strong>Funcionalidades:</strong></p>
					<p><i class="fas fa-info"></i> Ver las marcas reloj cumplidas por un empleado en un mes/año</p>
					<p><i class="fas fa-plus"></i> Agregar marcas reloj a un empleado en un mes/año</p>
					<p><i class="fas fa-edit"></i> Modificar las marcas reloj cumplidas por un empleado en un mes/año</p>
			  </div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-warning">
			  <div class="panel-heading text-center"><h1><i class="fas fa-briefcase"></i> Cargos</h1></div>
			  <div class="panel-body text-warning">
					<p>Los cargos/categorias vienen asociadas al puesto de trabajo que desempeña el <i class="fas fa-user"></i> empleado dentro de la <i class="fas fa-building"></i> empresa. Cada cargo esta asociado al salario minimo nacional que es fijado por ley.</p>
					<br><br><strong>Funcionalidades:</strong><br>
					<p><i class="fas fa-list-ul"></i> Listado de cargos Activos</p>
					<p><i class="fas fa-plus"></i> Agregar nuevo cargo junto con su salario minimo nacional</p>
					<p><i class="fas fa-list-ul"></i> Listado de cargos Inactivos</p>
			  </div>
		</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-warning">
			  <div class="panel-heading text-center"><h1><i class="fas fa-money-bill-alt"></i> Pagos</h1></div>
			  <div class="panel-body text-warning">
					<p>La sección hace referencia al beneficio que se le otorga a cada <i class="fas fa-user"></i> empleado dentro de la <i class="fas fa-building"></i> empresa. Se manejan cuatro tipos de pago: Adelanto, Viáticos, Partidas extras y Fictos.</p>
					<p><strong>Funcionalidades:</strong></p>
					<p><i class="fas fa-list-ul"></i> Listado de pagos a los empleados</p>
					<p><i class="fas fa-plus"></i> Agregar nuevo pago</p>
					<p><i class="fas fa-list-ul"></i> Listado de pagos Inactivos</p>
			  </div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-warning">
			  <div class="panel-heading text-center"><h1><i class="fas fa-hand-holding-usd"></i> Liquidación de Haberes</h1></div>
			  <div class="panel-body text-warning">
					<p>Liquidación de haberes de los <i class="fas fa-user"></i> empleado por <i class="fas fa-building"></i> empresas. Cálculo de Sueldo, Aguinaldo, Salario Vacacional y Liquidación final.</p>
					<p><strong>Funcionalidades:</strong></p>
					<p>Creacion de recibo por empleado según del tipo de haber.</p>
					
			  </div>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-warning">
			  <div class="panel-heading text-center"><h1><i class="fas fa-cogs"></i> Parametros Generales</h1></div>
			  <div class="panel-body text-warning">
					<p>Sección dedicada al mantenimiento de parámetros utilizados para el cálculo de <i class="fas fa-hand-holding-usd"></i> liquidación de haberes. Mantenimineto de fechas de vigencias, rangos, porcentajes.</p>
					<p><strong>Funcionalidades:</strong></p>
					<p><i class="fas fa-list-ul"></i> Activos</p>
					<p><i class="fas fa-plus"></i> Agregar nuevo</p>
					<p><i class="fas fa-list-ul"></i> Inactivos</p>
			  </div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-warning">
			  <div class="panel-heading text-center"><h1><i class="fas fa-clipboard-list"></i> Reportes</h1></div>
			  <div class="panel-body text-warning">
					<p>Reportes de información en forma de gráficos junto con la impresión de los recibos calculados en la <i class="fas fa-hand-holding-usd"></i> liquidación de Haberes</p>
					<p><strong>Funcionalidades:</strong></p>
					<p>Visualizar reportes gráficos</p>
					<p>Impresión de recibos</p>
					
			  </div>
		</div>
	</div>
	
</div>

@endsection

