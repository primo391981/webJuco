
<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->

@extends('layouts.layout_intranet')

<!--@section('titulo-seccion', 'Contenedores')

@section('active', 'active')-->
@section('navbar')
<a class="navbar-brand" href="#"><strong>CMS - CONTENEDOR</strong></a>
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
	<div class="col-xs-12 visible-xs"><a href="{{ route('contenedor.create') }}" class="btn btn-info" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nuevo</a></div>				  
</div>

<div class="row text-info">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
			<div class="panel panel-info">
				  <div class="panel-heading">
				  <div class="row">
					<div class="col-sm-9"><h4>Listado contenedores (activos) ??</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('contenedor.create') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-plus"></i> Agregar nuevo</a></div>				  
				  </div>
				  </div>
				  
				  <div class="panel-body text-info">					
					<div class="table-responsive">
						<table class="table"> <!--table-hover-->
							<thead>
							<tr>
								<th>ID</th>
								<th>Título</th>
								<th>Tipo</th>
								<th>Órden Menú</th>
								<th>id Padre</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach($contenedores as $contenedor)						
						<tr>
							<td>{{$contenedor->id}}</td>
							<td>{{$contenedor->titulo}}</td>
							<td>{{$contenedor->tipo}}</td>
							<td>{{$contenedor->orden_menu}}</td>
							<td>{{$contenedor->id_padre}}</td>
							<td><a href="{{ route('contenedor.edit', ['contenedor' => $contenedor])}}" data-toggle="tooltip" title="Editar"><i class="far fa-edit"></i></a> <a href="#" data-toggle="tooltip" title="Eliminar"><i class="far fa-trash-alt"></i></a>
							</td>
						</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('contenedor.create') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-plus"></i> Agregar nuevo</a></div>
		</div>
	</div>
</div>	
@endsection

