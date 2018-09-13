@extends('contable.contable')

@section('seccion', " - ACTIVOS")

@section('content')
@inject('pagos', 'App\Http\Controllers\Contable\PagoController')
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
@if(!empty($errorMsg))
	<br>
  <div class="alert alert-danger"> {{ $errorMsg }}</div>
@endif
@if(!empty($okMsg))
	<br>
  <div class="alert alert-success"> {{ $okMsg }}</div>
@endif
<br>

<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<h4><i class="fas fa-users"></i> LISTADO DE EMPLEADOS {{$calculo}} </h4>				
			</div>
			<div class="panel-body">
			<form method="POST" action="{{ route('haberes.store') }}">		
			@csrf
			<input type="hidden" id="fecha" name="fecha" value="{{$fecha}}">
			<input type="hidden" id="cantHabilitados" name="cantHabilitados" value="{{$cantHabilitados}}">
			<input type="hidden" id="calculo" name="calculo" value="{{$calculo}}">
								
				<div class="table-responsive">
				<table id="tableEmpleados" class="table" style="width:100%" >
					<thead>
							<tr>
								<th>#</th>
								<th>DOCUMENTO</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th>TOTAL VIATICOS</th>
								<th>TOTAL ADELANTOS</th>
								<th>TOTAL EXTRAS</th>
								<th>TOTAL FICTOS</th>
								<th>LICENCIA GOZADA</th>
							</tr>
						</thead>
						<tbody>
							@php $i=1; @endphp
							@foreach($habilitadas as $emp)
							<tr>
								@if($emp[1]==0)
									<td><i class="far fa-clock" style="color:red;"></i></i></td>
								@else
									<td><input type="checkbox" id="{{$i}}hab" name="{{$i}}hab" value="{{$emp[0]->pivot->id}}"  {{ $emp[1]==1 ? 'checked' : 'disabled' }}></td>
								@endif									
									
								<td>{{$emp[0]->documento}}</td>
								<td>{{$emp[0]->nombre}}</td>
								<td>{{$emp[0]->apellido}}</td>
								
								
								<td>
									<div class="input-group">
									<input id="v{{$i}}" name="v{{$i}}" type="number" class="form-control input-sm" value="{{$emp[2]}}" readonly>
										<div class="input-group-btn">
											<button type="button" class="abrirModal btn btn-success btn-sm" data-id="{{$emp[0]->pivot->id}}" data-toggle="modal" data-target="#modalViaticoAdd"><i class="fas fa-plus"></i></button>
											<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalViaticoList{{$emp[0]->pivot->id}}"><i class="fas fa-info-circle"></i></button>
										</div>
									</div>
									
									<!-- Modal LISTA viatico -->
											<div id="modalViaticoList{{$emp[0]->pivot->id}}" class="modal fade" role="dialog">
											  <div class="modal-dialog">
											 <div class="modal-content text-warning">
												  <div class="modal-header"  style="background:#fcf8e3;">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title"><i class="fas fa-book"></i> LISTADO DE VIATICOS</h4>
												  </div>
												  <div class="modal-body">
														@php $j=1; @endphp
														@php $viaticosEmpleado=$pagos->listaPagos($emp[0]->pivot->id,$j,$fecha,$calculo); @endphp
														<div class="table-responsive">
															<table class="table" style="width:100%" >
																<thead>
																	<tr>
																		<th>MONTO</th>
																		<th>DESCRIPCION</th>
																		<th>GRAVADO</th>
																		<th>PORCENTAJE</th>
																		
																	</tr>
																</thead>
																<tbody>
																	@foreach($viaticosEmpleado as $viatico)
																	<tr>								
																		<td>{{$viatico->monto}}</td>
																		<td>{{$viatico->descripcion}}</td>
																		<td>{{$viatico->gravado==1 ? "SI" : "NO"}}</td>									
																		<td>{{$viatico->porcentaje}}</td>									
																	</tr>
																	@endforeach
																</tbody>						
															</table>
														</div>
												  </div>
												</div>
											</div>
											</div><!-- cierre LISTA viatico -->
								</td>
								
								<td>
									<div class="input-group">
									<input id="a{{$i}}" name="a{{$i}}" type="number" class="form-control input-sm" value="{{$emp[3]}}" readonly>
										<div class="input-group-btn">
											<button type="button" class="abrirModal btn btn-success btn-sm" data-id="{{$emp[0]->pivot->id}}" data-toggle="modal" data-target="#modalAdelantoAdd" ><i class="fas fa-plus"></i></button>
											<button type="button" class=" btn btn-info btn-sm" data-toggle="modal" data-target="#modalAdelantoList{{$emp[0]->pivot->id}}"><i class="fas fa-info-circle"></i></button>
										</div>
									</div>
									
									<!-- Modal LISTA ADELANTO -->
											<div id="modalAdelantoList{{$emp[0]->pivot->id}}" class="modal fade" role="dialog">
											  <div class="modal-dialog">
											 <div class="modal-content text-warning">
												  <div class="modal-header"  style="background:#fcf8e3;">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title"><i class="fas fa-credit-card"></i> LISTADO DE ADELANTOS</h4>
												  </div>
												  <div class="modal-body">
														@php $j=2; @endphp
														@php $adelantosEmpleado=$pagos->listaPagos($emp[0]->pivot->id,$j,$fecha,$calculo); @endphp
														<div class="table-responsive">
															<table class="table" style="width:100%" >
																<thead>
																	<tr>
																		<th>MONTO</th>
																		<th>DESCRIPCION</th>
																	</tr>
																</thead>
																<tbody>
																	@foreach($adelantosEmpleado as $adelanto)
																	<tr>								
																		<td>{{$adelanto->monto}}</td>
																		<td>{{$adelanto->descripcion}}</td>																											
																	</tr>
																	@endforeach
																</tbody>						
															</table>
														</div>
												  </div>
												</div>
											</div>
											</div><!-- cierre LISTA ADELANTO -->
									
								</td>
								
								<td>
										<div class="input-group">
										<input id="ex{{$i}}" name="ex{{$i}}" type="number" class="form-control input-sm" value="{{$emp[4]}}" readonly>
											<div class="input-group-btn">
												<button type="button" class="abrirModal btn btn-success btn-sm" data-id="{{$emp[0]->pivot->id}}" data-toggle="modal" data-target="#modalExtraAdd" ><i class="fas fa-plus"></i></button>
												<button type="button" class=" btn btn-info btn-sm" data-toggle="modal" data-target="#modalExtraList{{$emp[0]->pivot->id}}"><i class="fas fa-info-circle"></i></button>
											</div>
										</div>
									
											<!-- Modal LISTA PARTIDAS EXTRAS -->
											<div id="modalExtraList{{$emp[0]->pivot->id}}" class="modal fade" role="dialog">
											  <div class="modal-dialog">
											 <div class="modal-content text-warning">
												  <div class="modal-header"  style="background:#fcf8e3;">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title"><i class="fas fa-dollar-sign"></i> LISTADO DE PARTIDAS EXTRAS</h4>
												  </div>
												  <div class="modal-body">
														@php $j=3; @endphp
														@php $extrasEmpleado=$pagos->listaPagos($emp[0]->pivot->id,$j,$fecha,$calculo); @endphp
														<div class="table-responsive">
															<table class="table" style="width:100%" >
																<thead>
																	<tr>
																		<th>MONTO</th>
																		<th>DESCRIPCION</th>
																		<th>GRAVADO</th>
																		<th>PORCENTAJE</th>
																		
																	</tr>
																</thead>
																<tbody>
																	@foreach($extrasEmpleado as $extra)
																	<tr>								
																		<td>{{$extra->monto}}</td>
																		<td>{{$extra->descripcion}}</td>
																		<td>{{$extra->gravado==1 ? "SI" : "NO"}}</td>									
																		<td>{{$extra->porcentaje}}</td>									
																	</tr>
																	@endforeach
																</tbody>						
															</table>
														</div>
												  </div>
												</div>
											</div>
											</div><!-- cierre LISTA PARTIDAS EXTRAS -->
								</td>
								
								<td>
									FICTOS
								</td>
								<td>
									<input id="lic{{$i}}" name="lic{{$i}}" type="number" class="form-control input-sm" value=0 min=0>
								</td>
							</tr>
							
							@php $i++;  @endphp
							@endforeach
						</tbody>
				</table>
				</div>
			
			</div>
			
			<div class="panel-footer">
			<button type="submit" class="btn btn-warning btn-block 
			
			"><i class="fas fa-check"></i> Calcular</button>
			</form>
		</div>
		</div><!--cierre panel-->
		
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->

