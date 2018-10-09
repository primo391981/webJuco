@extends('layouts.layout_intranet')

@section('navbar')
<a class="navbar-brand" href="#"><strong>CMS @yield('seccion')</strong></a>
@endsection

@section('menu-lateral')
<li>
    <a href="#"><i class="fas fa-th-large"></i> Contenedores <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('contenedor.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
			 <li><a href="{{ route('contenedor.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
			 <li><a href="{{ route('contenedor.index.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
        </ul>
</li>
<li>
    <a href="#"><i class="fas fa-th"></i> Contenidos <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('contenido.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
			 <li><a href="{{ route('contenido.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
			 <li><a href="{{ route('contenido.index.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
        </ul>
</li>
<li>
    <a href="#"><i class="fas fa-sitemap"></i> Items menú <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('menuitem.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
			 <li><a href="{{ route('menuitem.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
			 <li><a href="{{ route('menuitem.index.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
        </ul>
</li>		
@endsection

@section('content')
<br>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="panel panel-info">
			  <div class="panel-heading text-center"><h1><i class="fas fa-th-large"></i> Contenedores</h1></div>
			  <div class="panel-body text-info">
				<a href="{{ route('contenedor.index') }}"><i class="fas fa-list-ul"></i> Listado</a><br>
				<p>poner todas las funcionalidades de contenedor como en el menu lateral</p><br>
				<p>colocar todas las vistas en una.Ya mostrar el form de agregar/ listado de contenedores </p>
			  </div>
			  <!--<div class="panel-footer"><a href="{{ route('cms') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-sign-in-alt"></i> Ingresar</a></div>-->
		</div>
		
		
	</div>
	<div class="col-xs-12 col-sm-6">
		<div class="panel panel-info">
			  <div class="panel-heading text-center"><h1><i class="fas fa-th"></i> Contenidos</h1></div>
			  <div class="panel-body text-info">
				<a href="{{ route('contenido.index') }}"><i class="fas fa-list-ul"></i> Listado</a><br>
				<p>poner todas las funcionalidades de contenedor como en el menu lateral</p><br>
				<p>colocar todas las vistas en una.Ya mostrar el form de agregar/ listado de contenedores </p>
			  </div>
			  <!--<div class="panel-footer"><a href="{{ route('cms') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-sign-in-alt"></i> Ingresar</a></div>-->
		</div>
	</div>
</div>

@endsection

