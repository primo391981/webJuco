@extends('layouts.layout_intranet')

@section('navbar')
<a class="navbar-brand" href="#"><strong>JURIDICO @yield('seccion')</strong></a>
@endsection

@section('menu-lateral')
@if(Auth::user()->hasRole('juridicoAdmin'))
<li>
    <a href="#"><i class="fas fa-users"></i> Clientes <i class="fas fa-caret-down"></i></a>
	<ul class="nav nav-second-level">
		<li><a href="{{ route('cliente.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
		<li>
			<a href="#"><i class="fas fa-plus"></i> Agregar nuevo <i class="fas fa-caret-down"></i></a>
			<ul class="nav nav-third-level">
				<li><a name="juridico" href="{{ route('cliente.create.juridica')}}"><i class="far fa-building"></i> Persona Jurídica</a></li>
				<li><a name="fisico" href="{{ route('cliente.create.fisica')}}"><i class="fas fa-user"></i> Persona Física</a></li>
			</ul>
		</li>
		<li><a href="{{ route('cliente.index.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
	</ul>
</li>
@endif
<li>
    <a href="#"><i class="fas fa-book"></i> Expedientes <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('expediente.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
			 @if(Auth::user()->hasRole('juridicoAdmin'))<li><a href="{{ route('expediente.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>@endif
        </ul>
</li>
@if(Auth::user()->hasRole('juridicoAdmin'))
<li>
    <a href="#"><i class="fas fa-clipboard-list"></i> Reportes <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			<li><a href="{{ route('reporte.index') }}"><i class="fas fa-list-ul"></i> Listado</a></li>
			<li>
				<a href="#"><i class="fas fa-plus"></i> Agregar nuevo <i class="fas fa-caret-down"></i></a>
				<ul class="nav nav-third-level">
					<li><a name="gerencial" href="{{ route('reporte.create')}}"><i class="far fa-building"></i> Gerencial</a></li>
					<li><a name="expediente" href="{{ route('reporte.create.expediente')}}"><i class="fas fa-book"></i> de Expediente</a></li>
				</ul>
			</li>
        </ul>
</li>
@endif		
@endsection

@section('content')
<br>
<div class="row">
	<div class="col-xs-12 text-center">
		<h3>Bienvenido a la administración jurídica</h3>
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4">
	 @if(Auth::user()->hasRole('juridicoAdmin'))
		<div class="panel panel-success">
			  <div class="panel-heading text-center"><h1><i class="fas fa-users"></i> Clientes</h1></div>
				  <div class="panel-body text-success">
				  <p>Esta sección esta dirgida a la organización de los clientes, los cuales se representan mediante <i class="fas fa-user"></i> Persona Física o <i class="far fa-building"></i> Persona Jurídica.<br>
				  <br><br><br></p>
				  <strong>Funcionalidades</strong><br>
				  <a href="{{ route('cliente.index') }}" role="button"><i class="fas fa-list-ul"></i> Listado de clientes activos</a><br><br>
				  
					<a>Agregar nuevo cliente</a><br>
					&nbsp;&nbsp;&nbsp;&nbsp;<a name="juridico" href="{{ route('cliente.create.juridica')}}"><i class="far fa-building"></i> Persona Jurídica</a><br>
					&nbsp;&nbsp;&nbsp;&nbsp;<a name="fisico" href="{{ route('cliente.create.fisica')}}"><i class="fas fa-user"></i> Persona Física</a><br><br>
						<a href="{{ route('cliente.index.inactivos') }}"><i class="fas fa-list-ul"></i>Listado de clientes Inactivos</a>
				  </div>
		</div>
	@endif
	</div>


	<div class="col-xs-12 col-sm-12 col-md-4">
	 @if(Auth::user()->hasRole('juridicoAdmin'))
		<div class="panel panel-success">
			  <div class="panel-heading text-center"><h1><i class="fas fa-book"></i> Expedientes</h1></div>
				  <div class="panel-body text-success">
						<p>
						Gestión y administración de expedientes judiciales desde el principo del proceso hasta su fin asociado al tipo de materia (Penal, Civil, Laboral y Familia).
						<br>
						Conexión con el sistema del Poder Judicial para el inicio de cada proceso en la creación de un expediente.
						</p><br>
						<strong>Funcionalidades</strong><br>
						 <a href="{{ route('expediente.index') }}"><i class="fas fa-list-ul"></i> Listado de expedientes Activos</a><br><br>
							<a href="{{ route('expediente.create') }}"><i class="fas fa-plus"></i> Agregar nuevo expediente</a>
							<br><br><br><br><br>
				  </div>
		</div>
	@endif
	</div>


	<div class="col-xs-12 col-sm-12 col-md-4">
	 @if(Auth::user()->hasRole('juridicoAdmin'))
		<div class="panel panel-success">
			  <div class="panel-heading text-center"><h1><i class="fas fa-clipboard-list"></i> Reportes</h1></div>
				  <div class="panel-body text-success">
						<p>Es un resumen bien puntual del comportamiento de los diferentes expediente y gerenciamiento donde se pueden hacer comparativas en el tiempo por fechas de inicio y fin.<br>Estos informes se resumen en planificar, coordinar, dirigir desde un histórico y allí evaluar los comportamientos.<br><br>
						</p>
						<strong>Funcionalidades</strong><br>
						 <a href="{{ route('reporte.index') }}"><i class="fas fa-list-ul"></i> Listado de reportes historicos</a><br><br>
							<a href="#"> Agregar nuevo reporte</a><br>
				
							&nbsp;&nbsp;&nbsp;&nbsp;<a name="gerencial" href="{{ route('reporte.create')}}"><i class="far fa-building"></i> Gerencial</a><br>
							&nbsp;&nbsp;&nbsp;&nbsp;<a name="expediente" href="#"><i class="fas fa-book"></i> de Expediente</a>
							<br><br><br>
				  </div>
		</div>
	@endif
	</div>
</div>
@endsection

