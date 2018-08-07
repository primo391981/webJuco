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
		<h3><i class="far fa-clock"></i> GESTIÓN MARCAS RELOJ</h3>
		<hr>
	</div>
	<div class="col-xs-12">
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
						<form>
							@csrf
							<input id="empId" name="empId" type="hidden" value="{{$emp->id}}">
							<td><div class="form-group"><input type="month" class="form-control" id="mes" name="mes" value="{{old('mes')}}"required></div></td>
							<td><button type="submit"class="btn btn-success" formaction="{{route('reloj.compruebaMes')}}" formmethod="post"><i class="fas fa-clock"></i></button></td>
						</form>
					</tr>
					@endforeach
				</tbody>						
			</table>
		</div>
</div>
<script>
$(document).ready(function() {
    $('#tablePersonas').DataTable( {        
		"pagingType": "numbers",
		"pageLength": 5,
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
		},
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

