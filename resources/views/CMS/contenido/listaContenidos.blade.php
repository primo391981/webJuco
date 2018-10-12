@extends('cms.cms')

@section('seccion', " - Contenidos")

@section('content')

@if (Session::has('success'))
	<br>
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif 
@if (Session::has('error'))
	<br>
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div>
@endif 
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="btn-group pull-right">	
					<a href="{{ route('contenido.create') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-plus"></i></a>				  
				</div>
				<h4><i class="fas fa-th-large"></i> LISTADO CONTENIDOS</h4>
			</div>
			<div class="panel-body text-muted">					
				<div class="table-responsive">
					<table class="table" id="tableContenido"> 
						<thead>
							<tr>
								<th>#</th>
								<th>Título</th>
								<th>Texto</th>
								<th>Archivo</th>
								<th>Imagen</th>
								<th></th>
								<th></th>
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
								<td>
									<a class="btn btn-warning" href="{{ route('contenido.edit', ['contenido' => $contenido]) }}" title="Editar"><i class="far fa-edit"></i></a> 
								</td>
								<td>
									<form method="POST" action="{{ route('contenido.destroy', $contenido) }}" class="form-avoid-double-submit">
										@method('DELETE')
										@csrf
										@if($contenido->contenedor->count() > 0)
											<fieldset disabled>
										@endif
										<button type="submit"class="btn btn-danger btn-avoid-double-submit"><i class="far fa-trash-alt"></i></button>
										@if($contenido->contenedor->count() > 0)
											</fieldset>
										@endif												
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
    $('#tableContenido').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: '<"top"f>t<"bottom"Bpi><"clear">',
        buttons: [
           { extend: 'print', text: 'IMPRIMIR' },
		   { extend: 'pdf', text: 'PDF' },		   
		   { extend: 'excel', text: 'EXCEL' },
		   { extend: 'copy', text: 'COPIAR TABLA' }
        ]
    } );
} );
</script>
@endsection

