@extends('contable.contable')

@section('seccion', " - ACTIVOS")

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
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<h4><i class="fas fa-users"></i> LISTADO DE EMPLEADOS {{$calculo}} </h4>				
			</div>
			<div class="panel-body">
			<form method="POST" action="{{ route('haberes.store') }}">		
			@csrf
			<input type="hidden" id="fecha" name="fecha" value="{{$fecha}}">
			<input type="hidden" id="cantHabilitados" name="cantHabilitados" value="{{$cantHabilitados}}">
								
				<div class="table-responsive">
				<table id="tableEmpleados" class="table" style="width:100%" >
					<thead>
							<tr>
								<th>#</th>
								<th>DOCUMENTO</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th>VIATICOS</th>
								<th>ADELANTOS</th>
								<th>EXTRAS</th>
							</tr>
						</thead>
						<tbody>
							@php $i=1; @endphp
							@foreach($habilitadas as $emp)
							<tr>
								<input type="hidden" id="{{$i}}idEmp" name="{{$i}}idEmp" value="{{$emp[0]->pivot->id}}" {{ $emp[1]==1 ? '' : 'disabled' }}>
								<td><input type="checkbox" id="{{$i}}hab" name="{{$i}}hab" {{ $emp[1]==1 ? 'checked' : 'disabled' }}></td>								
								<td>{{$emp[0]->documento}}</td>
								<td>{{$emp[0]->nombre}}</td>
								<td>{{$emp[0]->apellido}}</td>
								<td><input id="{{$i}}v" name="{{$i}}v" type="number" value="{{$emp[2]}}" class="form-control" {{ $emp[1]==1 ? '' : 'readonly' }} required></td>
								<td><input id="{{$i}}a" name="{{$i}}a" type="number" value="{{$emp[3]}}" class="form-control" {{ $emp[1]==1 ? '' : 'readonly' }} required></td>
								<td><input id="{{$i}}ex" name="{{$i}}ex" type="number" class="form-control" {{ $emp[1]==1 ? '' : 'readonly' }} value="{{$emp[4]}}"></td>								
							</tr>
							@php $i++;  @endphp
							@endforeach
						</tbody>
				</table>
				</div>
			
			</div>
			
			<div class="panel-footer">
			<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Calcular</button>
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

