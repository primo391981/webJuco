@extends('contable.contable')

@section('seccion', " - ACTIVOS")

@section('content')
@inject('pagos', 'App\Http\Controllers\Contable\PagoController')
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
@if(!empty($errorMsg))
	<br>
  <div class="alert alert-danger"> {{ $errorMsg }}</div>
@endif
@if(!empty($okMsg))
	<br>
  <div class="alert alert-success"> {{ $okMsg }}</div>
@endif
<br>

<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<h4><i class="fas fa-users"></i> LISTADO DE EMPLEADOS - SALARIO VACACIONAL </h4>				
			</div>
			<div class="panel-body">
			<form method="POST" action="{{ route('haberes.calculoSalVacacional') }}">		
			@csrf
			<input type="hidden" id="fecha" name="fecha" value="{{$fecha}}">
			<input type="hidden" id="cantHabilitados" name="cantHabilitados" value="{{$cantHabilitados}}">
			<input type="hidden" id="calculo" name="calculo" value="{{$calculo}}">

				<div class="table-responsive">
				<table id="tableEmpleados" class="table" style="width:100%" >
					<thead>
							<tr>
								<th>#</th>
								<th>DOCUMENTO</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th>COMIENZO LICENCIA</th>
								<th>DIAS LICENCIA</th>
								
							</tr>
						</thead>
						<tbody>
							@php $i=1; @endphp
							@foreach($habilitadas as $emp)
							<tr>
								<td><input type="checkbox" id="{{$i}}hab" name="{{$i}}hab" value="{{$emp[0]->pivot->id}}"   onclick="obtenerFecha({{$i}})"></td>
					
								<td>{{$emp[0]->documento}}</td>
								<td>{{$emp[0]->nombre}}</td>
								<td>{{$emp[0]->apellido}}</td>
								<td>
									<input id="diac{{$i}}" name="diac{{$i}}" type="number" min="1" max="{{$diaMax}}" class="form-control input-sm">
								</td>
								<td>
									<input id="lic{{$i}}" name="lic{{$i}}" type="number" class="form-control input-sm" value=0 min=0>
								</td>									
							</tr>
							
							@php $i++;  @endphp
							@endforeach
						</tbody>
				</table>
				</div>
			
			</div>
			
			<div class="panel-footer">
			<button type="submit" class="btn btn-warning btn-block 
			
			"><i class="fas fa-check"></i> Calcular</button>
			</form>
		</div>
		</div><!--cierre panel-->
		
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->


<script>
$(document).ready(function() {
    $('#tableEmpleados').DataTable( {        
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


function obtenerFecha(idEmp) {
    var x = document.getElementById(idEmp+"hab").checked;

	if (x == false)
	{
		document.getElementById("diac"+idEmp).required = false;
		document.getElementById("lic"+idEmp).min = "0";
	}
	else
	{
		document.getElementById("diac"+idEmp).required = true;
		document.getElementById("lic"+idEmp).min = "1";
	}
}
</script>
@endsection

