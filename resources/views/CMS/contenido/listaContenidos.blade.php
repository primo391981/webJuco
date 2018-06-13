@extends('cms.cms')

@section('seccion', " - Contenidos")

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('contenido.create') }}" class="btn btn-info" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nuevo</a></div>				  
</div>
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-info">
				  <div class="panel-heading text-center">
					<div class="row">
						<div class="col-sm-9"><h4>Listado contenidos</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('contenido.create') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-plus"></i> Agregar nuevo</a></div>				  
					</div>
				  </div>
				  <div class="panel-body text-info">					
					<div class="table-responsive">
						<table id="tablecontenidos" class="table"> <!--table-hover-->
							
							<thead>
							<tr>
								<th class="scope">ID</th>
								<th>Título</th>
								<th>Texto</th>
								<th>Archivo</th>
								<th>Imagen</th>
								<th>Texto Imagen</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach($contenidos as $contenido)						
							<tr>
								<td>{{$contenido->id}}</td>
								<td>{{$contenido->titulo}}</td>
								<td>{!!$contenido->texto!!}</td>
								<td><a href="{{ asset($contenido->archivo) }}">{{ $contenido->nombre_archivo }}</a></td>
								<td>
									@if($contenido->archivo!="")
										<img src="{{ asset ($contenido->imagen) }}" height="40">
									@endif
								</td>
								<td>{{$contenido->alt_imagen}}</td>
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

