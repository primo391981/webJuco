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
    @foreach($recibos as $empRecibo)
														<div class="row">
															<div class="col-xs-12">
																<p>RUT: {{$empRecibo->empleado->empresa->rut}}  - {{$empRecibo->empleado->empresa->razonSocial}} / {{$empRecibo->empleado->empresa->nombreFantasia}}</p>
																<p>Número BPS: {{$empRecibo->empleado->empresa->numBps}} / Número MTSS: {{$empRecibo->empleado->empresa->numMtss}} / Grupo: {{$empRecibo->empleado->empresa->grupo}} / Subgrupo:{{$empRecibo->empleado->empresa->subGrupo}} / B.S.E: {{$empRecibo->empleado->empresa->numBse}}</p>
																<p>Domicilio: {{$empRecibo->empleado->empresa->domicilio}}</p>															
															</div>
														</div>
													<hr>
													
													<div class="row">
														<div class="col-xs-12">
															<p>{{$empRecibo->empleado->persona->tipoDoc->nombre}} - {{$empRecibo->empleado->persona->documento}} / {{$empRecibo->empleado->persona->nombre}} {{$empRecibo->empleado->persona->apellido}} / Fecha Ingreso: {{$empRecibo->empleado->fechaDesde}}</p>
															<p>Red de cobranza: {{$empRecibo->empleado->persona->pagoNombre}} - Nro {{$empRecibo->empleado->persona->pagoNumero}}</p>
															<p>Categoria: {{$empRecibo->empleado->cargo->nombre}} / {{$empRecibo->empleado->cargo->remuneracion->nombre}} / $ {{$empRecibo->empleado->monto}}</p>
														</div>
													</div>
													<hr>
													
													<div class="row">
														<div class="col-xs-12 text-center">
															<p><strong>RECIBO DE HABERES: {{$tipoRecibo->nombre}} / {{$fecha}} </strong></p>
														</div>
													</div>
													<div class="row">
														<div class="col-xs-3 col-xs-offset-3"> DIAS </div>
														<div class="col-xs-3"> HORAS </div>
													</div>
													
													@foreach($empRecibo->detallesRecibos as $dt)
													<div class="row">
														@if ($loop->last)
														<div class="col-xs-3"><p><strong>{{$dt->conceptoRecibo->id}} - {{$dt->conceptoRecibo->nombre}} 
															@if(isset($dt->porcentaje)) 
																/ {{$dt->porcentaje}} 
															@endif</strong></p></div>
														<div class="col-xs-3"><p>{{$dt->cantDias}}</p></div>
														<div class="col-xs-3"><p>{{$dt->cantHoras}}</p></div>
														<div class="col-xs-2"><p><strong>$ {{$dt->monto}}</strong></p></div>
														@else
														<div class="col-xs-3"><p>{{$dt->conceptoRecibo->id}} -  {{$dt->conceptoRecibo->nombre}} 
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
														<p style="page-break-after: always;"><strong>LA EMPRESA DECLARA ESTAR AL DIA CON LOS APORTES DE SEGURIDAD SOCIAL</strong></p>
														</div>
													</div>
	
	
	
	
	
@endforeach
</div>

  </body>
</html>