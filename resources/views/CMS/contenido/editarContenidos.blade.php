
<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->
@extends('layouts.layout_intranet')

<!--@section('titulo-seccion', $subtitulo)

@section('active', 'active')-->
@section('navbar')
<a class="navbar-brand" href="#"><strong>CMS - CONTENIDO</strong></a>
@endsection
@section('menu-lateral')
<li>
    <a href="#"><i class="fas fa-th-large"></i> Contenedores <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('contenedor.index') }}"><i class="fas fa-list-ul"></i> Listado</a></li>
			 <li><a href="{{ route('contenedor.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
        </ul>
</li>
<li>
    <a href="#"><i class="fas fa-th"></i> Contenidos <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('contenido.index') }}"><i class="fas fa-list-ul"></i> Listado</a></li>
			 <li><a href="{{ route('contenido.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
        </ul>
</li>
<li>
    <a href="#"><i class="fas fa-sitemap"></i> Items menú <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="#"><i class="fas fa-list-ul"></i> Listado</a></li>
			 <li><a href="#"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
        </ul>
</li>		
@endsection
@section('content')
<br>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading text-center"><h4>Editar Contenido</h4></div>
			<div class="panel-body text-info">
				<form method="POST" action="{{ route('contenido.update', ['contenido' => $contenido]) }}" class="form-horizontal">
				{{ method_field('PUT') }}
				@include('cms.contenido.formContenido', ['textoBoton' => 'Confirmar'])
				</form>
				
			</div>
			<div class="panel-footer"><a href="{{ route('contenido.index') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-list-ul"></i> Listado contenidos</a></div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading text-center"><h4>Contenedores</h4></div>
			<div class="panel-body text-info">
				<!--<form method="POST" action="{{ route('contenido.update', ['contenido' => $contenido]) }}" class="form-horizontal">
				{{ method_field('PUT') }}
				@include('cms.contenido.formContenido', ['textoBoton' => 'Confirmar'])
				</form>-->
				
			</div>
			<!--<div class="panel-footer"><a href="{{ route('contenido.index') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-list-ul"></i> Listado contenidos</a></div>
			-->
		</div>
	</div>
	
	
</div>	
				
@endsection

