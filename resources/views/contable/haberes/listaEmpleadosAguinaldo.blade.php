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
				<h4><i class="fas fa-users"></i> LISTADO DE EMPLEADOS - AGUINALDO {{$calculo == 2 ? "PRIMERA CUOTA" : "SEGUNDA CUOTA"}} </h4>				
			</div>
			<div class="panel-body">
			<form method="POST" action="{{ route('haberes.calculoAguinaldo') }}">		
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
								@if ($calculo==2)
									<th>DICIEMBRE</th>
									<th>ENERO</th>
									<th>FEBRERO</th>
									<th>MARZO</th>
									<th>ABRIL</th>
									<th>MAYO</th>
								@else
									<th>JUNIO</th>
									<th>JULIO</th>
									<th>AGOSTO</th>
									<th>SETIEMBRE</th>
									<th>OCTUBRE</th>
									<th>NOVIEMBRE</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@php $i=1; @endphp
							@foreach($habilitadas as $emp)
							<tr>
								<td><input type="checkbox" id="{{$i}}hab" name="{{$i}}hab" value="{{$emp[0]->pivot->id}}"  checked></td>
					
								<td>{{$emp[0]->documento}}</td>
								<td>{{$emp[0]->nombre}}</td>
								<td>{{$emp[0]->apellido}}</td>
								@for ($j=1; $j<7; $j++)
								<td>{{$emp[$j]}}</td>
								@endfor								
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

</script>
@endsection

