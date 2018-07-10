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
					<div class="col-sm-9"><h4>Agregar nuevo cliente - Persona Física</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('cliente.index') }}" class="btn btn-warning" role="button"><i class="fas fa-list-ul"></i> Listado clientes</a></div>
				</div>
			</div>
			 <div class="panel-body text-warning"> 
				<form method="POST" action="{{ route('cliente.store') }}"class="form-horizontal" enctype="multipart/form-data" id="formPersona"> 
					<input type="hidden" name="tipo_persona" value="fisica">
				  @include('persona.formPersona', ['textoBoton' => 'Confirmar']) 
				</form>
			</div>
			<div class="panel-footer"><a href="{{ route('cliente.index') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado clientes</a></div>
		</div>
	</div>
	
</div>
    
<script>

$(document).ready(function(){
	var form = $("#formPersona");
	var url = "/cliente/search";
	$("#documento").keyup(function( event ) {
	  var data = form.serialize();
	  var inicio = 0;
	  $.get(url, data, function (result) {
           
		   if(result.personas != null){
				$("#documento").val(result.personas.documento);
				$("#documento").setSelection(inicio,10);
				$("#nombre").val(result.personas.nombre);   
				$("#apellido").val(result.personas.apellido); 
				$("#domicilio").val(result.personas.domicilio); 
				$("#email").val(result.personas.email); 
				$("#telefono").val(result.personas.telefono); 
				$("#cantHijos").val(result.personas.cantHijos); 
				$("#estadoCivil").val(result.personas.estadoCivil); 
			   
		   }
		   
        });
	}).keydown(function( event ) {
	  if ( event.which == 13 ) {
		event.preventDefault();
	  }
	});
});

jQuery.fn.setSelection = function(selectionStart, selectionEnd) {
	if(this.lengh == 0) return this;
	input = this[0];

	if (input.createTextRange) {
		var range = input.createTextRange();
		range.collapse(true);
		range.moveEnd('character', selectionEnd);
		range.moveStart('character', selectionStart);
		range.select();
	} else if (input.setSelectionRange) {
		input.focus();
		input.setSelectionRange(selectionStart, selectionEnd);
	}

	return this;
}
</script>	
				
@endsection

