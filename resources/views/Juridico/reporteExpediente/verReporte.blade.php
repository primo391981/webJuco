@extends('juridico.juridico')

@section('librerias')
	<!-- Librerias para reportes -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
	<!-- Tiles CSS -->
    <link href="{{ asset('css/tile.css')}}" rel="stylesheet">
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
				<h4><i class="far fa-building"></i> REPORTE DE EXPEDIENTE</h4>		
			</div>
			<div class="panel-body">
				<div class="col-md-6">
					<h4>Detalle del reporte</h4>
					<hr>
					<p><strong>Fecha de creación: </strong>{{$reporte->created_at}}
					<p><strong>Creado por: </strong>{{$reporte->usuario->name}} ({{$reporte->usuario->nombre}} {{$reporte->usuario->apellido}})
					<br>
					<h4>Detalle del expediente</h4>
					<br>
					@include('juridico.expediente.detalleExpediente')
				</div>
				
				<div class="col-xs-12">
					<h4>Pasos del expediente: Duración</h4>
					<hr>
					<canvas id="chartPasos"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
	
<script>

	var chart1 = document.getElementById("chartPasos").getContext('2d');
	var myChart = new Chart(chart1, {
		type: 'bar',
		data: {!! $reporte->datasets[1]->dataset !!},
		options: {
			legend: {
				display: false,
			},
			tooltips: {
				callbacks: {
					label: function(tooltipItem) {
						return tooltipItem.yLabel;
					}
				}
			},
			scales: {
				  yAxes: [{
					ticks: {
						beginAtZero: true
					}
				  }]
}
		}
	});
	

</script>


@endsection