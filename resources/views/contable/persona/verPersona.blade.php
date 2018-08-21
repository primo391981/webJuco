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
			<h4>DETALLE EMPLEADO</h4>           
		  </div> 
		  <div class="panel-body text-warning">   
			<p>{{$persona->nombre}} {{$persona->apellido}}</p> 
			<hr>
			
				<p><strong>TIPO DOCUMENTO :</strong> {{$persona->tipoDoc->nombre}}</p> 
				<p><strong>DOCUMENTO :</strong> {{$persona->documento}}</p> 
				<p><strong>TELÉFONO :</strong> {{$persona->telefono}}</p> 
				<p><strong>EMAIL :</strong> {{$persona->email}}</p> 
				<p><strong>DOMICILIO :</strong> {{$persona->domicilio}}</p> 
				<p><strong>ESTADO CIVIL :</strong> {{$persona->eCivil->nombre}}</p> 
				<p><strong>CANTIDAD DE HIJOS :</strong> {{$persona->cantHijos}}</p>
		
		  </div> 
		  <div class="panel-footer"> 
			<form method="GET" action="{{ route('persona.edit', $persona->id) }}">																
				<button type="submit"class="btn btn-warning btn-block"><i class="far fa-edit"></i> Modificar datos</button>												
			</form>
		  </div> 
		</div>
	  </div><!--CIERRE DIV DATOS-->
  
  
  <div class="col-xs-12 col-md-9"> <!--ABRE DIV EMPRESAS-->
    <div class="panel panel-warning"> 
      <div class="panel-heading"> 
        <h4>EMPRESAS ASOCIADAS AL EMPLEADO</h4>           
      </div> 
      <div class="panel-body text-warning">
		@if (count($emprAsociadas) >0)
			<div class="row hidden-xs hidden-sm">
				<div class="col-xs-12">
					<div class="col-xs-12 col-md-3"><p><strong>DETALLE EMPRESA</strong></p></div>
					<div class="col-xs-12 col-md-3"><p><strong>DETALLE CONTRATO</strong></p></div>
					<div class="col-xs-12 col-md-6"><p><strong>DETALLE HORARIO</strong></p></div>
				</div>
			</div>
			
			@foreach($emprAsociadas as $empr) 
				<div class="row">
					<div class="col-xs-12">
						<div class="col-xs-12 col-md-3">
							<p class="hidden-md hidden-lg"><strong>DETALLE EMPRESA</strong></p>
							<p>{{$empr->razonSocial}}</p>
							<p>{{$empr->nombreFantasia}}</p>
							<p>{{$empr->nomContacto}}</p>
							<p>{{$empr->telefono}}</p>
						</div>
						<div class="col-xs-12 col-md-3">
							<p class="hidden-md hidden-lg"><strong>DETALLE CONTRATO</strong></p>
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
						<div class="col-xs-12 col-md-6">
							<p class="hidden-md hidden-lg"><strong>DETALLE HORARIO</strong></p>							
							@if($empr->pivot->horarioCargado==false)
							<form method="GET" action="{{ route('empleado.formCargarHorario',$empr->pivot->id) }}">																
								<button type="submit"class="btn btn-warning"><i class="far fa-clock"></i> Cargar horario</button>
							</form>
							@else
								@if(count($horariosPrincipales) >0)
									
									@foreach($horariosPrincipales as $hr)
										@if($empr->pivot->id == $hr->empleado->id)
											@foreach($hr->horariosPorDia as $hd)
												@foreach($dias as $d)
													@if($d->id==$hd->idDia)
														@foreach($registros as $r)
															@if($r->id==$hd->idRegistro)
															<p>{{$d->nombre}}: {{$hd->cantHoras}} - {{$r->nombre}}</p>
															@endif
														@endforeach
													@endif
												@endforeach
											@endforeach
											<form style="margin-bottom:5px;">
												<button type="submit"class="btn btn-warning btn-block" formaction="{{ route('empleado.editHorarioPrincipal', [$empr->pivot->id,$hr->id]) }}" formmethod="get"><i class="far fa-edit"></i> Modificar horario principal</button>												
											</form>
										@endif
									@endforeach
								@endif
							@endif							
						</div>
					</div>
				</div>
				@if(count($emprAsociadas) >1)
					<hr>
				@endif
			@endforeach
			@else
				<p>La persona NO esta asociada a ninguna empresa.</p>
			@endif
		</div>
      <div class="panel-footer"> 
		<form method="GET" action="{{ route('empleado.formCrear', $persona->id) }}">
			<button type="submit"class="btn btn-warning btn-block"><i class="far fa-handshake"></i> Asociar empresa</button>												
		</form>
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
						  <button type="submit"class="btn btn-warning btn-block" formaction="{{route('empleado.formHorarioEspecial')}}" formmethod="post"><i class="far fa-clock"></i> Nuevo</button>	
						</div>
						<div class="col-sm-2">
						  <button type="button" class="btn btn-warning btn-block" data-toggle="collapse" data-target="#horarios{{$emp->id}}"><i class="fas fa-info"></i> Horarios</button>	
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
					@php $horariosEmp=$horarios->verHorariosEsp($emp->id); @endphp
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
									<button type="submit"class="btn btn-danger btn-xs" formaction="#" method="posts"><i class="fas fa-trash-alt"></i></button>	
								</td>
							</tr>
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
 