<!-- Modal add viatico -->
<div id="modalViaticoAdd" class="modal fade" role="dialog">
  <div class="modal-dialog">
 <div class="modal-content text-warning">
      <div class="modal-header"  style="background:#fcf8e3;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fas fa-book"></i> INGRESO DE NUEVO VIATICO</h4>
      </div>
      <div class="modal-body">
		<form class="form-horizontal" action="{{route('pago.altaViatico')}}" method="post">
		@csrf        
		<input type="hidden" id="idEmpleado" name="idEmpleado" value="">
		<input type="hidden" id="fecha" name="fecha" value="{{$fecha}}">
		<input type="hidden" id="calculo" name="calculo" value="{{$calculo}}">
		
		<div class="form-group">
				<label class="control-label col-sm-3">DESCRIPCION </label>
				<div class="col-sm-9">
					<input class="form-control" type="text" id="desc" name="desc" required>
				</div>
		</div>
		<div class="form-group">
				<label class="control-label col-sm-3">MONTO </label>
				<div class="col-sm-9">
					<input class="form-control" type="number" id="monto" name="monto" min="0" required>
				</div>
		</div>
		<div class="form-group">
				<label class="control-label col-sm-3">DIAS </label>
				<div class="col-sm-9">
					<input class="form-control" type="number" id="dias" name="dias" min="0" required>
				</div>
		</div>
		
		<div class="form-group">
				<label class="control-label col-sm-3">GRAVADO </label>
				<div class="col-sm-9">
					<input type="checkbox" id="gravado" name="gravado"  onclick="habilitarPorcentajeV()">
				</div>
		</div>
		<div class="form-group">
				<label class="control-label col-sm-3">PORCENTAJE </label>
				<div class="col-sm-9">
					<input class="form-control" type="number" id="porcentaje" name="porcentaje" min="1" required disabled>
				</div>
		</div>
		
	  </div>
      <div class="modal-footer">
        <div class="row">
			<div class="col-xs-6">
					<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar</button>
			</div>
			<div class="col-xs-6">
				<button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
			</form>
			</div>
			</div>
	  </div>
    </div>

  </div>
