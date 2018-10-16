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
<h1  class="text-success">Administración Juco - Jurídico</h1>
<hr>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4">
	 @if(Auth::user()->hasRole('juridicoAdmin'))
		<div class="panel panel-success">
			  <div class="panel-heading text-center"><h1><i class="fas fa-building"></i> Clientes</h1></div>
				  <div class="panel-body text-success">
						<a class="btn btn-success btn-block" href="{{ route('cliente.create') }}" role="button"><i class="fas fa-plus"></i> Agregar nuevo cliente</a>
						<a class="btn btn-success btn-block" href="{{ route('cliente.index') }}" role="button"><i class="fas fa-list-ul"></i> Listado de clientes activos</a>
						<a class="btn btn-success btn-block" href="{{ route('cliente.index.inactivos') }}" role="button"><i class="fas fa-list-ul"></i> Listado de clientes inactivos</a>
				  </div>
		</div>
	@endif
	</div>
</div>

@endsection

