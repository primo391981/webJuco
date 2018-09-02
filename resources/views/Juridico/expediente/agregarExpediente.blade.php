@extends('juridico.juridico')
@section('content')
<br>
@if ($errors->any())
    <div class="alert alert-danger">
           @foreach ($errors->all() as $error)
                {{ $error }}
           @endforeach
    </div>
@endif
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-success text-success">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{route('expediente.index')}}" role="button"><i class="fas fa-list-ul"></i></a>
				<h4><i class="fas fa-book"></i> AGREGAR NUEVO EXPEDIENTE </h4>				
			</div>
			<div class="panel-body">
				<form method="POST" action="{{ route('expediente.store') }}" class="form-horizontal" id="formPersona"> 
					@include('juridico.expediente.formExpediente') 
									
				
			</div>
			<div class="panel-footer">
			<div class="row">
				<div class="col-xs-12 col-md-6" style="margin-bottom:5px;">
					<button type="submit" class="btn btn-success btn-block" name="saveExpediente"><i class="fas fa-check"></i> Guardar</button>				
				</div>
				<div class="col-xs-12 col-md-6">
					<button type="submit" class="btn btn-info btn-block" name="nextExpediente"><i class="fas fa-angle-right"></i> Siguiente Paso</button>				
				</div>
				</form>
			</div>
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->
<script>

$(document).ready(function(){
	$('.js-example-responsive').select2({
		placeholder: 'Seleccione clientes o inserte sus datos'
	});
});

</script>	
				
@endsection

