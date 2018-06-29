@extends('contable.contable')

@section('seccion', " - Editar parámetro general")

@section('content')
<br>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel panel-warning">
			<div class="panel-heading text-center"><h4>Editar parámetro general</h4></div>
			<div class="panel-body text-warning">
				<form method="POST" action="{{ route('parametrogral.update', ['param' => $param]) }}" class="form-horizontal" enctype="multipart/form-data">
				{{ method_field('PUT') }}
				@include('contable.parametrogeneral.formParametroGral', ['textoBoton' => 'Confirmar'])
				</form>
				
			</div>
			<div class="panel-footer"><a href="{{ route('parametrogral.index') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado parámetros generales</a></div>
		</div>
	</div>
	
	
	
</div>	
				
@endsection

