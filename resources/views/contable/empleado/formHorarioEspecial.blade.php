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
			<h4>INGRESO HORARIO ESPECIAL EMPLEADO</h4>           
		  </div> 
		  <div class="panel-body text-warning">   
				<form class="form-horizontal" method="post" action="{{ route('empleado.guardarHorarioEsp')}}">
					@csrf
					<div class="form-group">
						<label class="control-label col-sm-3" for="fechaDesde">FECHA DE INICIO *</label>
						<div class="col-sm-9">
							<input type="date" class="form-control" id="fechaDesde" name="fechaDesde" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="fechaHasta">FECHA DE FIN *</label>
						<div class="col-sm-9">
							<input type="date" class="form-control" id="fechaHasta" name="fechaHasta" />
						</div>
					</div>
					<hr>
					@foreach($horarioPrincipal->horariosPorDia as $hr)
						@foreach($dias as $dia)
							@if($dia->id==$hr->idDia)
							<div class="form-group">
								<label class="control-label col-sm-3" for="hr{{$dia->id}}">{{$dia->nombre}} *</label>
								<div class="col-sm-5">
									<input type="time" class="form-control" id="hr{{$dia->id}}" name="hr{{$dia->id}}" value="{{$hr->cantHoras}}"/>
								</div>
								<div class="col-sm-4">
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
					<hr>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<button type="submit"class="btn btn-warning"><i class="fas fa-check"></i> Confirmar horario</button>
						</div>
					</div>
				</form>
		  </div>  
		</div> 
	
	</div>
</div>
@endsection 
 
 