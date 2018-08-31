@extends('juridico.juridico')

@section('seccion', " - AGREGAR")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('expediente.index') }}" class="btn btn-success" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado expediente</a></div>				  
</div>

@if ($errors->any())
    <div class="alert alert-danger">
           @foreach ($errors->all() as $error)
                {{ $error }}
           @endforeach
    </div>
@endif

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-9"><h4>EDITAR EXPEDIENTE</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('expediente.index') }}" class="btn btn-success" role="button"><i class="fas fa-list-ul"></i> Listado expedientes</a></div>
				</div>
			</div>
			 <div class="panel-body text-success"> 
				<form method="POST" action="{{ route('expediente.update',$exp) }}" class="form-horizontal"> 
					@method('PATCH')
					@include('juridico.expediente.formExpediente', ['textoBoton' => 'Confirmar']) 
				</form>
			</div>
			<div class="panel-footer"><a href="{{ route('expediente.index') }}" class="btn btn-success btn-block" role="button"><i class="fas fa-list-ul"></i> Listado expediente</a></div>
		</div>
	</div>
	
</div>
    
<script>

$(document).ready(function(){
	$('.js-example-responsive').select2({
		placeholder: 'Seleccione clientes o inserte sus datos'
	});
});

</script>	
				
@endsection

