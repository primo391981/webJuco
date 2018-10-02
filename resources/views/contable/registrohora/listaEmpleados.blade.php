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
						<th>EMPLEADO</th>
						<th>EMPRESA</th>
						<th>CATEGORIA</th>
						<th>HORARIO</th>
						<th>MES - AÑO</th>
						<th></th>
						<th></th>
						<th></th>
											
					</tr>
				</thead>
				<tbody>
					@foreach($empleados as $emp)
					<tr>								
						<td>{{$emp->persona->tipoDoc->nombre}} - {{$emp->persona->documento}}</td>
						<td>{{$emp->persona->nombre}} {{$emp->persona->apellido}}</td>
						<td>{{$emp->empresa->nombreFantasia}} - {{$emp->empresa->grupo}} - {{$emp->empresa->subGrupo}}</td>
						<td>{{$emp->cargo->nombre}} - {{$emp->cargo->remuneracion->nombre}}</td>
						@if($emp->cargo->remuneracion->id==1 && $emp->tipoHorario==1)
							<td>HABITUAL</td>
						@elseif($emp->cargo->remuneracion->id==1 && $emp->tipoHorario==2)
							<td>FLEXIBLE</td>
						@else
							<td>-</td>
						@endif
						
						
						<form>
							@csrf
							<input id="idEmpleado" name="idEmpleado" type="hidden" value="{{$emp->id}}">
							<td><div class="form-group"><input type="month" class="form-control" id="mes" name="mes" value="{{old('mes')}}"required></div></td>
							<td><button type="submit"class="btn btn-info" formaction="{{route('reloj.verMarcas')}}" formmethod="post" ><i class="fas fa-info-circle"></i></button></td>
							<td><button type="submit"class="btn btn-success" formaction="{{route('reloj.formMarcas')}}" formmethod="post" ><i class="fas fa-plus"></i></button></td>
							<td><button type="submit"class="btn btn-warning" formaction="{{route('reloj.editarMes')}}" formmethod="post" ><i class="far fa-edit"></i></button></td>
														
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
@endsection

