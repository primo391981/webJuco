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
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading"><h4><i class="far fa-clock"></i> INGRESO MARCAS RELOJ </h4></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12"><p><i class="far fa-calendar-alt"></i> {{$mes}}/{{$anio}}</p></div>
					<div class="col-xs-12"><p><i class="fas fa-building"></i> {{$empleado->empresa->nombreFantasia}} - {{$empleado->cargo->remuneracion->nombre}}</p></div>
					<div class="col-xs-12"><p><i class="fas fa-user"></i> {{$empleado->persona->tipoDoc->nombre}} {{$empleado->persona->documento}} - {{$empleado->persona->nombre}} {{$empleado->persona->apellido}}</p></div>
				</div>
				<hr>
				
				<div class="table-responsive">
				<table class="table table-condensed">
				<thead>
					<tr>						
						@if($empleado->cargo->remuneracion->id==1)
							@if($empleado->tipoHorario==2)
							<th>TIPO DE DIA</th>
							@endif
						@else 
							<th>TIPO DE DIA</th>
						@endif
						<th class="text-center">#I</th>
						<th>DÍA</th>
						<th>HORAS</th>
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
					<input id="idEmpleado" name="idEmpleado" type="hidden" value="{{$idEmpleado}}">
					<input id="fecha" name="fecha" type="hidden" value="{{$fecha}}">
					
					@foreach ($total as $t)	
						@if($empleado->cargo->remuneracion->id==1 && $empleado->tipoHorario==1)							
							<tr class="{{$t[3]}}">
						@else 
							<tr id="fila{{$t[1]}}">
						@endif

						
						@if($empleado->cargo->remuneracion->id==1)
							@if($empleado->tipoHorario==2)
							<td>
								
								<label class="radio-inline">
								  <input type="radio" name="radio{{$t[1]}}" id="c{{$t[1]}}" value="c" checked onclick="myFunction(this.value,'{{$t[1]}}')" > C
								</label>
								<label class="radio-inline">
								  <input type="radio" name="radio{{$t[1]}}" id="m{{$t[1]}}" value="m" onclick="myFunction(this.value,'{{$t[1]}}')"> M
								</label>
								<label class="radio-inline">
								  <input type="radio" name="radio{{$t[1]}}" id="d{{$t[1]}}" value="d" onclick="myFunction(this.value,'{{$t[1]}}')"> D
								</label>
								
							</td>
							@endif
						@else 
							<td> 
								<label class="radio-inline"> <input type="radio" name="radio{{$t[1]}}" id="c{{$t[1]}}" value="c" checked onclick="myFunction(this.value,'{{$t[1]}}')" checked> C</label>
								<label class="radio-inline"> <input type="radio" name="radio{{$t[1]}}" id="d{{$t[1]}}" value="d" onclick="myFunction(this.value,'{{$t[1]}}')"> D </label>
							</td>
						@endif
						
						<td class="success text-center"><input type="checkbox" id="6{{$t[1]}}" name="6{{$t[1]}}" value="00:30:00"></td>
						<td>{{$t[0]}} - {{$t[1]}}</td>
						
						@if($empleado->cargo->remuneracion->id==1 && $empleado->tipoHorario==1)
							<td><input type="time" class="form-control input-sm" id="1{{$t[1]}}" name="1{{$t[1]}}" value="{{$t[2]}}"min="00:00:00" max="08:00:00"/></td>
						@else
							<td><input type="time" class="form-control input-sm" id="1{{$t[1]}}" name="1{{$t[1]}}" value="08:00:00" min="00:00:00" max="08:00:00"/></td>
						@endif
						
						<td><input type="time" class="form-control input-sm" id="2{{$t[1]}}" name="2{{$t[1]}}" value="00:00:00"/></td>
						
						@if($empleado->espera==true)
						<td><input type="time" class="form-control input-sm" id="3{{$t[1]}}" name="3{{$t[1]}}" value="00:00:00"/></td>
						@endif
						@if($empleado->nocturnidad==true)
						<td><input type="time" class="form-control input-sm" id="4{{$t[1]}}" name="4{{$t[1]}}" value="00:00:00" /></td>
						@endif
						@if($empleado->pernocte==true)
						<td><input type="time" class="form-control input-sm" id="5{{$t[1]}}" name="5{{$t[1]}}" value="00:00:00" /></td>						
						@endif
					</tr>
					@endforeach					
				</tbody>
				</table>
				</div><!--cierra div table responsive-->
			
			</div><!--CIERRE DIV PANELBODY-->
			<div class="panel-footer">
				<button type="submit"class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar marcas</button>
				</form>
			</div><!--CIERRE DIV PANELFOOTER-->
			
		</div><!--CIERRE DIV PANEL-->
	</div>
</div>
<script>

function myFunction(valor,dia) {    
	
	if(valor=='c'){
		document.getElementById('1'+dia).value="08:00:00";
		var x =document.getElementById("fila"+dia);
		x.classList.add("default");
		x.classList.remove("danger");
		x.classList.remove("info");
		
	}
	else if(valor=='m'){
		document.getElementById("1"+dia).value="04:00:00";
		var x =document.getElementById("fila"+dia);
		x.classList.add("info");
		x.classList.remove("danger");
		x.classList.remove("default");
	}
	else{
		document.getElementById("1"+dia).value="00:00:00";
		var x =document.getElementById("fila"+dia);
		x.classList.add("danger");
		x.classList.remove("default");
		x.classList.remove("info");
	}
	
}

</script>

@endsection

