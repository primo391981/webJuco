@extends('contable.contable') 
@section('seccion', " - HORARIO") 
 
@section('content') 
@if (Session::has('error')) 
<br>   
  <div class="alert alert-danger"> 
    {{Session::get('error')}} 
  </div> 
@endif 
<br> 
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-warning"> 
		  <div class="panel-heading"> 
			<h4><i class="far fa-clock"></i> INGRESO HORARIO ESPECIAL EMPLEADO</h4>           
		  </div> 
		  <div class="panel-body text-warning">   
				<form class="form-horizontal" method="post" action="{{ route('empleado.guardarHorarioEsp')}}">
					@csrf
					 <input type="hidden" id="idEmpleado" name="idEmpleado" value="{{$idEmpleado}}">
					<div class="form-group">
						<label class="control-label col-md-2" for="fechaDesde">FECHA DE INICIO *</label>
						<div class="col-md-10">
							<input type="date" class="form-control" id="fechaDesde" name="fechaDesde" value="{{$fechaDesde}}" readonly />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2" for="fechaHasta">FECHA DE FIN *</label>
						<div class="col-md-10">
							<input type="date" class="form-control" id="fechaHasta" name="fechaHasta" value="{{$fechaHasta}}" readonly/>
						</div>
					</div>
					<hr>
					@foreach($horarioPrincipal->horariosPorDia as $hr)
						@foreach($dias as $dia)
							@if($dia->id==$hr->idDia)
							<div class="form-group">
								<label class="control-label col-md-2" for="hr{{$dia->id}}">{{$dia->nombre}} *</label>
								<div class="col-md-5">
									<input type="time" class="form-control" id="hr{{$dia->id}}" name="hr{{$dia->id}}" value="{{$hr->cantHoras}}" min="00:00" max="08:00" required/>
								</div>
								<div class="col-md-5">
									<select class="form-control" id="reg{{$dia->id}}" name="reg{{$dia->id}}">
									@foreach($registros as $reg)
										@if($reg->id==$hr->idRegistro)
											<option selected value="{{$reg->id}}">{{$reg->nombre}}</option>
										@else
											<option value="{{$reg->id}}">{{$reg->nombre}}</option>
										@endif										
									@endforeach
									</select>
								</div>
							</div>
						@endif
					@endforeach
					@endforeach
					
		  </div>  
		  <div class="panel-footer"><button type="submit"class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar horario</button></div>
		</div> 
	
	</div>
</div>
@endsection 
 
 