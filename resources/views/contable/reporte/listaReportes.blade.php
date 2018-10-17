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
				<h4><i class="fas fa-clipboard-list"></i> LISTADO DE REPORTES </h4>				
			</div>
			<div class="panel-body">
			 <div class="row">
				
				<!--Reporte 1-->
				<div class="col-xs-12 col-md-4">
					<p>Pagos totales de empleados por empresa según el tipo de haber en un mes/año.</p>
					<hr>
					<form method="POST" action="{{route('reporte.reporteUno')}}">
					@csrf
						<input id="titulo" name="titulo" type="hidden" value="Pagos totales de empleados por empresa según el tipo de haber en un mes/año.">
						<div class="form-group">
							<select class="form-control" id="empresa" name="empresa" required>
							  @foreach($empresas as $empr)
							  <option value="{{$empr->id}}">{{$empr->nombreFantasia}} - {{$empr->grupo}} - {{$empr->subGrupo}}</option>
							  @endforeach
							</select>
						</div>
						<div class="form-group">
							<select class="form-control" id="tiporec" name="tiporec" required>
							  @foreach($tiposRecibo as $tr)
							  <option value="{{$tr->id}}">{{$tr->nombre}}</option>
							  @endforeach
							</select>
						</div>
						<div class="form-group">
							<input class="form-control" type="month" id="fecha" name="fecha" required />
						</div>
						
						<div class="form-group">
						<label>Tipo de gráfico</label>
							<select class="form-control" id="tipografico" name="tipografico" required>							 
								<option value="bar">BARRAS</option>
								<option value="line">LINEAL</option>
								<option value="pie">TORTA</option>
							</select>
						</div>
						<button type="submit" class="btn btn-warning btn-block btn-xs">Ver reporte</button>
					</form>
				</div>
				
				<div class="col-xs-12 col-md-4">
					<p>Impresión de recibos de empleados por empresa según el tipo de haber en un mes/año.</p>
					<hr>
					<form method="POST" action="{{route('reporte.reporteDos')}}">
					@csrf
						<input id="titulo" name="titulo" type="hidden" value="Impresión de recibos de empleados por empresa según el tipo de haber en un mes/año.">
						<div class="form-group">
							<select class="form-control" id="empresa" name="empresa" required>
							  @foreach($empresas as $empr)
							  <option value="{{$empr->id}}">{{$empr->nombreFantasia}} - {{$empr->grupo}} - {{$empr->subGrupo}}</option>
							  @endforeach
							</select>
						</div>
						<div class="form-group">
							<select class="form-control" id="tiporec" name="tiporec" required>
							  @foreach($tiposRecibo as $tr)
							  <option value="{{$tr->id}}">{{$tr->nombre}}</option>
							  @endforeach
							</select>
						</div>
						<div class="form-group">
							<input class="form-control" type="month" id="fecha" name="fecha" required />
						</div>
						<button type="submit" class="btn btn-warning btn-block btn-xs">Ver recibos</button>
					</form>
				</div>
				
				
			 </div><!--Cierre row-->
			 
							
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->


@endsection

