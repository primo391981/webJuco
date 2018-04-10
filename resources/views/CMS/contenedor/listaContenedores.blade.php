
<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->

@extends('layouts.layout_intranet')

<!--@section('titulo-seccion', 'Contenedores')

@section('active', 'active')-->


@section('menu-lateral')
<li><a href="{{ route('contenedor.index') }}"><i class="fas fa-list-ul"></i> Listado</a></li>
<li><a href="{{ route('contenedor.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>



<li>
    <a href="#"><i class="fas fa-th"></i> Contenidos <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('contenido.index') }}"><i class="fas fa-list-ul"></i> Listado</a></li>
			 <li><a href="{{ route('contenido.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>

        </ul>
</li>
@endsection

                
@section('content')
<br>
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-info">
				  <div class="panel-heading text-center"><h4>Listado contenedores (activos) ??</h4></div>
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

