@extends('juridico.juridico')

@section('seccion', " - AGREGAR")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('cliente.index') }}" class="btn btn-success" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado clientes activos</a></div>				  
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-9"><h4>AGREGAR NUEVO CLIENTE</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('cliente.index') }}" class="btn btn-success" role="button"><i class="fas fa-list-ul"></i> Listado clientes activos</a></div>
				</div>
			</div>
			<div class="panel-body text-center">
			
				<div class="col-xs-12 col-md-6">
					<i class="far fa-building fa-5x" style="color:#c8c8c8;"></i><br/><br/>
					<a class="btn btn-success" role="button" name="juridico" href="{{ route('cliente.create.juridica')}}">Persona Jurídica</a>
				</div>					  
				<div class="col-xs-12 col-md-6">
					<i class="fas fa-user fa-5x" style="color:#c8c8c8;"></i><br/><br/>
					<a class="btn btn-success" role="button" name="fisico" href="{{ route('cliente.create.fisica')}}">Persona Física</a>
				</div>
				
			</div>
			<div class="panel-footer"><a href="{{ route('cliente.index') }}" class="btn btn-success btn-block" role="button"><i class="fas fa-list-ul"></i> Listado clientes activos</a></div>
		</div>
	</div>
	
</div>
			
@endsection


