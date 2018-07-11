@extends('juridico.juridico')

@section('seccion', " - Nuevo cliente")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('cliente.index') }}" class="btn btn-warning" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado clientes</a></div>				  
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-9"><h4>Agregar nuevo cliente</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('cliente.index') }}" class="btn btn-warning" role="button"><i class="fas fa-list-ul"></i> Listado clientes</a></div>
				</div>
			</div>
			<div class="panel-body text-warning">
				<a name="fisico" href="{{ route('cliente.create.fisica')}}">Persona Física</a>
				<a name="juridico" href="{{ route('cliente.create.juridica')}}">Persona Jurídica</a>
			</div>
			<div class="panel-footer"><a href="{{ route('cliente.index') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado clientes</a></div>
		</div>
	</div>
	
</div>
			
@endsection


