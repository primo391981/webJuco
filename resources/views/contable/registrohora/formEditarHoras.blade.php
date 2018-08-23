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
			<div class="panel-heading"><h4><i class="far fa-clock"></i> EDICIÓN MARCAS RELOJ </h4></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12"><p><i class="far fa-calendar-alt"></i> {{$mes}}/{{$anio}}</p></div>
					<div class="col-xs-12"><p><i class="fas fa-building"></i> {{$empleado->empresa->nombreFantasia}}</p></div>
					<div class="col-xs-12"><p><i class="fas fa-user"></i> {{$empleado->persona->tipoDoc->nombre}} {{$empleado->persona->documento}} - {{$empleado->persona->nombre}} {{$empleado->persona->apellido}}</p></p></div>
				</div>
				<hr>
				
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
					<form action="{{route('reloj.guardarMarcasEdit')}}" method="post">
					@csrf
					<input id="idEmpleado" name="idEmpleado" type="hidden" value="{{$idEmpleado}}"/>
					<input id="fecha" name="fecha" type="hidden" value="{{$fecha}}"/>
					
					@foreach ($total as $t)					
					<tr class="{{$t[2]}}">
						<td>{{$t[0]}} - {{$t[1]}}</td>							
							@foreach($tiposHoras as $th)
								@php $dibujo=false; @endphp
								@foreach($t[3] as $reg)										
										@if($th->id==$reg->idTipoHora)
											@if($th->id!=1)
												<td  bgcolor="#bababa"><input type="time" class="form-control" id="{{$th->id}}{{$t[1]}}" name="{{$th->id}}{{$t[1]}}" value="{{$reg->cantHoras}}" /></td>
											@else
												<td> <input type="time" class="form-control" id="{{$th->id}}{{$t[1]}}" name="{{$th->id}}{{$t[1]}}" value="{{$reg->cantHoras}}" /></td>
											@endif
											@php $dibujo=true; @endphp
											@break;
										@endif
								@endforeach
								@if($dibujo==false)
									@switch($th->id)
										@case(2)
											<td><input type="time" class="form-control" id="{{$th->id}}{{$t[1]}}" name="{{$th->id}}{{$t[1]}}" value="00:00:00" /></td>
											@break
										@case(3)
											@if($empleado->espera==true)
											<td><input type="time" class="form-control" id="{{$th->id}}{{$t[1]}}" name="{{$th->id}}{{$t[1]}}" value="00:00:00"/></td>
											@endif
											@break
										@case(4)
											@if($empleado->nocturnidad==true)
											<td><input type="time" class="form-control" id="{{$th->id}}{{$t[1]}}" name="{{$th->id}}{{$t[1]}}" value="00:00:00"/></td>
											@endif
											@break
										@case(5)
											@if($empleado->pernocte==true)
											<td><input type="time" class="form-control" id="{{$th->id}}{{$t[1]}}" name="{{$th->id}}{{$t[1]}}" value="00:00:00"/></td>
											@endif
											@break	
									@endswitch		
								@endif	
							@endforeach							
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

@endsection

