@extends('layouts.layout_intranet')

@section('navbar')
<a class="navbar-brand" href="#"><strong>CONTABLE @yield('seccion')</strong></a>
@endsection

@section('menu-lateral')
<li>
    <a href="#"><i class="fas fa-building"></i> Empresas <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('empresa.index') }}"><i class="fas fa-list-ul"></i> Listado</a></li>
			 <li><a href="{{ route('empresa.create') }}"><i class="fas fa-plus"></i> Agregar nueva</a></li>
        </ul>
</li>
<li>
    <a href="#"><i class="fas fa-cogs"></i> Parametros <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="#"><i class="fas fa-list-ul"></i> Listado</a></li>
			 <li><a href="#"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
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
<h1  class="text-warning">Administración Juco - Contable</h1>
<hr>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-warning">
			  <div class="panel-heading text-center"><h1><i class="fas fa-building"></i> Empresas</h1></div>
			  <div class="panel-body text-warning">
					<a class="btn btn-warning btn-block" href="{{ route('empresa.create') }}" role="button"><i class="fas fa-plus"></i> Agregar nueva empresa</a>
					<a class="btn btn-warning btn-block" href="{{ route('empresa.index') }}" role="button"><i class="fas fa-list-ul"></i> Listado de empresas</a>
			  </div>
		</div>
		
		
	</div>
	<div class="col-xs-12 col-sm-4">
		<div class="panel panel-warning">
			  <div class="panel-heading text-center"><h1><i class="fas fa-cogs"></i> Parametros</h1></div>
			  <div class="panel-body text-warning">
				
			  </div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4">
		<div class="panel panel-warning">
			  <div class="panel-heading text-center"><h1><i class="fas fa-clipboard-list"></i> Reportes</h1></div>
			  <div class="panel-body text-warning">
				
			  </div>
		</div>
	</div>
</div>

@endsection
