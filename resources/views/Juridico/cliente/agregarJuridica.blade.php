@extends('juridico.juridico')

@section('seccion', " - AGREGAR")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('cliente.index') }}" class="btn btn-success" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado clientes</a></div>				  
</div>
@if (Session::has('error'))
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div>
@endif 
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-9"><h4>AGREGAR NUEVO CLIENTE</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('cliente.index') }}" class="btn btn-success" role="button"><i class="fas fa-list-ul"></i> Listado clientes</a></div>
				</div>
			</div>
			 <div class="panel-body text-success"> 
				<form method="POST" action="{{ route('cliente.store') }}"class="form-horizontal" enctype="multipart/form-data" id="formPersona"> 
					<input type="hidden" name="tipo_persona" value="juridica">
				  @include('persona.formEmpresa', ['textoBoton' => 'Confirmar']) 
				</form>
			</div>
			<div class="panel-footer"><a href="{{ route('cliente.index') }}" class="btn btn-success btn-block" role="button"><i class="fas fa-list-ul"></i> Listado clientes</a></div>
		</div>
	</div>
	
</div>
    
<script>
$(document).ready(function(){
	
	$("#rut").each(function() {
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
});

function check()
{
	var form = $("#formPersona");
	var url = "/empleados/search";
	var data = form.serialize();
		  
	$.get(url, data, function (result) {
	
		if(result.personas != null){
			$("#rut").val(result.personas.rut);
			$("#razonSocial").val(result.personas.razonSocial);   
			$("#nombreFantasia").val(result.personas.nombreFantasia); 
			$("#domicilio").val(result.personas.domicilio); 
			$("#numBps").val(result.personas.numBps); 
			$("#numBse").val(result.personas.numBse); 
			$("#numMtss").val(result.personas.numMtss); 
			$("#grupo").val(result.personas.grupo); 
			$("#subGrupo").val(result.personas.subGrupo); 
			$("#email").val(result.personas.email); 
			$("#telefono").val(result.personas.telefono); 
			$("#nomContacto").val(result.personas.nomContacto); 
		} else {
			$("#razonSocial").val("");   
			$("#nombreFantasia").val(""); 
			$("#domicilio").val(""); 
			$("#numBps").val(""); 
			$("#numBse").val(""); 
			$("#numMtss").val(""); 
			$("#grupo").val(""); 
			$("#subGrupo").val(""); 
			$("#email").val(""); 
			$("#telefono").val(""); 
			$("#nomContacto").val(""); 
		}
			   
	});
}
</script>
				
@endsection

