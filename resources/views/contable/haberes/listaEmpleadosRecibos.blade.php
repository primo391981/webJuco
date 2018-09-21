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
				<h4><i class="fas fa-users"></i> LISTADO DE EMPLEADOS - RECIBOS {{$calculo}} /  {{$fechaMes}} - {{$fechaAnio}}</h4>				
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
						@foreach($empleadosRecibo as $empRecibo)						
							<tr>
								<td>{{$empRecibo->empleado->persona->tipoDoc->nombre}} - {{$empRecibo->empleado->persona->documento}}</td>
								<td>{{$empRecibo->empleado->persona->nombre}} {{$empRecibo->empleado->persona->apellido}}</td>
								<td>
									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal{{$empRecibo->id}}"><i class="fas fa-info-circle"></i></button>
									 	 <div class="modal fade" id="modal{{$empRecibo->id}}" role="dialog">
											<div class="modal-dialog modal-lg">
											  <div class="modal-content">
												<div class="modal-header">
												  <button type="button" class="close" data-dismiss="modal">&times;</button>
												  <h4 class="modal-title">DETALLE RECIBO {{$calculo}}</h4>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="col-xs-12">
															<p>Empresa: {{$empRecibo->empleado->empresa->razonSocial}} / {{$empRecibo->empleado->empresa->nombreFantasia}}</p>
															<p>Domicilio: {{$empRecibo->empleado->empresa->domicilio}}</p>															
														</div>
													</div>
													<div class="row">
														<div class="col-xs-6">
															<p>Número BPS: {{$empRecibo->empleado->empresa->numBps}}</p>
														</div>
														<div class="col-xs-6">
															<p>RUT: {{$empRecibo->empleado->empresa->rut}}</p>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-4">
															<p>Número MTSS: {{$empRecibo->empleado->empresa->numMtss}}</p>
														</div>
														<div class="col-xs-4">
															<p>Grupo: {{$empRecibo->empleado->empresa->grupo}}</p>
														</div>
														<div class="col-xs-4">
															<p>Subgrupo:{{$empRecibo->empleado->empresa->subGrupo}}</p>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-12">
															<p>B.S.E: {{$empRecibo->empleado->empresa->numBse}}</p>															
														</div>
													</div>	
													<hr>
													
													<div class="row">
														<div class="col-xs-12">
															<p>Empleado: {{$empRecibo->empleado->persona->tipoDoc->nombre}} - {{$empRecibo->empleado->persona->documento}} / {{$empRecibo->empleado->persona->nombre}} {{$empRecibo->empleado->persona->apellido}}</p>															
														</div>														
													</div>
													<div class="row">
														<div class="col-xs-4">
															<p>Fecha Ingreso: {{$empRecibo->empleado->fechaDesde}}</p>
														</div>
														<div class="col-xs-4">
															<p>Cargo: {{$empRecibo->empleado->cargo->nombre}}</p>
														</div>
														<div class="col-xs-4">
															<p>{{$empRecibo->empleado->cargo->remuneracion->nombre}} / $ {{$empRecibo->empleado->monto}} / Valor Hora: {{$empRecibo->empleado->valorHora}}</p>
														</div>
													</div>
													<hr>
													
													<div class="row">
														<div class="col-xs-12 text-center">
															<p><strong>RECIBO DE HABERES: {{$calculo}} / Fecha: {{$fechaMes}} - {{$fechaAnio}}</strong></p>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-3 col-xs-offset-4"> DIAS </div>
														<div class="col-xs-3"> HORAS </div>
													</div>
													
													@foreach($empRecibo->detallesRecibos as $dt)
													<div class="row">
														@if ($loop->last)
														<div class="col-xs-4"><p><strong>{{$dt->conceptoRecibo->id}} - {{$dt->conceptoRecibo->nombre}} 
															@if(isset($dt->porcentaje)) 
																/ {{$dt->porcentaje}} 
															@endif</strong></p></div>
														<div class="col-xs-3"><p>{{$dt->cantDias}}</p></div>
														<div class="col-xs-3"><p>{{$dt->cantHoras}}</p></div>
														<div class="col-xs-2"><p><strong>$ {{$dt->monto}}</strong></p></div>
														@else
														<div class="col-xs-4"><p>{{$dt->conceptoRecibo->id}} -  {{$dt->conceptoRecibo->nombre}} 
															@if(isset($dt->porcentaje)) 
																/ {{$dt->porcentaje}} 
															@endif</p></div>
														<div class="col-xs-3"><p>{{$dt->cantDias}}</p></div>
														<div class="col-xs-3"><p>{{$dt->cantHoras}}</p></div>
														<div class="col-xs-2"><p>$ {{$dt->monto}}</p></div>
														@endif
														
													</div>
													@endforeach
													<hr>
													
													<div class="row">
														<div class="col-xs-12 text-center">
														<p><strong>RECIBI EL IMPORTE MENCIONADO Y LA COPA CORRESPONDIENTE</strong></p>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-4">
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
						@endforeach
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

