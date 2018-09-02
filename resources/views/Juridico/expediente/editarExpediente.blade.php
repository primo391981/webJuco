@extends('juridico.juridico')

@section('seccion', " - AGREGAR")

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
           <br>
		   @foreach ($errors->all() as $error)
                {{ $error }}
           @endforeach
    </div>
@endif
<br>
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-success text-success">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{route('expediente.index')}}" role="button"><i class="fas fa-list-ul"></i></a>
				<h4><i class="fas fa-edit"></i> EDITAR EXPEDIENTE </h4>				
			</div>
			<div class="panel-body">
				<form method="POST" action="{{ route('expediente.update',$exp) }}" class="form-horizontal"> 
					@method('PATCH')
					@include('juridico.expediente.formExpediente') 
			</div>
			<div class="panel-footer">
					<button type="submit" class="btn btn-success btn-block" name="saveExpediente"><i class="fas fa-check"></i> Confirmar</button>				
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

