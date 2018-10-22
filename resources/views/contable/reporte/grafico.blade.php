@extends('contable.contable')
@section('librerias')
	<!-- Librerias para reportes -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
	<!-- Tiles CSS -->
    <link href="{{ asset('css/tile.css')}}" rel="stylesheet">
	
@endsection


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
				<h4><i class="fas fa-clipboard-list"></i> REPORTE </h4>				
			</div>
			<div class="panel-body">
			 <canvas id="myChart"></canvas>
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->

<script>
var ctx = document.getElementById("myChart").getContext('2d');
Chart.defaults.global.legend.display = false;
var myChart = new Chart(ctx, {
    type: '{!!$tipografico!!}',
	data: {!! $jsonArmado!!},
    options:{ title:{ display:true,text:'{!!$titulo!!}' }
	}
});
</script>

@endsection