</div><!-- cierre add viatico -->

<!-- Modal add ADELANTO -->
<div id="modalAdelantoAdd" class="modal fade" role="dialog">
  <div class="modal-dialog">
 <div class="modal-content text-warning">
      <div class="modal-header"  style="background:#fcf8e3;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fas fa-credit-card"></i> INGRESO DE NUEVO ADELANTO</h4>
      </div>
      <div class="modal-body">
		<form class="form-horizontal" action="{{route('pago.altaAdelanto')}}" method="post">
		@csrf        
		<input type="hidden" id="idEmpleado" name="idEmpleado" value="">
		<input type="hidden" id="fecha" name="fecha" value="{{$fecha}}">
		<input type="hidden" id="calculo" name="calculo" value="{{$calculo}}">
		
		<div class="form-group">
				<label class="control-label col-sm-3">DESCRIPCION </label>
				<div class="col-sm-9">
					<input class="form-control" type="text" id="desc" name="desc" required>
				</div>
		</div>
		<div class="form-group">
				<label class="control-label col-sm-3">MONTO </label>
				<div class="col-sm-9">
					<input class="form-control" type="number" id="monto" name="monto" min="0" required>
				</div>
		</div>
				
	  </div>
      <div class="modal-footer">
        <div class="row">
			<div class="col-xs-6">
					<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar</button>
			</div>
			<div class="col-xs-6">
				<button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
			</form>
			</div>
			</div>
	  </div>
    </div>

  </div>
