@extends('contable.contable')

@section('seccion', " - HABERES")

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
				<h4><i class="fas fa-hand-holding-usd"></i> LIQUIDACION DE HABERES</h4>				
			</div>
			<div class="panel-body">
				<form method="POST" action="{{route('haberes.listaEmpleados')}}" class="form-horizontal" enctype="multipart/form-data" id="formCarga">		
						@csrf
						<!-- Datos de la Empresa -->
						<div class="form-group row">
							<label for="rut" class="control-label col-sm-3">NOMBRE FANTASIA *</label>
							<div class="col-sm-9">
								<select id="nombreFantasia" class="form-control" name="nombreFantasia" onChange="" required autofocus>
									<option value="">-- Seleccione empresa --</option>
								@foreach($empresas as $emp)
									<option value="{{$emp->nombreFantasia}}">{{$emp->nombreFantasia}} - {{$emp->grupo}} - {{$emp->subGrupo}}</option>
								@endforeach
								</select>							
							</div>	
						</div>
						<div class="form-group row">
							<label for="rut" class="control-label col-sm-3">RUT</label>
							<div class="col-sm-9">
								<input id="rut" type="text" class="form-control" name="rut" value="" required readonly>
							</div>	
						</div>
						<div class="form-group row">
							<label for="razonSocial" class="control-label col-sm-3">RAZÓN SOCIAL</label>
							<div class="col-sm-9">
								<input id="razonSocial" type="text" class="form-control" name="razonSocial" value="" disabled>
							</div>	
						</div>	
						<!-- Datos del cálculo a realizar -->
						<div class="form-group row">
							<label for="rut" class="control-label col-sm-3">CALCULO *</label>
							<div class="col-sm-9">
								<select id="calculo" class="form-control" name="calculo" onchange="obtenerCalculo()" required autofocus>
									<option value="">-- Seleccione cálculo --</option>
								@foreach($tiposHaberes as $tipo)
									<option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
								@endforeach
								</select>							
							</div>	
						</div>
						<!-- Mes/Año a calcular -->
						<div class="form-group row">
							<label for="mes" class="control-label col-sm-3">MES/AÑO *</label>	
							<div class="col-sm-6">
								<input type="month" class="form-control" id="mes" name="mes" value="{{ old('mes') }}" required  autofocus>	
								@if ($errors->has('mes'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('mes') }}</strong>
									</span>
								@endif
							</div>	
						</div>					
			</div>
			<div class="panel-footer">
				<button type="submit" id="cargar" name="cargar" class="btn btn-warning btn-block" onClick=""><i class="fas fa-check"></i> Cargar Empleados</button>
				</form>
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->

<script>
function obtenerCalculo() {
    var x = document.getElementById("calculo").value;
	var f = new Date();
	if(x==2){
		document.getElementById("mes").value = f.getFullYear()+"-06";
		document.getElementById("mes").readOnly = true;
	}
	else if(x==3){
		document.getElementById("mes").value = f.getFullYear()+"-12";
		document.getElementById("mes").readOnly = true;
	}
	else{
		document.getElementById("mes").value = f.getFullYear()+"-0"+f.getMonth();
		document.getElementById("mes").readOnly = false;
	}
}



$(function() 
{
	var empresa = @json($empresas);
	
	$('#nombreFantasia').on('change', function() 
	{
		if (this.value ==  "")
		{
			$("#rut").val("");
			$("#razonSocial").val("");
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
					
					encontre = true;
				}			
				i++;
			}
		}
	})
	
/*	$('#cargar').on('click', function() 
	{		
		var form = $("#formCarga");
		var url = "/empleado/search";
		var data = form.serialize();
		console.log(data);
		
		$.get(url, data, function (result) {
			
			console.log(result);
			//Carga de datos de empleados
			if(result.personas != null)
			{
				$("#documento").text(result.personas[0].tipoDocumento);
				//$("#empleado").text(result.personas.nombre);
			};
				
			/*if(result.personas != null){
				$("#documento").text(result.personas.domicilio);
				
			}
		});
	})
*/	
});

</script>
@endsection