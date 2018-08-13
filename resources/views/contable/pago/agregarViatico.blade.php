@extends('contable.contable') <!--layotu: carpeta contable/blade contable-->

@section('seccion', " - AGREGAR")

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('empresa.index') }}" class="btn btn-warning" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado empresas</a></div>				  
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-9"><h4>AGREGAR NUEVO VIATICO</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('pago.viaticos') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-list-ul"></i> Listado viáticos</a></div>
				</div>
			</div>
			<div class="panel-body text-warning">
					<form method="POST" action="{{ route('pago.store') }}" class="form-horizontal" enctype="multipart/form-data" id="formViatico">		
						@csrf
						<div class="form-group row">
							<label for="rut" class="control-label col-sm-3">RUT</label>
							<div class="col-sm-9">
								<select name="rut">
								@foreach($empresas as $emp)
									<option value="{{$emp->rut}}">{{$emp->rut}}</option>
								@endforeach
								</select>							
							</div>	
						</div>
						<div class="form-group row">
							<label for="nombreFantasia" class="control-label col-sm-3">NOMBRE FANTASIA</label>
							<div class="col-sm-9">
								<input id="nombreFantasia" type="text" class="form-control" name="nombreFantasia" value="{{old('nombreFantasia')}}"autofocus required>
								@if ($errors->has('nombreFantasia'))
									<span style="color:red;">{{ $errors->first('nombreFantasia') }}</span>
								@endif
							</div>	
						</div>
						<div class="form-group row">
							<label for="razonSocial" class="control-label col-sm-3">RAZÓN SOCIAL *</label>
							<div class="col-sm-9">
								<input id="razonSocial" type="text" class="form-control" name="razonSocial" value="{{old('razonSocial')}}" autofocus required>
								@if ($errors->has('razonSocial'))
									<span style="color:red;">{{ $errors->first('razonSocial') }}</span>
								@endif
							</div>	
						</div>

							
						<!-- Datos del Empleado -->
						<br>Empleado
						
						<!-- Datos del Viático -->
						<br>Viático
						
						<div class="form-group row">
								<br>
								<div class="col-xs-12 text-center">
									<button type="submit" class="btn btn-warning btn-lg"><i class="fas fa-check"></i> Confirmar</button>
								</div>
						</div>
					</form>
			</div>
			
			<div class="panel-footer"><a href="{{ route('pago.viaticos') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado viáticos</a></div>
		</div>
	</div>
	
</div>

<script>
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
	var form = $("#formViatico");
	var url = "/cliente/search";
	var data = form.serialize();
		  
	$.get(url, data, function (result) {
	
		if(result.personas != null){
			$("#rut").val(result.personas.rut);
			$("#razonSocial").val(result.personas.razonSocial);   
			$("#nombreFantasia").val(result.personas.nombreFantasia); 
		} else {
			$("#razonSocial").val("");   
			$("#nombreFantasia").val(""); 
		}
			   
	});
}

function datosEmpresa(val){
    $.ajax({
      function(){
        $("#rut").val("pepe");
		$("#razonSocial").val(emp.razonSocial);   
		$("#nombreFantasia").val(emp.nombreFantasia);  
      }
    })
}
</script>	
@endsection

