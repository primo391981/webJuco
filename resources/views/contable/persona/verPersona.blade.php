@extends('contable.contable') 
@section('seccion', " - DETALLE") 
 
@section('content') 
@inject('horarios', 'App\Http\Controllers\Contable\EmpleadoController')
@if (Session::has('error')) 
<br>   
  <div class="alert alert-danger alert-dismissible"> 
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{Session::get('error')}} 
  </div> 
@endif 
@if (Session::has('success'))
<br>	
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{Session::get('success')}}
	</div>
@endif 
<br>
 <div class="row">
 
		<div class="col-xs-12 col-md-3"><!--ABRE DIV DATOS--> 
		<div class="panel panel-warning"> 
		  <div class="panel-heading"> 
		  <form method="GET" action="{{ route('persona.edit', $persona->id) }}">																
				<button type="submit"class="btn btn-warning pull-right"><i class="far fa-edit"></i></button>												
			</form>
			<h4>DETALLE EMPLEADO</h4>           
		  </div> 
		  <div class="panel-body text-warning">   
			<p>{{$persona->nombre}} {{$persona->apellido}}</p> 
			<hr>
			
				<p><strong>TIPO DOCUMENTO :</strong> {{$persona->tipoDoc->nombre}}</p> 
				<p><strong>DOCUMENTO :</strong> {{$persona->documento}}</p> 
				<p><strong>TELEFONO :</strong> {{$persona->telefono}}</p> 
				<p><strong>EMAIL :</strong> {{$persona->email}}</p> 
				<p><strong>DOMICILIO :</strong> {{$persona->domicilio}}</p> 
				<p><strong>ESTADO CIVIL :</strong> {{$persona->eCivil->nombre}}</p> 
				<hr>
				<p><strong>CANTIDAD PERSONAS A CARGO</strong></p>
				<p><strong>HIJOS MENORES :</strong> {{$persona->cantHijos}}</p>
				<p><strong>CON DISCAPACIDAD :</strong> {{$persona->conDiscapacidad}}</p>
		
		  </div> 
		</div>
	  </div><!--CIERRE DIV DATOS-->

	  
	  
			<div class="col-xs-12 col-md-9">				
				<div class="panel panel-warning text-warning">
					<div class="panel-heading">
						<form method="GET" action="{{ route('empleado.formCrear', $persona->id) }}">																
							<button type="submit"class="btn btn-success pull-right"><i class="fas fa-plus"></i></button>												
						</form>
					  <h4>EMPRESAS ASOCIADAS AL EMPLEADO</h4>				
					</div>
					<div class="panel-body">
					@if(count($persona->empresas)>0)
					@foreach($persona->empresas as $empr)	
					<div class="row">
					<form>
						@csrf
						<input type="hidden" id="idEmpleado" name="idEmpleado" value="{{$empr->pivot->id}}">
						<input type="hidden" id="idEmpresa" name="idEmpresa" value="{{$empr->id}}">
							<div class="col-xs-12 col-md-4"><!-- DIV DETALLE EMPRESA-->
									
									<div class="row">
										<div class="col-xs-10">
											<p><strong>DETALLE EMPRESA</strong></p>
										</div>
										<div class="col-xs-2">
											<button type="button" class="btn btn-danger btn-xs pull-right" data-toggle="modal" data-target="#desvincular{{$empr->id}}" style="margin-bottom:5px;"><i class="fas fa-trash-alt"></i></button>
											<!-- Modal desvincular -->
												<div id="desvincular{{$empr->id}}" class="modal fade" role="dialog">
												  <div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content text-warning">
													  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">DESVINCULAR EMPLEADO DE EMPRESA</h4>
													  </div>
													  <div class="modal-body">
														<p>Está seguro que desea desvincular al empleado <strong>{{$persona->nombre}} {{$persona->apellido}}</strong> de la empresa <strong>{{$empr->nombreFantasia}}</strong> ?</p>
													  </div>
													  <div class="modal-footer">
														<button type="submit"class="btn btn-danger" formaction="{{route('empleado.desvincularEmpresa')}}" formmethod="post"><i class="fas fa-trash-alt"></i> Aceptar</button>
														<button type="button" class="btn btn-warning" data-dismiss="modal" autofocus><i class="fas fa-times"></i> Cancelar</button>
													  </div>
													</div>

												  </div>
												</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<p>{{$empr->razonSocial}}</p>
											<p>{{$empr->nombreFantasia}}</p>
											<p>{{$empr->nomContacto}}</p>
											<p>{{$empr->telefono}}</p>
										</div>
									</div>
									
							</div><!-- CIERRE DETALLE EMPRESA-->
							<div class="col-xs-12 col-md-4"><!--DIV DETALLE CONTRATO-->
									<div class="row">
										<div class="col-xs-10">
											<p><strong>DETALLE CONTRATO</strong></p>
										</div>
										<div class="col-xs-2">
											<button type="submit"class="btn btn-warning btn-xs pull-right" formaction="#" formmethod="post" style="margin-bottom:5px;"><i class="far fa-edit"></i></button>
										</div>
									</div>
									<div class="row col-xs-12">
										<p>Categoria: {{$empr->pivot->cargo->nombre}}</p>
										<p>Remuneracion: {{$empr->pivot->cargo->remuneracion->nombre}} {{$empr->pivot->tipoHorario}}</p>
										<p>Inicio: {{$empr->pivot->fechaDesde}}</p>
										<p>Egreso: {{$empr->pivot->fechaHasta}}</p>
										<p>Monto: {{$empr->pivot->monto}}</p>
										<p>Valor Hora: {{$empr->pivot->valorHora}}</p>
										@if($empr->pivot->espera==true)
											<p>Tiene horas de espera.</p>
										@endif
										@if($empr->pivot->nocturnidad==true)
											<p>Tiene horas nocturnas.</p>
										@endif
										@if($empr->pivot->pernocte==true)
											<p>Tiene horas pernocte.</p>
										@endif		
									</div>
							</div><!-- CIERRE DETALLE CONTRATO-->
							<div class="col-xs-12 col-md-4"><!-- DIV DETALLE HORARIO-->
								@if($empr->pivot->cargo->id_remuneracion==1)
									@if($empr->pivot->tipoHorario==1)
									<div class="row">
										<div class="col-xs-10">
											<p><strong>DETALLE HORARIO</strong></p>
										</div>
										<div class="col-xs-2">
										@if($empr->pivot->horarioCargado==false)
											<button type="submit"class="btn btn-success btn-xs" formaction="{{ route('empleado.formCargarHorario',$empr->pivot->id) }}"  method="GET" style="margin-bottom:5px;" ><i class="fas fa-plus"></i></button>
										</div><!--cierran lo mismo el xs-2 para boton-->
										
										@else
											@foreach($empr->pivot->horarios as $hr)
												@if ($loop->last)
													<button type="submit"class="btn btn-warning btn-xs" formaction="{{route('empleado.editHorarioPrincipal',[$empr->pivot->id,$hr->id])}}" formmethod="get" style="margin-bottom:5px;"><i class="far fa-edit"></i></button>
													</div><!--cierran lo mismo el xs-2 para boton-->
													
														<div class="row">
															<div class="col-xs-12">
															@foreach($hr->horariosPorDia as $hd)
																@foreach($dias as $d)
																	@if($d->id==$hd->idDia)
																		@foreach($registros as $r)
																			@if($r->id==$hd->idRegistro)
																			<p>{{$d->nombre}}: {{$hd->cantHoras}} - {{$r->id === 1 ? "COMPLETO" : $r->nombre}}</p>
																			@endif
																		@endforeach
																	@endif
																@endforeach
															@endforeach
															</div>
														</div>
													
												@endif
											@endforeach
										@endif
									</div>
									@else
										<div class="row">
										<div class="col-xs-12">
											<p>Empleado con cargo mensual, con tipo horario FLEXIBLE no necesita detalle de horario.</p>
										</div>
									</div>
									@endif
								@else
									<div class="row">
										<div class="col-xs-12">
											<p>Empleado con cargo jornalero, no necesita detalle de horario.</p>
										</div>
									</div>
								@endif
							</div><!-- CIERRE DETALLE HORARIO-->
					
					</form>
					
					</div>
					@if(count($persona->empresas)>1)
						<hr>
					@endif
					@endforeach
					@else
						<p>El empleado todavía no esta asociada a ninguna empresa.</p>
					@endif
					
				</div><!--cierre panel-->
				
			</div><!--cierre div empresas-->
