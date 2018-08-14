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
							<label for="rut" class="control-label col-sm-3">NOMBRE FANTASIA *</label>
							<div class="col-sm-9">
								<select id="nombreFantasia" class="form-control" name="nombreFantasia" onChange="" required autofocus>
									<option value="">-- Seleccione empresa --</option>
								@foreach($empresas as $emp)
									<option value="{{$emp->nombreFantasia}}">{{$emp->nombreFantasia}}</option>
								@endforeach
								</select>							
							</div>	
						</div>
						<div class="form-group row">
							<label for="nombreFantasia" class="control-label col-sm-3">RUT</label>
							<div class="col-sm-9">
								<input id="rut" type="text" class="form-control" name="rut" value="" disabled>
							</div>	
						</div>
						<div class="form-group row">
							<label for="razonSocial" class="control-label col-sm-3">RAZÓN SOCIAL</label>
							<div class="col-sm-9">
								<input id="razonSocial" type="text" class="form-control" name="razonSocial" value="" disabled>
							</div>	
						</div>

						<!-- Datos del Empleado -->
						<br>Empleado
						<div class="form-group row">
							<label for="rut" class="control-label col-sm-3">NOMBRE EMPLEADO *</label>
							<div class="col-sm-9">
								<select id="nombreEmpleado" class="form-control" name="nombreEmpleado" onChange="" required disabled>
									<option value=""></option>
								</select>							
							</div>	
						</div>
						<div class="form-group row">
							<label for="tipoDoc" class="control-label col-sm-3">TIPO DOCUMENTO</label>
							<div class="col-sm-9">
								<input id="tipoDoc" type="text" class="form-control" name="tipoDoc" value="" disabled>
							</div>	
						</div>
						<div class="form-group row">
							<label for="numeroDoc" class="control-label col-sm-3">NÚMERO</label>
							<div class="col-sm-9">
								<input id="numeroDoc" type="text" class="form-control" name="numeroDoc" value="" disabled>
							</div>	
						</div>
						
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
$(function() 
{
	var empresa = @json($empresas);
	
	$('#nombreFantasia').on('change', function() 
	{
		$("#tipoDoc").val("");
		$("#numeroDoc").val("");
		
		if (this.value ==  "")
		{
			$("#rut").val("");
			$("#razonSocial").val("");
			$('#nombreEmpleado').prop('disabled', 'disabled');
			document.getElementById("nombreEmpleado").innerHTML = "<option value=''></option>";			
		}
		else
		{
			encontre = false;
			i = 0;
			while (i < empresa.length && !encontre) {
			
				if (empresa[i].nombreFantasia == this.value){
					$("#rut").val(empresa[i].rut);
					$("#razonSocial").val(empresa[i].razonSocial);   
					$("#nombreFantasia").val(empresa[i].nombreFantasia);
					j = 0;	
					document.getElementById("nombreEmpleado").innerHTML = "<option value=''>-- Seleccione empleado --</option>"; 
					
					while (j < empresa[i].personas.length)
					{			
						//document.getElementById("nombreEmpleado").innerHTML += "<option value='"+empresa[i].personas[j].tipoDoc.nombre+" "+empresa[i].personas[j].documento+"'>"+empresa[i].personas[j].nombre+" "+empresa[i].personas[j].apellido+"</option>"; 
					document.getElementById("nombreEmpleado").innerHTML += "<option value='"+empresa[i].personas[j].tipoDocumento+" "+empresa[i].personas[j].documento+"'>"+empresa[i].personas[j].nombre+" "+empresa[i].personas[j].apellido+"</option>"; 
						j++;
					}
					
					$('#nombreEmpleado').prop('disabled', false);
					
					encontre = true;
				}			
				i++;
			}
		}
	})
	
	$('#nombreEmpleado').on('change', function() 
	{	
		separador = " ";
		documentoEmpl = this.value.split(separador);
		alert (documentoEmpl);
		$("#tipoDoc").val(documentoEmpl[0]);
		$("#numeroDoc").val(documentoEmpl[1]); 
	})
});

</script>	
@endsection

