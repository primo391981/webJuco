@extends('layouts.layout_intranet')

@section('navbar')
<a class="navbar-brand" href="#"><strong>CONTABLE @yield('seccion')</strong></a>
@endsection

@section('menu-lateral')
<li>
    <a href="#"><i class="fas fa-th-large"></i> EMPRESAS <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('empresa.index') }}"><i class="fas fa-list-ul"></i> Listado</a></li>
			 <li><a href="{{ route('empresa.create') }}"><i class="fas fa-plus"></i> Agregar nueva</a></li>
        </ul>
</li>
<li>
    <a href="#"><i class="fas fa-th"></i> PARAMETROS <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="#"><i class="fas fa-list-ul"></i> Listado</a></li>
			 <li><a href="#"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
        </ul>
</li>
<li>
    <a href="#"><i class="fas fa-sitemap"></i> REPORTES <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="#"><i class="fas fa-list-ul"></i> Listado</a></li>
			 <li><a href="#"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
        </ul>
</li>		
@endsection

@section('content')
<br>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-info">
			  <div class="panel-heading text-center"><h1><i class="fas fa-th-large"></i> EMPRESAS</h1></div>
			  <div class="panel-body text-info">
				<a href="{{ route('empresa.index') }}"><i class="fas fa-list-ul"></i> Listado</a><br>
				<p>poner todas las funcionalidades de contenedor como en el menu lateral</p><br>
				<p>colocar todas las vistas en una.Ya mostrar el form de agregar/ listado de contenedores </p>
			  </div>
			  <!--<div class="panel-footer"><a href="{{ route('cms') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-sign-in-alt"></i> Ingresar</a></div>-->
		</div>
		
		
	</div>
	<div class="col-xs-12 col-sm-4">
		<div class="panel panel-info">
			  <div class="panel-heading text-center"><h1><i class="fas fa-th"></i> PARAMETROS</h1></div>
			  <div class="panel-body text-info">
				<a href="#"><i class="fas fa-list-ul"></i> Listado</a><br>
				<p>poner todas las funcionalidades de contenedor como en el menu lateral</p><br>
				<p>colocar todas las vistas en una.Ya mostrar el form de agregar/ listado de contenedores </p>
			  </div>
			  <!--<div class="panel-footer"><a href="{{ route('cms') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-sign-in-alt"></i> Ingresar</a></div>-->
		</div>
	</div>
	<div class="col-xs-12 col-sm-4">
		<div class="panel panel-info">
			  <div class="panel-heading text-center"><h1><i class="fas fa-th"></i> REPORTES</h1></div>
			  <div class="panel-body text-info">
				<a href="#"><i class="fas fa-list-ul"></i> Listado</a><br>
				<p>poner todas las funcionalidades de contenedor como en el menu lateral</p><br>
				<p>colocar todas las vistas en una.Ya mostrar el form de agregar/ listado de contenedores </p>
			  </div>
			  <!--<div class="panel-footer"><a href="{{ route('cms') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-sign-in-alt"></i> Ingresar</a></div>-->
		</div>
	</div>
</div>

@endsection

