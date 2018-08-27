@extends('contable.contable')

@section('seccion', " - INACTIVOS")

@section('content')

@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif 
<script>
$(document).ready(function() {
    $('#tablePG').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: "<'row'<'col-sm-6'><'col-sm-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-6'B><'col-sm-6'>>",
        buttons: [
           { extend: 'print', text: 'IMPRIMIR' },
		   { extend: 'pdf', text: 'PDF' },		   
		   { extend: 'excel', text: 'EXCEL' },
		   { extend: 'copy', text: 'COPIAR' }
        ],
		
    } );
} );
</script>

<br>

<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<h4><i class="fas fa-cogs"></i> LISTADO DE PARAMETROS GENERALES INACTIVOS </h4>				
			</div>
			<div class="panel-body">
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
									<form method="POST" action="{{ route('parametrogeneral.activar') }}">
										@csrf	
										<input type="hidden" name="param_id" value="{{$param->id}}">
										<button type="submit"class="btn btn-danger"><i class="fas fa-recycle"></i></button>												
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
						
						</table>
					</div>
					
			
</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->




@endsection