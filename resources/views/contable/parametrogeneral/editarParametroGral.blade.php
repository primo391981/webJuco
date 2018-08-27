@extends('contable.contable')

@section('seccion', " - EDITAR")

@section('content')
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
				<a class="btn btn-success pull-right" href="{{ route('parametrogeneral.index') }}" role="button" data-toggle="tooltip" title="Listado de parametros"><i class="fas fa-list-ul"></i></a>
				<h4><i class="fas fa-edit"></i> EDITAR PARAMETRO GENERAL </h4>				
			</div>
			<div class="panel-body">
				<form method="POST" action="{{ route('parametrogeneral.update', ['param' => $param]) }}" class="form-horizontal" enctype="multipart/form-data">
				{{ method_field('PUT') }}
				@include('contable.parametrogeneral.formParametroGral', ['readonly' => 'readonly'])
				</div>
				<div class="panel-footer">
				<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar</button>
			</form>
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->
				

				
@endsection

