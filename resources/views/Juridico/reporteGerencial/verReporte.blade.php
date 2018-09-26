@extends('juridico.juridico')

@section('librerias')
	<!-- Librerias para reportes -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
@endsection



@section('content')
<br>

@if (Session::has('error'))
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div><br>
@endif 

@if (Session::has('message'))
		<div class="alert alert-success">
			{{Session::get('message')}}
		</div><br>
@endif 

<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<a class="btn btn-warning pull-right" href="{{route('reporte.index')}}" role="button"><i class="fas fa-undo-alt"></i></a>
				<h4><i class="far fa-building"></i> REPORTE GERENCIAL</h4>		
			</div>
			<div class="panel-body">
				<div class="col-md-6">
					<h4>Detalle del reporte</h4>
					<hr>
					<p><strong>Período: </strong>{{$reporte->fecha_desde}} - {{$reporte->fecha_hasta}}
					<p><strong>Fecha de creación: </strong>{{$reporte->created_at}}
				</div>
				<div class="col-md-6">
					<h4>Expedientes: Totales</h4>
					<hr>
					<div class="col-xs-6"><strong>Total de expedientes registrados en el período</strong></div>
					<div class="col-xs-6"><strong>Total de expedientes ganados en el período</strong></div>
					<div class="col-xs-6 text-center"><p class="text-muted" style="font-size:50px;">{!! $reporte->datasets[2]->dataset !!}</p></div>
					<div class="col-xs-6 text-center"><p class="text-success"  style="font-size:50px;">{!! $reporte->datasets[3]->dataset !!}</p></div>
				</div>
				<div class="col-md-6">
					<h4>Expedientes: Tipos de proceso</h4>
					<hr>
					<canvas id="chartTipoProceso"></canvas>
				</div>
				<div class="col-md-6">
					<h4>Expedientes: Estado</h4>
					<hr>
					<canvas id="chartEstado"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
	
<script>
	var chart1 = document.getElementById("chartTipoProceso").getContext('2d');
	var myChart = new Chart(chart1, {
		type: 'pie',
		data: {!! $reporte->datasets[0]->dataset !!}
	});
	
	var chart2 = document.getElementById("chartEstado").getContext('2d');
	var myChart = new Chart(chart2, {
		type: 'bar',
		data: {!! $reporte->datasets[1]->dataset !!}
	});
</script>

@endsection