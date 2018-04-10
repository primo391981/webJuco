
<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->
@extends('layouts.layout_intranet')

<!--@section('titulo-seccion', 'Contenidos')

@section('active', 'active')-->

@section('menu-lateral')
<li><a href="{{ route('contenido.index') }}"><i class="fas fa-list-ul"></i> Listado</a></li>
<li><a href="{{ route('contenido.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>



<li>
    <a href="#"><i class="fas fa-th"></i> Contenedores <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('contenedor.index') }}"><i class="fas fa-list-ul"></i> Listado</a></li>
			 <li><a href="{{ route('contenedor.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>

        </ul>
</li>
@endsection

@section('content')
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<br>
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-info">
				  <div class="panel-heading text-center"><h4>Listado contenidos</h4></div>
				  <div class="panel-body text-info">					
					<div class="table-responsive">
						<table id="tablecontenidos" class="table"> <!--table-hover-->
							
							<thead>
							<tr>
								<th class="scope">ID</th>
								<th>Título</th>
								<th>Texto</th>
								<th>Ruta Archivo</th>
								<th>Imagen</th>
								<th>Texto Imagen</th>
								<th>Tipo</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach($contenidos as $contenido)						
							<tr>
								<td>{{$contenido->id}}</td>
								<td>{{$contenido->titulo}}</td>
								<td>{!!$contenido->texto!!}</td>
								<td>{{$contenido->filepath}}</td>
								<td>{{$contenido->imagen}}</td>
								<td>{{$contenido->alt_imagen}}</td>
								<td>{{$contenido->tipo}}</td>
								<td>
									<a href="{{ route('contenido.edit', ['contenido' => $contenido]) }}" data-toggle="tooltip" title="Editar"><i class="far fa-edit"></i></a> 
									<a href="#" data-toggle="tooltip" title="Eliminar"><i class="far fa-trash-alt"></i></a>
								</td>
							</tr>
						@endforeach
						</tbody>
						
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('contenido.create') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-plus"></i> Agregar nuevo</a></div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
    $('#tablecontenidos').DataTable();
} );
</script>
@endsection

