@extends('contable.contable')

@section('seccion', " - MARCA RELOJ")

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
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('persona.create') }}" class="btn btn-warning" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nuevo empleado</a></div>				  
</div>
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				  <div class="panel-heading">
					<div class="row">
						<div class="col-sm-9"><h4>LISTADO EMPLEADOS ACTIVOS</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('persona.create') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-plus"></i> Agregar nuevo empleado</a></div>				  
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					<div class="table-responsive">
						<table id="tablePersonas" class="table">
							
							<thead>
							<tr>
								<th>DOCUMENTO</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th>EMPRESA</th>
								<th>MES - AÑO</th>
								<th></th>								
							</tr>
						</thead>
						<tbody>
							@foreach($empleados as $emp)
							<tr>								
								<td>{{$emp->persona->tipoDoc->nombre}} - {{$emp->persona->documento}}</td>
								<td>{{$emp->persona->nombre}}</td>
								<td>{{$emp->persona->apellido}}</td>
								<td>{{$emp->empresa->nombreFantasia}}</td>
								<!--FORM CON MES, ANIO Y IDEMPLEADO-->
								<form id="form{{$emp->id}}" method="GET" action="#">
									<td>
										<div class="form-group">											
											<input type="month" class="form-control" id="month{{$emp->id}}" placeholder="fabian">									
										</div>
									</td>
									<td><button type="submit"class="btn btn-warning"><i class="far fa-clock"></i> Cargar marcas</button></td>
								</form>
							</tr>
							@endforeach
						</tbody>
						
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('persona.create') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-plus"></i> Agregar nuevo empleado</a></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
    $('#tablePersonas').DataTable( {        
		"pagingType": "numbers",
		"pageLength": 5,
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
@endsection

