@extends('layouts.layout_intranet')

@section('navbar')
<a class="navbar-brand" href="#"><strong>JURIDICO @yield('seccion')</strong></a>
@endsection

@section('menu-lateral')
<li>
    <a href="#"><i class="fas fa-users"></i> Clientes <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('cliente.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
			 <li><a href="{{ route('cliente.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
			<li><a href="{{ route('cliente.index.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
        </ul>
</li>

<li>
    <a href="#"><i class="fas fa-clipboard-list"></i> Reportes <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="#"><i class="fas fa-list-ul"></i> Listado</a></li>
			 <li><a href="#"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
        </ul>
</li>		
@endsection

@section('content')
<br>
<h1  class="text-success">Administración Juco - Jurídico</h1>
<hr>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-success">
			  <div class="panel-heading text-center"><h1><i class="fas fa-building"></i> Clientes</h1></div>
			  <div class="panel-body text-success">
					<a class="btn btn-success btn-block" href="{{ route('cliente.create') }}" role="button"><i class="fas fa-plus"></i> Agregar nuevo cliente</a>
					<a class="btn btn-success btn-block" href="{{ route('cliente.index') }}" role="button"><i class="fas fa-list-ul"></i> Listado de clientes activos</a>
					<a class="btn btn-success btn-block" href="{{ route('cliente.index.inactivos') }}" role="button"><i class="fas fa-list-ul"></i> Listado de clientes inactivos</a>
					
			  </div>
		</div>
	</div>
</div>

@endsection

