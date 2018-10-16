@extends('cms.cms')

@section('seccion', " - INACTIVOS")

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
					<a href="{{ route('contenido.index') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-list"></i></a>				  
				</div>
				<h4><i class="fas fa-th-large"></i> LISTADO CONTENIDOS INACTIVOS</h4>
			</div>
			<div class="panel-body text-muted">					
				<div class="table-responsive">
					<table class="table" id="tableContenido"> 
						<thead>
						<tr>
							<th>#</th>
							<th>Título</th>
							<th>texto</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@foreach($contenidos as $contenido)						
						<tr>
							<td>{{$contenido->id}}</td>
							<td>{{$contenido->titulo}}</td>
							<td>{{$contenido->texto}}</td>
							<td>
								<form method="POST" action="{{ route('contenido.activar') }}">
									@csrf	
									<input type="hidden" name="contenido_id" value="{{$contenido->id}}">
									<button type="submit"class="btn btn-danger"><i class="fas fa-recycle"></i></button>												
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
		dom: '<"top"f>t<"bottom"p><"clear">',
        
    } );
	
	
} );
</script>



@endsection