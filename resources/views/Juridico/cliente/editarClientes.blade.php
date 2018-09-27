@extends('juridico.juridico')

@section('seccion', " - EDITAR")

@section('content')
<br>

<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{route('cliente.index')}}" role="button"><i class="fas fa-list-ul"></i></a>
				<h4>
					@if($tipo == 'juridica')
						<i class="far fa-building"></i>
					@else
						<i class="fas fa-user"></i>
					@endif
					EDITAR CLIENTE
				</h4>				
			</div>
			<div class="panel-body text-success">
				<form method="POST" action="{{ route('cliente.update', ['persona' => $persona]) }}" class="form-horizontal" enctype="multipart/form-data">
				{{ method_field('PUT') }}
				@if($tipo=='fisica')
					@include('persona.formPersona', ['textoBoton' => 'Confirmar'])
				@else
					@include('persona.formEmpresa', ['textoBoton' => 'Confirmar'])
				@endif
			</div>
			<div class="panel-footer">
					<button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Confirmar</button>
				</form>
			
			</div>
		</div>
	</div>
</div>	
				
@endsection

