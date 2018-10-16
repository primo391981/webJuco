@extends('layouts.layout_intranet')

@section('navbar')
<a class="navbar-brand" href="#"><strong>ADMIN USUARIOS</strong></a>
@endsection
@section('menu-lateral')
<li><a href="{{ route('user.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
<li><a href="{{ route('user.create') }}"><i class="fas fa-user-plus"></i> Agregar nuevo</a></li>
<li><a href="{{ route('user.index.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12 text-center">
		<h3>Bienvenido a la administración de usuarios </h3>
		<hr>
	</div>
</div>					
<div class="row">
			  <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
				<div class="panel panel-info">
				  <div class="panel-heading text-center"><h1><i class="fas fa-users"></i> Usuarios</h1></div>
				  <div class="panel-body">
					<p>La administración de cuentas de usuario es una parte esencial para el funcionamiento y seguridad del sistema.<br>
					La razón principal para las cuentas de usuario es verificar la identidad de cada individuo, otra de las rezones importantes es la de permitir la utilización personalizada de recursos y privilegios de acceso.<br>
					La aplicación web cuenta con cuatro tipos de roles los cuales tienen diferente tipo de acceso en el sistema.<br>
					<strong>Roles:</strong><br>
					1- cmsAdmin: acceso al módulo de administración del sitio web.<br>
					2- juridicoAdmin: acceso al módulo de gestión jurídica.<br>
					3- contableAdmin: acceso al módulo de administración contable.<br>
					4- invitado: acceso al módulo de gestión jurídica con permisos de lectura y/o escritura.<br><br>
					Cada usuario del sistema puede tener asigando uno o varios roles.<br><br>
					<strong>Funcionalidades:</strong><br>
					<a href="{{ route('user.index') }}"><i class="fas fa-list-ul"></i> Listado de usuarios Activos en el sistema.</a><br><br>
					<a href="{{ route('user.create') }}"><i class="fas fa-user-plus"></i> Agregar nuevo usuario al sistema.</a><br><br>
					<a href="{{ route('user.index.inactivos') }}"><i class="fas fa-list-ul"></i> Listado de usuarios Inactivos en el sistema.</a>
					</p>
				  </div>
				</div>
			  </div>
</div>
@endsection

