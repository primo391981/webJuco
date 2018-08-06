@extends('juridico.juridico')

@section('seccion', " - AGREGAR")

@section('content')
<br>

@if (Session::has('error'))
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div>
@endif 

@if (Session::has('message'))
		<div class="alert alert-success">
			{{Session::get('message')}}
		</div>
@endif 

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-9"><h4>EXPEDIENTE - PASO {{$numero_paso}}: {{$nombre_paso}} </h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('expediente.index') }}" class="btn btn-success" role="button"><i class="fas fa-list-ul"></i> Listado expedientes</a></div>
				</div>
			</div>
			<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Datos del expediente</h4>
						</div>
						<div class="panel-body">
						<div class="row">
							<label for="tipoexp" class="control-label col-sm-3">TIPO EXPEDIENTE</label>
							<div class="col-sm-9">
								{{$expediente->tipo->nombre}}
							</div>
						</div>
						<div class="row">
							<label for="iue" class="control-label col-sm-3">IUE</label>
							<div class="col-sm-9">
								{{$expediente->iue}}
							</div>
						 </div>
						 <div class="row">
							<label for="juzgado" class="control-label col-sm-3">JUZGADO</label>
							<div class="col-sm-9">
								{{$expediente->juzgado}}
							</div>
						 </div>
						 <div class="row">
							<label for="caratula" class="control-label col-sm-3">CARATULA</label>
							<div class="col-sm-9">
								{{$expediente->caratula}}
							</div>
						 </div>
						 
						 <div class="row">
								<label for="clientes" class="control-label col-sm-3">CLIENTES</label>
								<div class="col-sm-9">
									
										@foreach($expediente->clientes as $cliente)
											{{ $cliente->persona->apellido}}, {{ $cliente->persona->nombre}} - {{ $cliente->persona->tipodoc->nombre}} {{ $cliente->persona->documento}}
										@endforeach
									
								</div>
						</div>
						
						<div class="row">
							<label for="fecha_inicio" class="control-label col-sm-3">FECHA CREACION</label>
							<div class="col-sm-9">
								{{$expediente->fecha_inicio}}
							</div>
						</div>
						</div>
						
			</div>
						
			 <div class="panel-body text-success"> 
				<form method="POST" action="{{ route('paso.store') }}" class="form-horizontal" enctype="multipart/form-data" id="formPersona"> 
					@include('juridico.expediente.formPaso', ['textoBoton' => 'Confirmar']) 
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

