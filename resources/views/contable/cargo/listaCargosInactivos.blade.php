@extends('contable.contable')

@section('seccion', " - INACTIVOS")

@section('content')
<script>
$(document).ready(function() {
    $('#tableCargos').DataTable( {        
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
<br>
@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif 
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				  <div class="panel-heading">
					<div class="row">
						<div class="col-sm-9"><h4>LISTADO CARGOS INACTIVOS</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('cargo.create') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-plus"></i> Agregar nuevo cargo</a></div>				  
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					<div class="table-responsive">
						<table id="tableCargos" class="table">
							
							<thead>
							<tr>
								<th class="scope">ID</th>
								<th>NOMBRE</th>
								<th>DESCRIPCIÓN</th>
								<th>TIPO DE REMUNERACIÓN</th>
								<th></th>								
							</tr>
						</thead>
						<tbody>
						@foreach($cargos as $cargo)						
							<tr>
								<td>{{$cargo->id}}</td>
								<td>{{$cargo->nombre}}</td>
								<td>{{$cargo->descripcion}}</td>
								<td>{{$cargo->remuneracion->nombre}}</td>
								<td>
									<form method="POST" action="{{ route('cargo.activar') }}">
										@csrf	
										<input type="hidden" name="cargo_id" value="{{$cargo->id}}">
										<button type="submit"class="btn btn-primary"><i class="fas fa-recycle"></i></button>												
									</form>
									</td>
							</tr>
						@endforeach
						</tbody>
						
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('cargo.create') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-plus"></i> Agregar nuevo cargo</a></div>
		</div>
	</div>
</div>

@endsection