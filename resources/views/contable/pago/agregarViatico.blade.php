@extends('contable.contable') <!--layotu: carpeta contable/blade contable-->

@section('seccion', " - AGREGAR")

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('pago.viaticos') }}" class="btn btn-warning" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado viáticos</a></div>				  
</div>
@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
			
		</div>
@endif 
@if (Session::has('error'))
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div>
@endif 
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
				<form method="POST" action="{{ route('pago.store') }}" class="form-horizontal" enctype="multipart/form-data">		
					@include('contable.paGO.formCreaPagos', ['textoBoton' => 'Confirmar', 'readonly' => ''])						
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
						document.getElementById("nombreEmpleado").innerHTML += "<option value='"+empresa[i].personas[j].tipoDocumento+" "+empresa[i].personas[j].tipo_doc.nombre+" "+empresa[i].personas[j].documento+"'>"+empresa[i].personas[j].nombre+" "+empresa[i].personas[j].apellido+"</option>"; 
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
	
		$("#tipoDocId").val(documentoEmpl[0]);
		$("#tipoDoc").val(documentoEmpl[1]);
		$("#numeroDoc").val(documentoEmpl[2]); 
	})
});

</script>	
@endsection

