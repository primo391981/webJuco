@extends('contable.contable')

@section('seccion', " - INACTIVOS")

@section('content')
@if (Session::has('success'))
	<div class="alert alert-success">
		{{Session::get('success')}}
	</div>
@endif 
@if (Session::has('error'))
	<div class="alert alert-danger">
		{{Session::get('error')}}
	</div>
@endif 
<script>
$(document).ready(function() {
    $('#tableEmpleados').DataTable( {        
		"pagingType": "numbers",
		"pageLength": 10,
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: "<'row'<'col-sm-6'><'col-sm-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-6'B><'col-sm-6'p>>",
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
				<h4><i class="fas fa-users"></i> LISTADO DE EMPLEADOS INACTIVOS </h4>				
			</div>
			<div class="panel-body">
			
				<div class="table-responsive">
				<table id="tableEmpleados" class="table" style="width:100%" >
					<thead>
							<tr>
								<th>TIPO DOCUMENTO</th>
								<th>DOCUMENTO</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th>DOMICILIO</th>
								<th>TELEFONO</th>
								<th>EMAIL</th>
								<th></th>								
							</tr>
						</thead>
						<tbody>
						
						@foreach($personas as $persona)			
						<tr>							
								<td>{{$persona->tipoDoc->nombre}}</td>
								<td>{{$persona->documento}}</td>
								<td>{{$persona->nombre}}</td>
								<td>{{$persona->apellido}}</td>
								<td>{{$persona->domicilio}}</td>
								<td>{{$persona->telefono}}</td>
								<td>{{$persona->email}}</td>
								<td>
										<button type="submit"class="btn btn-info"><i class="fas fa-recycle"></i></button>												
									
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

