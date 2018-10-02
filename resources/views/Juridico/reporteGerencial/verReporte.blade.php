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
					<h4>Expedientes: Estadísticas</h4>
					<hr>
					
					<div class="col-xs-4">
						<div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-book fa-fw fa-2x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    expedientes registrados
                                </div>
                                <div class="circle-tile-number text-faded">
                                    {!! $reporte->datasets[2]->dataset !!}
                                    <span id="sparklineA"></span>
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
					</div>
					<div class="col-xs-4">
						<div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading blue">
                                    <i class="fa fa-check fa-fw fa-2x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                    expedientes ganados
                                </div>
                                <div class="circle-tile-number text-faded">
                                    {!! $reporte->datasets[3]->dataset !!}
                                    <span id="sparklineA"></span>
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
					</div>
					<div class="col-xs-4">
						<div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading {{ $reporte->datasets[3]->dataset / $reporte->datasets[2]->dataset >= 0.65 ? 'green' : 'red'}}">
                                    <i class="fas fa-percentage	 fa-fw fa-2x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content {{ $reporte->datasets[3]->dataset / $reporte->datasets[2]->dataset >= 0.65 ? 'green' : 'red'}}">
                                <div class="circle-tile-description text-faded">
                                    % de expedientes ganados
                                </div>
                                <div class="circle-tile-number text-faded">
                                    {{ $reporte->datasets[3]->dataset / $reporte->datasets[2]->dataset * 100 }} %
                                    <span id="sparklineA"></span>
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
					</div>
					<div class="col-xs-4">
						<div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading orange">
                                    <i class="fas fa-level-up-alt fa-fw fa-2x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content orange">
                                <div class="circle-tile-description text-faded">
                                    Duración Max. Paso
                                </div>
                                <div class="circle-tile-number text-faded">
                                    {!! $reporte->datasets[4]->maxpaso->maximo !!} días
                                    <span id="sparklineA"></span>
                                </div>
                                <a href="{{route('paso.show', $reporte->datasets[4]->maxpaso->pasoMaximo->id)}}" class="circle-tile-footer">ver paso <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
					</div>
					<div class="col-xs-4">
						<div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading green">
                                    <i class="fas fa-level-down-alt fa-fw fa-2x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                    Duración Min. Paso
                                </div>
                                <div class="circle-tile-number text-faded">
                                    {!! $reporte->datasets[5]->minpaso->minimo !!} días
                                    <span id="sparklineA"></span>
                                </div>
                                <a href="{{route('paso.show', $reporte->datasets[5]->minpaso->pasoMinimo->id)}}" class="circle-tile-footer">ver paso <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
					</div>
					<div class="col-xs-4">
						<div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading purple">
                                    <i class="fas fa-arrows-alt-h fa-fw fa-2x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content purple">
                                <div class="circle-tile-description text-faded">
                                    Duración Promedio Pasos
                                </div>
                                <div class="circle-tile-number text-faded">
                                    {!! $reporte->datasets[6]->dataset !!} días
                                    <span id="sparklineA"></span>
                                </div>
                                <a href="{{route('paso.show', $reporte->datasets[5]->minpaso->pasoMinimo->id)}}" class="circle-tile-footer">ver paso <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
					</div>
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