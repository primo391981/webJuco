<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Recibos {{$tipoRecibo->nombre}} / {{$empresaNombre}} / {{$fecha}}</title>

	
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
  </head>
  <body>
	<div class="container-fluid">
   
   @for($i=0; $i < $recibos->count(); $i++)
														<div class="row">
															<div class="col-xs-12">
																<p>RUT: {{$recibos[$i][0]->empleado->empresa->rut}}  - {{$recibos[$i][0]->empleado->empresa->razonSocial}} / {{$recibos[$i][0]->empleado->empresa->nombreFantasia}}</p>
																<p>Número BPS: {{$recibos[$i][0]->empleado->empresa->numBps}} / Número MTSS: {{$recibos[$i][0]->empleado->empresa->numMtss}} / Grupo: {{$recibos[$i][0]->empleado->empresa->grupo}} / Subgrupo:{{$recibos[$i][0]->empleado->empresa->subGrupo}} / B.S.E: {{$recibos[$i][0]->empleado->empresa->numBse}}</p>
																<p>Domicilio: {{$recibos[$i][0]->empleado->empresa->domicilio}}</p>															
															</div>
														</div>
													<div style="background:black; high:1px; width:100%;"></div>
													
													<div class="row">
														<div class="col-xs-12">
															<p>{{$recibos[$i][0]->empleado->persona->tipoDoc->nombre}} - {{$recibos[$i][0]->empleado->persona->documento}} / {{$recibos[$i][0]->empleado->persona->nombre}} {{$recibos[$i][0]->empleado->persona->apellido}} / Fecha Ingreso: {{$recibos[$i][0]->empleado->fechaDesde}}</p>
															<p>Red de cobranza: {{$recibos[$i][0]->empleado->persona->pagoNombre}} - Nro {{$recibos[$i][0]->empleado->persona->pagoNumero}}</p>
															<p>Categoria: {{$recibos[$i][0]->empleado->cargo->nombre}} / {{$recibos[$i][0]->empleado->cargo->remuneracion->nombre}} / $ {{$recibos[$i][0]->empleado->monto}}</p>
														</div>
													</div>
													<div style="background:black; high:1px; width:100%;"></div>
													<div class="row">
														<div class="col-xs-12 text-center">
															<p><strong>RECIBO DE HABERES: {{$tipoRecibo->nombre}} / {{$fecha}} </strong></p>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-3 col-xs-offset-3"> DIAS </div>
														<div class="col-xs-3"> HORAS </div>
													</div>
													
													@foreach($recibos[$i][0]->detallesRecibos as $dt)
																@if($dt->conceptoRecibo->id==17 && ($tipoRecibo->id == 1 || $tipoRecibo->id == 5))
																@if (count($recibos[$i][1]) > 0 )
																	
																	@foreach($recibos[$i][1] as $p)
																	<div class="row">
																		<div class="col-xs-10"><p>{{$p->descripcion}}</p></div>																		
																		<div class="col-xs-2"><p>$ {{$p->monto * $p->cantDias}}</p></div>
																	</div>	
																	@endforeach
																	@endif
																@endif
																@if($dt->conceptoRecibo->id==26 && ($tipoRecibo->id == 1 || $tipoRecibo->id == 5))
																	@if (count($recibos[$i][2]) > 0 )																	
																		@foreach($recibos[$i][2] as $a)
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
																<div class="col-xs-3"><p><strong>{{$dt->conceptoRecibo->id}} - {{$dt->conceptoRecibo->nombre}} 
																	@if(isset($dt->porcentaje)) 
																		/ {{$dt->porcentaje}} 
																	@endif</strong></p></div>
																<div class="col-xs-3"><p>{{$dt->cantDias}}</p></div>
																<div class="col-xs-3"><p>{{$dt->cantHoras}}</p></div>
																<div class="col-xs-2"><p><strong>$ {{$dt->monto}}</strong></p></div>
																</div>
															@else
																<div class="col-xs-3"><p>{{$dt->conceptoRecibo->id}} -  {{$dt->conceptoRecibo->nombre}} 
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
																	@foreach($recibos[$i][3] as $p)
																	<div class="row">
																		<div class="col-xs-10"><p>{{$p->descripcion}}</p></div>																		
																		<div class="col-xs-2"><p>{{$p->monto}}</p></div>
																	</div>	
																	@endforeach																	
																	@foreach($recibos[$i][4] as $f)
																	<div class="row">
																		<div class="col-xs-10"><p>{{$f->descripcion}}</p></div>																		
																		<div class="col-xs-2"><p>{{$f->monto}}</p></div>
																	</div>
																	@endforeach																	
														@endif
													
													
													@endforeach
													
													<div style="background:black; high:1px; width:100%;"></div>
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
														<p style="page-break-after: always;"><strong>LA EMPRESA DECLARA ESTAR AL DIA CON LOS APORTES DE SEGURIDAD SOCIAL</strong></p>
														</div>
													</div>
	
	
	
	
	

@endfor
</div>

  </body>
</html>