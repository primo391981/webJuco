@extends('contable.contable') <!--layotu: carpeta contable/blade contable-->

@section('seccion', " - AGREGAR")

@section('content')

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
<br>
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{ $tipoPago == 1 ? route('pago.viaticos') : route('pago.adelantos') }}" role="button"><i class="fas fa-list-ul"></i></a>
				<h4>@if ($tipoPago == 1)
						<i class="fas fa-book"></i> AGREGAR NUEVO VIATICO
					@else
						<i class="fas fa-credit-card"></i>  AGREGAR NUEVO ADELANTO
					@endif
				</h4>				
			</div>
			<div class="panel-body">
				<form method="POST" action="{{ route('pago.store') }}" class="form-horizontal" enctype="multipart/form-data">		
					@include('contable.pago.formCreaPagos', ['readonly' => ''])						
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar</button>
				</form>
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->

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
	
	$('#gravado').on('change', function() 
	{	
		document.getElementById('porcentaje').disabled = !this.checked;
	})
	
});

</script>	
@endsection

