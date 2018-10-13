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
				<a class="btn btn-warning pull-right" href="{{route('expediente.show',$expediente)}}" role="button"><i class="fas fa-undo-alt"></i></a>
				<h4><i class="fas fa-book"></i> DETALLE DE EXPEDIENTE</h4>		
			</div>
			<div class="panel-body">
				@include('juridico.expediente.detalleExpediente')
				<hr>
				<div class="col-xs-12">
						<h4>Crear paso: {{$tipoPaso->nombre}}</h4>
						<form method="POST" action="{{ route('paso.store') }}" class="form-horizontal" enctype="multipart/form-data" id="formPaso"> 
							@include('juridico.expediente.formPaso', ['textoBoton' => 'Confirmar', 'expediente' => $expediente->id, 'tipoPaso' => $tipoPaso->id]) 
						</form>
				</div>
			</div>
		</div>
	</div>
</div>
				
@endsection

