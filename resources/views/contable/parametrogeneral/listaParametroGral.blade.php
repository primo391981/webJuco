@extends('contable.contable')

@section('seccion', " - ACTIVOS")

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('parametrogeneral.create') }}" class="btn btn-warning" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nuevo parámetro general</a></div>				  
</div>
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
						<div class="col-sm-9"><h4>LISTADO DE PARAMETROS GENERALES ACTIVOS</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('parametrogeneral.create') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-plus"></i> Agregar nuevo parámetro gral.</a></div>				  
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					<div class="table-responsive">
						<table id="tablePG" class="table">
							
							<thead>
							<tr>
								<th class="scope">ID</th>
								<th>NOMBRE</th>
								<th>DESCRIPCIÓN</th>
								<th>FECHA INICIO</th>
								<th>FECHA FIN</th>
								<th>VALOR</th>
								<th></th>
								<th></th>
								
							</tr>
						</thead>
						<tbody>
						@foreach($params as $param)						
							<tr>
								<td>{{$param->id}}</td>
									
								<td>{{$param->nombre}}</td>
								<td>{{$param->descripcion}}</td>
								<td>{{$param->fecha_inicio}}</td>
								<td>{{$param->fecha_fin}}</td>
								<td>{{$param->valor}}</td>
								<td>
									<form method="GET" action="{{ route('parametrogeneral.edit', $param) }}">																
										<button type="submit" class="btn btn-warning"><i class="far fa-edit"></i></button>												
									</form>
								</td>	
								<td>
									<form method="POST" action="{{ route('parametrogeneral.destroy',$param) }}">
										{{ method_field('DELETE') }}
										@csrf	
										<button type="submit"class="btn btn-danger"><i class="far fa-trash-alt"></i></button>												
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
						
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('parametrogeneral.create') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-plus"></i> Agregar nuevo parámetro gral.</a></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
    $('#tablePG').DataTable( {        
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