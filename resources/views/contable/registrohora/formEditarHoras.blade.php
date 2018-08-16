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
<div class="row text-warning">
	<div class="col-xs-12">
		<h3><i class="far fa-clock"></i> INGRESO MARCAS RELOJ</h3>
		<hr>
	</div>
	<div class="col-xs-12">
		<div class="table-responsive">
			<table id="" class="table table-condensed table-hover">
				<thead>
					<tr>
						<th>DÍA</th>
						<th>HORAS COMUNES</th>
						<th>HORAS EXTRAS</th>
						@if($empleado->espera==true)
						<th>HORAS ESPERA</th>
						@endif
						@if($empleado->nocturnidad==true)
						<th>HORAS NOCTURNIDAD</th>
						@endif
						@if($empleado->pernocte==true)
						<th>HORAS PERNOCTE</th>
						@endif
					</tr>
				</thead>
				<tbody>
					<form action="{{route('reloj.guardarMarcas')}}" method="post">
					@csrf
					<input id="idEmpleado" name="idEmpleado" type="hidden" value="{{$idEmpleado}}"/>
					<input id="fecha" name="fecha" type="hidden" value="{{$fecha}}"/>
					
					@foreach ($total as $t)					
					<tr class="{{$t[3]}}">
						<td><strong>{{$t[0]}} - {{$t[1]}}</strong></td>
						@if({{$t[4]}})
								<td><input type="time" class="form-control" id="1{{$t[1]}}" name="1{{$t[1]}}" value="{{$t[2]}}"/></td>
								<td><input type="time" class="form-control" id="2{{$t[1]}}" name="2{{$t[1]}}" value="{{$t[2]}}"/></td>
								<td><input type="time" class="form-control" id="4{{$t[1]}}" name="4{{$t[1]}}"value="{{$t[2]}}"/></td>
								<td><input type="time" class="form-control" id="5{{$t[1]}}" name="5{{$t[1]}}" value="{{$t[2]}}" /></td>
								<td><input type="time" class="form-control" id="3{{$t[1]}}" name="3{{$t[1]}}" value="{{$t[2]}}" /></td>
												
					</tr>
					@endforeach
					
				</tbody>						
			
			</table>
			<div class="col-sm-12 text-center">
				<button type="submit"class="btn btn-warning"><i class="fas fa-check"></i> Confirmar marcas</button>
			</div>
			</form>
		</div>
</div>
<script>
$(document).ready(function() {
    $('#tablePersonas').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
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

