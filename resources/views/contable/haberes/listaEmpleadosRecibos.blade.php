@extends('contable.contable')

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
			<div class="panel-heading">
				<h4><i class="fas fa-users"></i> LISTADO DE EMPLEADOS - RECIBOS {{ $calculo->nombre}} /  {{$calculo->id == 1 ? $fechaMes."-" : ""}}  {{$fechaAnio}}</h4>				
			</div>
			<div class="panel-body">
				
				<div class="table-responsive">
				<table id="tableEmpresas" class="table" style="width:100%" >
							<thead>
							<tr>
								<th>DOCUMENTO</th>
								<th>NOMBRE / APELLIDO</th>
								<th></th>								
							</tr>
						</thead>
						<tbody>
						@for($i=0; $i < $empleadosRecibo->count(); $i++)		
							<tr>
								<td>{{$empleadosRecibo[$i][0]->empleado->persona->tipoDoc->nombre}} - {{$empleadosRecibo[$i][0]->empleado->persona->documento}}</td>
								<td>{{$empleadosRecibo[$i][0]->empleado->persona->nombre}} {{$empleadosRecibo[$i][0]->empleado->persona->apellido}}</td>
								<td>
									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal{{$empleadosRecibo[$i][0]->id}}"><i class="fas fa-info-circle"></i></button>
									 	 <div class="modal fade" id="modal{{$empleadosRecibo[$i][0]->id}}" role="dialog">
											<div class="modal-dialog modal-lg">
											  <div class="modal-content">
												<div class="modal-header">
												  <button type="button" class="close" data-dismiss="modal">&times;</button>
												  <h4 class="modal-title">DETALLE RECIBO {{$calculo->nombre}}</h4>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="col-xs-12">
															<p>Empresa: {{$empleadosRecibo[$i][0]->empleado->empresa->razonSocial}} / {{$empleadosRecibo[$i][0]->empleado->empresa->nombreFantasia}}</p>
															<p>Domicilio: {{$empleadosRecibo[$i][0]->empleado->empresa->domicilio}}</p>															
														</div>
													</div>
													<div class="row">
														<div class="col-xs-6">
															<p>Número BPS: {{$empleadosRecibo[$i][0]->empleado->empresa->numBps}}</p>
														</div>
														<div class="col-xs-6">
															<p>RUT: {{$empleadosRecibo[$i][0]->empleado->empresa->rut}}</p>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-4">
															<p>Número MTSS: {{$empleadosRecibo[$i][0]->empleado->empresa->numMtss}}</p>
														</div>
														<div class="col-xs-4">
															<p>Grupo: {{$empleadosRecibo[$i][0]->empleado->empresa->grupo}}</p>
														</div>
														<div class="col-xs-4">
															<p>Subgrupo:{{$empleadosRecibo[$i][0]->empleado->empresa->subGrupo}}</p>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-12">
															<p>B.S.E: {{$empleadosRecibo[$i][0]->empleado->empresa->numBse}}</p>															
														</div>
													</div>	
													<hr>
													
													<div class="row">
														<div class="col-xs-12">
															<p>Empleado: {{$empleadosRecibo[$i][0]->empleado->persona->tipoDoc->nombre}} - {{$empleadosRecibo[$i][0]->empleado->persona->documento}} / {{$empleadosRecibo[$i][0]->empleado->persona->nombre}} {{$empleadosRecibo[$i][0]->empleado->persona->apellido}}</p>															
														</div>														
													</div>
													<div class="row">
														<div class="col-xs-4">
															<p>Fecha Ingreso: {{$empleadosRecibo[$i][0]->empleado->fechaDesde}}</p>
														</div>
														<div class="col-xs-4">
															<p>Cargo: {{$empleadosRecibo[$i][0]->empleado->cargo->nombre}}</p>
														</div>
														<div class="col-xs-4">
															<p>{{$empleadosRecibo[$i][0]->empleado->cargo->remuneracion->nombre}} / $ {{$empleadosRecibo[$i][0]->empleado->monto}} / Valor Hora: {{$empleadosRecibo[$i][0]->empleado->valorHora}}</p>
														</div>
													</div>
													<hr>
													
													<div class="row">
														<div class="col-xs-12 text-center">
															<p><strong>RECIBO DE HABERES: {{$calculo->nombre}} / Fecha: {{ $calculo->id == 1 ? $fechaMes."-" : ""}} {{$fechaAnio}}</strong></p>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-3 col-xs-offset-4"> DIAS </div>
														<div class="col-xs-3"> HORAS </div>
													</div>
													
													@foreach($empleadosRecibo[$i][0]->detallesRecibos as $dt)
																@if($dt->conceptoRecibo->id==17 && ($calculo->id == 1 || $calculo->id == 5))
																@if (count($empleadosRecibo[$i][1]) > 0 )
																	
																	@foreach($empleadosRecibo[$i][1] as $p)
																	<div class="row">
																		<div class="col-xs-10"><p>{{$p->descripcion}}</p></div>																		
																		<div class="col-xs-2"><p>$ {{$p->monto * $p->cantDias}}</p></div>
																	</div>	
																	@endforeach
																	@endif
																@endif
																@if($dt->conceptoRecibo->id==26 && ($calculo->id == 1 || $calculo->id == 5))
																	@if (count($empleadosRecibo[$i][2]) > 0 )																	
																		@foreach($empleadosRecibo[$i][2] as $a)
																			<div class="row">
																				<div class="col-xs-10"><p>{{$a->descripcion}}</p></div>																		
																				<div class="col-xs-2"><p>$ {{$a->monto}}</p></div>
																			</div>	
																		@endforeach
																	@endif
																@endif													
														@if($dt->monto != 0)
															<div class="row">
															@if ($loop->last)
																<div class="col-xs-4"><p><strong>{{$dt->conceptoRecibo->nombre}} 
																	@if(isset($dt->porcentaje)) 
																		/ {{$dt->porcentaje}} 
																	@endif</strong></p></div>
																<div class="col-xs-3"><p>{{$dt->cantDias}}</p></div>
																<div class="col-xs-3"><p>{{$dt->cantHoras}}</p></div>
																<div class="col-xs-2"><p><strong>$ {{$dt->monto}}</strong></p></div>
															@else
																<div class="col-xs-4"><p>{{$dt->conceptoRecibo->nombre}} 
																	@if(isset($dt->porcentaje)) 
																		/ {{$dt->porcentaje}} 
																	@endif</p></div>
																	
																<div class="col-xs-3"><p>{{$dt->conceptoRecibo->id < 17 ? $dt->cantDias : ''}}</p></div>
																<div class="col-xs-3"><p>{{$dt->conceptoRecibo->id < 17 ? $dt->cantHoras : ''}}</p></div>
																<div class="col-xs-2"><p>$ {{$dt->monto}}</p></div>
														
																</div>
														
															@endif
														@endif
														@if($dt->conceptoRecibo->id==9)																	
																	@foreach($empleadosRecibo[$i][3] as $p)
																	<div class="row">
																		<div class="col-xs-10"><p>{{$p->descripcion}}</p></div>																		
																		<div class="col-xs-2"><p>{{$p->monto}}</p></div>
																	</div>	
																	@endforeach																	
																	@foreach($empleadosRecibo[$i][4] as $f)
																	<div class="row">
																		<div class="col-xs-10"><p>{{$f->descripcion}}</p></div>																		
																		<div class="col-xs-2"><p>{{$f->monto}}</p></div>
																	</div>
																	@endforeach																	
														@endif
													
													
													@endforeach
													<hr>
													
													<div class="row">
														<div class="col-xs-12 text-center">
														<p><strong>RECIBI EL IMPORTE MENCIONADO Y LA COPA CORRESPONDIENTE</strong></p>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-4 text-center">
															<p><strong>Fecha:</strong> </p>
														</div>
														<div class="col-xs-4">
															<p><strong>Firma:</strong></p>
														</div>
														<div class="col-xs-4">
															<p><strong>Aclaración:</strong></p>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-12 text-center">
														<p><strong>LA EMPRESA DECLARA ESTAR AL DIA CON LOS APORTES DE SEGURIDAD SOCIAL</strong></p>
														</div>
													</div>
													
												</div>	
												 <div class="modal-footer">
														<button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
													  </div>												
											  </div>											  
											</div>
										  </div>										  
								</td>	
							</tr>
						@endfor
						</tbody>
				</table>
				</div>
				
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->


<script>
$(document).ready(function() {
    $('#tableEmpresas').DataTable( {        
		"pagingType": "numbers",
		"pageLength": 10,
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: "<'row'<'col-sm-6'><'col-sm-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-6'><'col-sm-6'p>>",
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

