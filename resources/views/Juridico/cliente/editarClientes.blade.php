@extends('juridico.juridico')

@section('seccion', " - Editar cliente")

@section('content')
<br>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel panel-success">
			<div class="panel-heading text-center"><h4>Editar cliente</h4></div>
			<div class="panel-body text-success">
				<form method="POST" action="{{ route('cliente.update', ['persona' => $persona]) }}" class="form-horizontal" enctype="multipart/form-data">
				{{ method_field('PUT') }}
				@if($tipo=='fisica')
					@include('persona.formPersona', ['textoBoton' => 'Confirmar'])
				@else
					@include('persona.formEmpresa', ['textoBoton' => 'Confirmar'])
				@endif
				</form>
				
			</div>
			<div class="panel-footer"><a href="{{ route('cliente.index') }}" class="btn btn-success btn-block" role="button"><i class="fas fa-list-ul"></i> Listado clientes</a></div>
		</div>
	</div>
	
	
	
</div>	
				
@endsection

