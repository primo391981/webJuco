@extends('contable.contable')

@section('seccion', " - Editar cargo")

@section('content')
<br>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel panel-warning">
			<div class="panel-heading text-center"><h4>Editar cargo</h4></div>
			<div class="panel-body text-warning">
				<form method="POST" action="{{ route('cargo.update', ['cargo' => $cargo]) }}" class="form-horizontal" enctype="multipart/form-data">
				{{ method_field('PUT') }}
				@include('contable.cargo.formCargos', ['textoBoton' => 'Confirmar'])
				</form>
				
			</div>
			<div class="panel-footer"><a href="{{ route('cargo.index') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado cargos</a></div>
		</div>
	</div>
	
	
	
</div>	
				
@endsection