</div><!-- cierre add ADELANTO -->

<!-- Modal add partidas extras -->
<div id="modalExtraAdd" class="modal fade" role="dialog">
  <div class="modal-dialog">
 <div class="modal-content text-warning">
      <div class="modal-header"  style="background:#fcf8e3;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fas fa-dollar-sign"></i> INGRESO DE NUEVA PARTIDA EXTRA</h4>
      </div>
      <div class="modal-body">
		<form class="form-horizontal" action="{{route('pago.altaPartidaExtra')}}" method="post">
		@csrf        
		<input type="hidden" id="idEmpleado" name="idEmpleado" value="">
		<input type="hidden" id="fecha" name="fecha" value="{{$fecha}}">
		<input type="hidden" id="calculo" name="calculo" value="{{$calculo}}">
		
		<div class="form-group">
				<label class="control-label col-sm-3">DESCRIPCION </label>
				<div class="col-sm-9">
					<input class="form-control" type="text" id="desc" name="desc" required>
				</div>
		</div>
		<div class="form-group">
				<label class="control-label col-sm-3">MONTO </label>
				<div class="col-sm-9">
					<input class="form-control" type="number" id="monto" name="monto" min="0" required>
				</div>
		</div>
		<div class="form-group">
				<label class="control-label col-sm-3">GRAVADO </label>
				<div class="col-sm-9">
					<input type="checkbox" id="gravado" name="gravado"  onclick="habilitarPorcentajeV()">
				</div>
		</div>
		<div class="form-group">
				<label class="control-label col-sm-3">PORCENTAJE </label>
				<div class="col-sm-9">
					<input class="form-control" type="number" id="porcentaje" name="porcentaje" min="1" required disabled>
				</div>
		</div>
		
	  </div>
      <div class="modal-footer">
        <div class="row">
			<div class="col-xs-6">
					<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar</button>
			</div>
			<div class="col-xs-6">
				<button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
			</form>
			</div>
			</div>
	  </div>
    </div>

  </div>
</div><!-- cierre add partidas extras -->

<script>
$(document).ready(function() {
    $('#tableEmpleados').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: "<'row'<'col-sm-6'><'col-sm-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-6'B><'col-sm-6'>>",
        buttons: [
           { extend: 'print', text: 'IMPRIMIR' },
		   { extend: 'pdf', text: 'PDF' },		   
		   { extend: 'excel', text: 'EXCEL' },
		   { extend: 'copy', text: 'COPIAR' }
        ],
		
    } );
} );

$(document).on("click", ".abrirModal", function () {
     var idEmp = $(this).data('id');
	 var tipoBoton=$(this).val();
     $(".modal-body #idEmpleado").val( idEmp );
     // obtener el idEmpleado cuando apreta boton de viaticos,adelanto o extra 
});

function habilitarPorcentajeV() {
    var checkBox = document.getElementById("gravado");
    if (checkBox.checked == true){
        document.getElementById("porcentaje").disabled = false;
    } else {
       document.getElementById("porcentaje").disabled = true;
    }
}

$('.modal').on('hidden.bs.modal', function(){
    $(this).find('form')[0].reset();
});
</script>
@endsection

