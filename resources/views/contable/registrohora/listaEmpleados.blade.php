@extends('contable.contable')

@section('seccion', " - MARCA RELOJ")

@section('content')

@if (Session::has('success'))
<br>	
	<div class="alert alert-success alert-dismissible"> 
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{Session::get('success')}}
	</div>
@endif 
@if (Session::has('error'))
<br>	
	<div class="alert alert-danger alert-dismissible"> 
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{Session::get('error')}}
	</div>
@endif 
<br>
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading"><h4><i class="far fa-clock"></i> MARCAS RELOJ POR EMPLEADO </h4></div>
			<div class="panel-body">
			
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
						<th></th>
						<th></th>
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
							<input id="idEmpleado" name="idEmpleado" type="hidden" value="{{$emp->id}}">
							<td><div class="form-group"><input type="month" class="form-control" id="mes" name="mes" value="{{old('mes')}}"required></div></td>
							<td><button type="submit"class="btn btn-info" formaction="#" formmethod="post" ><i class="fas fa-info-circle"></i></button></td>
							<td><button type="submit"class="btn btn-success" formaction="{{route('reloj.formMarcas')}}" formmethod="post" ><i class="fas fa-plus"></i></button></td>
							<td><button type="submit"class="btn btn-warning" formaction="{{route('reloj.editarMes')}}" formmethod="post" ><i class="far fa-edit"></i></button></td>
							<td><button type="submit"class="btn btn-danger" formaction="{{route('reloj.verMarcas')}}" formmethod="post" ><i class="far fa-trash-alt"></i></button></td>							
						</form>
					</tr>
					@endforeach
				</tbody>						
			</table>
			</div><!--cierre div tableresponsive-->
			
			
			</div><!--CIERRE DIV PANELBODY-->						
		</div><!--CIERRE DIV PANEL-->
	</div>
</div>


<script>
$(document).ready(function() {
    $('#tablePersonas').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
		},
		dom: "<'row'<'col-sm-6'><'col-sm-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-6'><'col-sm-6'>>",
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

