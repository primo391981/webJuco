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
			<h4>EDITAR HORARIO POR DIA DEL EMPLEADO</h4>           
		  </div> 
		  <div class="panel-body text-warning">   
				<form class="form-horizontal" method="POST" action="{{ route('empleado.guardarHorarioPrin') }}">
				@csrf	
					<input id="idHorarioEmp" name="idHorarioEmp" type="hidden" value="{{$horarioPrincipal->id}}">
					<div class="form-group">
						<label class="control-label col-sm-2" for="fechaDesde">FECHA DE INICIO *</label>
						<div class="col-sm-8">
							<input type="date" class="form-control" id="fechaDesde" name="fechaDesde" value="{{$horarioPrincipal->fechaDesde}}" readonly/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="fechaHasta">FECHA DE FIN *</label>
						<div class="col-sm-8">
							<input type="date" class="form-control" id="fechaHasta" name="fechaHasta" value="{{$horarioPrincipal->fechaHasta}}"readonly/>
						</div>
					</div>
					<hr>
						@foreach($horarioPrincipal->horariosPorDia as $hd)
							@foreach($dias as $d)
								@if($d->id==$hd->idDia)
									<div class=" form-group">
										<label class="control-label col-sm-2" >{{$d->nombre}}</label>
										<div class="col-sm-4">
											<input type="time" class="form-control" id="{{$d->id}}" name="{{$d->id}}" value="{{$hd->cantHoras}}"/>
										</div>
										<div class="col-sm-4">
											<select class="form-control" id="reg{{$d->id}}" name="reg{{$d->id}}">
												@foreach($registros as $reg)	
													@if($reg->id==$hd->idRegistro)
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
 
 