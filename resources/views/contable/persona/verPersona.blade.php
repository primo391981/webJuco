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
  
  
  <div class="col-xs-12 col-md-9"> <!--ABRE DIV EMPRESAS-->
    <div class="panel panel-warning"> 
      <div class="panel-heading"> 
		<form method="GET" action="{{ route('empleado.formCrear', $persona->id) }}">																
				<button type="submit"class="btn btn-success pull-right"><i class="fas fa-plus"></i></button>												
		</form>
	  <h4>EMPRESAS ASOCIADAS AL EMPLEADO</h4>
      </div> 
      <div class="panel-body text-warning">
		
		@foreach($emprAsociadas as $empr) 
			<form>
			@csrf
			<input type="hidden" id="idEmpleado" name="idEmpleado" value="{{$empr->pivot->id}}">
			<input type="hidden" id="idEmpresa" name="idEmpresa" value="{{$empr->id}}">
			<div class="row">
					<div class="col-xs-12 col-md-4">
						<div class="row col-xs-12">
						
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
						
							<p><strong>DETALLE EMPRESA</strong></p>
						</div>
						
						<p>{{$empr->razonSocial}}</p>
						<p>{{$empr->nombreFantasia}}</p>
						<p>{{$empr->nomContacto}}</p>
						<p>{{$empr->telefono}}</p>
					</div>
					<div class="col-xs-12 col-md-4">
						<div class="row col-xs-12">
							<button type="submit"class="btn btn-warning btn-xs pull-right" formaction="#" formmethod="post" style="margin-bottom:5px;"><i class="far fa-edit"></i></button>
							<p><strong>DETALLE CONTRATO</strong></p>
						</div>
						
							@foreach($cargos as $cargo)
								@if($cargo->id ===$empr->pivot->idCargo)
									<p>Cargo: {{$cargo->nombre}}</p>
									@break
								@endif
							@endforeach
							<p>Inicio: {{$empr->pivot->fechaDesde}}</p>
							<p>Fin: {{$empr->pivot->fechaHasta}}</p>
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
					<div class="col-xs-12 col-md-4">
						<div class="row col-xs-12">
						@if($empr->pivot->horarioCargado==true)
							@if(count($horariosPrincipales)>0)
								@foreach($horariosPrincipales as $hr)
									@if($empr->pivot->id == $hr->empleado->id)
									<button type="submit"class="btn btn-warning btn-xs pull-right" formaction="{{route('empleado.editHorarioPrincipal',[$empr->pivot->id,$hr->id])}}" formmethod="get" style="margin-bottom:5px;"><i class="far fa-edit"></i></button>	
									@endif
								@endforeach
							@endif
						@else
							<button type="submit"class="btn btn-success btn-xs pull-right" formaction="{{ route('empleado.formCargarHorario',$empr->pivot->id) }}"  method="GET" style="margin-bottom:5px;" ><i class="fas fa-plus"></i></button>
						@endif						
						<p><strong>DETALLE HORARIO</strong></p>
						
						</div>
						@if(count($horariosPrincipales)>0)									
							@foreach($horariosPrincipales as $hr)
								@if($empr->pivot->id == $hr->empleado->id)
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
										@endif
									@endforeach
								@endif
						
					</div>
				</div>
				<div class="row">
					
					<div class="col-xs-12 col-md-4">
					
					</div>
				</div>
				@if(count($emprAsociadas)>1)
					<hr>
				@endif
				</form>
		@endforeach
		
	  </div>
      	 
	</div>
	</div><!--CIERRE DIV EMPRESAS-->
</div><!--CIERRE row EMPRESAS-->
	
<div class="row">	

	
  
  
  <div class="col-xs-12"><!--ABRE DIV INGRESO HORARIO ESPECIAL--> 
    <div class="panel panel-warning"> 
      <div class="panel-heading"> 
        <h4>INGRESO DE HORARIO ESPECIAL</h4>           
      </div> 
      <div class="panel-body text-warning">  
		@if (count($emprAsociadas) >0)
			@foreach($emprAsociadas as $emp)
				<form>
				@csrf
				<input type="hidden" id="idEmpleado" name="idEmpleado" value="{{$emp->pivot->id}}">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">{{$emp->nombreFantasia}}</label>
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
				</div>
				</form>
				@if(count($emprAsociadas) >1)
					<hr>
				@endif
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
		@else
			<p>La persona NO esta asociada a ninguna empresa.</p>
		@endif
      </div>       
    </div>
  </div><!--CIERRE DIV HORARIO ESPECIAL-->
  
	
	
</div> <!--CIERRE ROW 2-->
@endsection 
 