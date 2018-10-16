@extends('cms.cms')

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
					<a href="{{ route('contenedor.index') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-list"></i></a>				  
				</div>
				<h4><i class="fas fa-th-large"></i> LISTADO CONTENEDORES INACTIVOS</h4>
			</div>
			<div class="panel-body text-muted">					
				<div class="table-responsive">
					<table class="table" id="tableContenedor"> 
						<thead>
						<tr>
							
							<th>TITULO</th>
							<th>TIPO</th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@foreach($contenedores as $contenedor)						
						<tr>
							<td>{{$contenedor->titulo}}</td>
							<td>{{$contenedor->tipoContenedor->nombre}}</td>
							
							<td>
								<form method="POST" action="{{ route('contenedor.activar') }}">
										@csrf	
										<input type="hidden" name="contenedor_id" value="{{$contenedor->id}}">
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
    $('#tableContenedor').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: '<"top"f>t<"bottom"p><"clear">',
       
    } );
	
	
} );
</script>



@endsection