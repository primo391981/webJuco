@extends('contable.contable')

@section('seccion', " - AGREGAR")

@section('content')

<br>
@if (Session::has('success'))
	<div class="alert alert-success">
		{{Session::get('success')}}
	</div>
@endif 
@if (Session::has('error'))
	<div class="alert alert-danger">
		{{Session::get('error')}}
	</div>
@endif 
<br>
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{ route('cargo.index') }}" role="button" data-toggle="tooltip" title="Listado de cargos"><i class="fas fa-list-ul"></i></a>
				<h4><i class="fas fa-briefcase"></i> AGREGAR NUEVO CARGO </h4>				
			</div>
			<div class="panel-body">
				<form method="POST" action="{{ route('cargo.store') }}"class="form-horizontal" enctype="multipart/form-data">
					@include('contable.cargo.formCargos')
					</div>
				<div class="panel-footer">
				<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar</button>
			</form>
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->
				
@endsection

