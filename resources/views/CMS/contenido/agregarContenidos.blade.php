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
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('contenido.index') }}" class="btn btn-info" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado contenidos</a></div>				  
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-9"><h4>Agregar nuevo contenido</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('contenido.index') }}" class="btn btn-info" role="button"><i class="fas fa-list-ul"></i> Listado contenidos</a></div>
				</div>
			</div>
			<div class="panel-body text-info">
				<form method="POST" action="{{ route('contenido.store') }}"class="form-horizontal">
				@include('cms.contenido.formContenido', ['textoBoton' => 'Confirmar'])
				</form>
			</div>
			<div class="panel-footer"><a href="{{ route('contenido.index') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-list-ul"></i> Listado contenidos</a></div>
		</div>
	</div>
	
</div>
    
	
				
@endsection