</div>

@if(count($persona->empresas)>0)
<div class="row">	
  <div class="col-xs-12"><!--ABRE DIV INGRESO HORARIO ESPECIAL--> 
    <div class="panel panel-warning"> 
      <div class="panel-heading"> 
        <h4>INGRESO DE HORARIO ESPECIAL</h4>           
      </div> 
      <div class="panel-body text-warning">  
			@foreach($persona->empresas as $emp)
				<form>
				@csrf
				<input type="hidden" id="idEmpleado" name="idEmpleado" value="{{$emp->pivot->id}}">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">{{$emp->nombreFantasia}}</label>
					@if($emp->pivot->cargo->id_remuneracion==1)
						@if($emp->pivot->tipoHorario==1)
							@if($emp->pivot->horarioCargado==true)
								<div class="col-sm-3">
									<input type="date" class="form-control" id="fechaDesde" name="fechaDesde" value="{{old('fechaDesde')}}" required >
								</div>
								<div class="col-sm-3">
								  <input type="date" class="form-control" id="fechaHasta" name="fechaHasta" value="{{old('fechaHasta')}}" required>
								</div>
								<div class="col-sm-2">
								  <button type="submit"class="btn btn-success btn-block" formaction="{{route('empleado.formHorarioEspecial')}}" formmethod="post"><i class="far fa-clock"></i> Nuevo</button>	
								</div>
								<div class="col-sm-2">
								  <button type="button" class="btn btn-info btn-block" data-toggle="collapse" data-target="#horarios{{$emp->id}}"><i class="fas fa-info"></i> Horarios</button>	
								</div>
								
							@else
								<div class="col-sm-9">
									<p>Debe ingresar un horario principal.</p>
								</div>	
							@endif
						@else
							<div class="col-sm-9">
								<p>El empleado con cargo mensual y tipo horario FLEXIBLE no tiene la opcion habilitada de ingresar un horario especial.</p>
							</div>	
						@endif
					@else
							<div class="col-sm-9">
								<p>El empleado con cargo jornalero no tiene la opcion habilitada de ingresar un horario especial.</p>
							</div>	
					@endif
				</div>
				@if(count($persona->empresas)>1)
				<hr>
				@endif
				</form>
				<div id="horarios{{$emp->id}}" class="row collapse">
				
					@php $horariosEmp=$horarios->verHorariosEsp($emp->pivot->id); @endphp
							<div class="col-xs-12">
						<div class="table-responsive">
						<table class="table">
							<thead>
							  <tr>
								<th>FECHA DESDE</th>
								<th>FECHA HASTA</th>
								<th>LUNES</th>
								<th>MARTES</th>
								<th>MIERCOLES</th>
								<th>JUEVES</th>
								<th>VIERNES</th>
								<th>SABADO</th>
								<th>DOMINGO</th>
								<th></th>
							  </tr>
							</thead>
							<tbody>
							@foreach($horariosEmp as $horario)
							<form method="post">
							@csrf
								<tr>
								<td>{{$horario->fechaDesde}}</td>
								<td>{{$horario->fechaHasta}}</td>
								@foreach($horario->horariosPorDia as $hd)
									@switch($hd->idRegistro)
										@case(1)
										<td>{{$hd->cantHoras}}</td>
										@break
										@case(2)
										<td class="info">{{$hd->cantHoras}}</td>
										@break
										@case(3)
										<td class="danger">{{$hd->cantHoras}}</td>
										@break
									@endswitch
								@endforeach
								<td>
									<input id="idEmpleado" name="idEmpleado" type="hidden" value="{{$horario->idEmpleado}}">
									<input id="idHorario" name="idHorario" type="hidden" value="{{$horario->id}}">
									<button type="submit"class="btn btn-danger btn-xs" formaction="{{route('empleado.borrarHorarioEsp')}}"><i class="fas fa-trash-alt"></i></button>	
								</td>
								</tr>
							</form>
							@endforeach  
							</tbody>
						  </table>
						</div>
					</div>
				</div>
			@endforeach
      </div>       
    </div>
  </div><!--CIERRE DIV HORARIO ESPECIAL-->
</div> <!--CIERRE ROW 2-->
@endif

@endsection 
 