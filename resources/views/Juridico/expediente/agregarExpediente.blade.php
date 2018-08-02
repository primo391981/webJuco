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
					<div class="col-sm-9"><h4>AGREGAR NUEVO EXPEDIENTE</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('expediente.index') }}" class="btn btn-success" role="button"><i class="fas fa-list-ul"></i> Listado expedientes</a></div>
				</div>
			</div>
			 <div class="panel-body text-success"> 
				<form method="POST" action="{{ route('expediente.store') }}" class="form-horizontal" id="formPersona"> 
					@include('juridico.expediente.formExpediente', ['textoBoton' => 'Confirmar']) 
				</form>
			</div>
			<div class="panel-footer"><a href="{{ route('expediente.index') }}" class="btn btn-success btn-block" role="button"><i class="fas fa-list-ul"></i> Listado expediente</a></div>
		</div>
	</div>
	
</div>
    
<script>

$(document).ready(function(){
	$('.js-example-responsive').select2();
	
	$("#documento").each(function() {
		var elem = $(this);

	   // Save current value of element
		elem.data('oldVal', elem.val());

	   // Look for changes in the value
		//elem.bind("propertychange change click keyup input paste", function(event){
		elem.bind("propertychange change click keyup input paste", function(event){
		  // If value has changed...
			if (elem.data('oldVal') != elem.val()) {
			// Updated stored value
				elem.data('oldVal', elem.val());
				check();
				
			}
		});
	}).keydown(function( event ) {
	 	if ( event.which == 13 ) {
			event.preventDefault();
		}
	});
	
	$("#tipodoc").change(function() {
		check();
	});
});

function check()
{
	var form = $("#formPersona");
	var url = "/cliente/search";
	var data = form.serialize();
		  
	$.get(url, data, function (result) {
	
		if(result.personas != null){
			$("#documento").val(result.personas.documento);
			//$("#documento").setSelection(0,10);
			$("#nombre").val(result.personas.nombre);   
			$("#apellido").val(result.personas.apellido); 
			$("#domicilio").val(result.personas.domicilio); 
			$("#email").val(result.personas.email); 
			$("#telefono").val(result.personas.telefono); 
			$("#cantHijos").val(result.personas.cantHijos); 
			$("#estadoCivil").val(result.personas.estadoCivil); 
		} else {
			$("#nombre").val("");   
			$("#apellido").val(""); 
			$("#domicilio").val(""); 
			$("#email").val(""); 
			$("#telefono").val(""); 
			$("#cantHijos").val(0); 
			$("#estadoCivil").val(1); 
		}
			   
	});
}

</script>	
				
@endsection

