@extends('juridico.juridico')

@section('seccion', " - AGREGAR")

@section('content')
<br>

@if (Session::has('error'))
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div>
@endif 

@if (Session::has('message'))
		<div class="alert alert-success">
			{{Session::get('message')}}
		</div>
@endif 

<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<a class="btn btn-warning pull-right" href="{{route('reporte.index')}}" role="button"><i class="fas fa-list-ul"></i></a>
				<h4><i class="far fa-building"></i> CREAR REPORTE GERENCIAL</h4>		
			</div>
			<div class="panel-body">
				<div class="col-xs-12">
						<h4>Crear reporte</h4>
						<form method="POST" action="{{ route('reporte.store') }}" class="form-horizontal" id="formReporte"> 
							@include('juridico.reporteGerencial.formReporte', ['textoBoton' => 'Confirmar']) 
						</form>
				</div>
			</div>
		</div>
	</div>
</div>
				
@endsection

