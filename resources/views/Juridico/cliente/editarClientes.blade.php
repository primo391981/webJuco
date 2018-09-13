@extends('juridico.juridico')

@section('seccion', " - EDITAR")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{route('cliente.index')}}" class="btn btn-success" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado clientes activos</a></div>				  
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel">
			<div class="panel-heading">
			<div class="row">
					<div class="col-sm-9"><h4>EDITAR CLIENTE</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('cliente.index') }}" class="btn btn-success pull-right" role="button"><i class="fas fa-list-ul"></i> Listado clientes activos</a></div>
				</div>
			</div>	
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
			<div class="panel-footer"><a href="{{ route('cliente.index') }}" class="btn btn-success btn-block" role="button"><i class="fas fa-list-ul"></i> Listado clientes activos</a></div>
		</div>
	</div>
	
	
	
</div>	
				
@endsection

