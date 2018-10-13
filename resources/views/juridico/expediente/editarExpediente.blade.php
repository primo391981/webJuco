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
		<div class="panel panel-success">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{route('expediente.index')}}" role="button"><i class="fas fa-list-ul"></i></a>
				<h4><i class="fas fa-book"></i> EDITAR EXPEDIENTE </h4>	
			</div>
			 <form method="POST" action="{{ route('expediente.update',$exp) }}" class="form-horizontal"> 
			 <div class="panel-body text-success"> 
					@method('PATCH')
					@include('juridico.expediente.formExpediente') 
			</div>
			<div class="panel-footer"><button type="submit" class="btn btn-success btn-block" role="button"><i class="fas fa-check"></i> Confirmar</a></div>
			</form>
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

