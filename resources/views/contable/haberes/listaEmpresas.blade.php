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
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="row">
						<div class="col-sm-12"><h4>HABERES</h4></div>
					</div>
				</div>
				
				<div class="panel-body text-warning">
					<form method="POST" class="form-horizontal" enctype="multipart/form-data" id="formCarga">		
						@csrf
						<!-- Datos de la Empresa -->
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
								<select id="calculo" class="form-control" name="calculo" required autofocus>
									<option value="">-- Seleccione cálculo --</option>
								@foreach($tiposHaberes as $tipo)
									<option value="{{$tipo->nombre}}">{{$tipo->nombre}}</option>
								@endforeach
								</select>							
							</div>	
						</div>
						<!-- Mes/Año a calcular -->
						<div class="form-group row">
							<label for="mes" class="control-label col-sm-3">MES *</label>	
							<div class="col-sm-6">
								<input type="month" class="form-control" id="mes" name="mes" value="{{ old('mes') }}" required  autofocus>	
								@if ($errors->has('mes'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('mes') }}</strong>
									</span>
								@endif
							</div>	
						</div>
						<div class="form-group row">
							<br>
							<div class="col-xs-12 text-center">
								<button type="button" id="cargar" name="cargar" class="btn btn-warning btn-lg" onClick=""><i class="fas fa-check"></i> Cargar Empleados</button>
							</div>
						</div>
					</form>
				</div>
				
				<div class="panel-body text-warning">					
					<div class="table-responsive">
						<table id="tableHaberesEmpleados" class="table" style="width:100%" >
							<thead>
								<tr>
									<th>DOCUMENTO</th>
									<th>EMPLEADO</th>
									<th>ADELANTOS</th>
									<th>VIATICOS</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<label for="documento" id="documento" name="documento" class="control-label col-sm-3"></label>
									</td>
									<td>
										<label for="empl" id="empl" name="empl" class="control-label col-sm-3"></label>
									</td>
									<td>
										<label for="adel" id="adel" name="adel" class="control-label col-sm-3"></label>
									</td>
									<td>
										<label for="viat" id="viat" name="viat" class="control-label col-sm-3"></label>
									</td>
								</tr>
							</tbody>						
						</table>
					</div>				
				</div>
				  
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
    $('#tableHaberesEmpleados').DataTable( {        
		"pagingType": "numbers",
		"pageLength": 5,
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: "<'row'<'col-sm-6'><'col-sm-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-6'B><'col-sm-6'p>>",
        buttons: [
           { extend: 'print', text: 'IMPRIMIR' },
		   { extend: 'pdf', text: 'PDF' },		   
		   { extend: 'excel', text: 'EXCEL' },
		   { extend: 'copy', text: 'COPIAR' }
        ],
		
    } );
} );

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
	
	$('#cargar').on('click', function() 
	{		
		var form = $("#formCarga");
		var url = "/empleado/search";
		var data = form.serialize();
		
		$.get(url, data, function (result) {
			console.log(result);
			if(result.personas != null){
				$("#documento").text(result.personas.domicilio);
				
			}
		});
	})
	
});

</script>
@endsection