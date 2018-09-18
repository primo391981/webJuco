@extends('juridico.juridico')

@section('librerias')
	<!-- Librerias para reportes -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
@endsection

@section('content')

<div class="col-md-12">
	<div class="col-md-6">
		<div class="box box-success">
			<div class="box-header">
				<h4>Expedientes por tipo de proceso</h4>
			</div>
			<div class="box-body">
				<canvas id="chartTipoProceso"></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-success">
			<div class="box-header">
				<h4>Expedientes por estado</h4>
			</div>
			<div class="box-body">
				<canvas id="chartEstado"></canvas>
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