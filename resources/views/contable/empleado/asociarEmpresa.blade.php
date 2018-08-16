@extends('contable.contable') 
@section('seccion', " - ASOSIACIÓN") 
 
@section('content') 
@if (Session::has('error')) 
<br>   
  <div class="alert alert-danger"> 
    {{Session::get('error')}} 
  </div> 
@endif 
<br> 

<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h4>SELECCIONE UNA EMPRESA</h4>
			</div>
			<div class="panel-body text-warning">					
				<div class="table-responsive">
					<table id="tableEmpresas" class="table table-hover">
						<thead>
							<tr>
								<th></th>
								<th>RUT</th>
								<th>RAZON SOCIAL</th>
								<th>NOMBRE FANTASIA</th>
								<th>CONTACTO</th>
								<th>TELÉFONO</th>
								<th>DIRECCIÓN</th>
							</tr>
						</thead>
						<tbody>
						<form>
						@foreach($emprSinAsociar as $empresa)						
							<tr>
								<td><label><input type="radio" name="rb" value="{{$empresa->id}}" onclick="darValor(this)"></label></td>
								<td>{{$empresa->rut}}</td>
								<td>{{$empresa->razonSocial}}</td>
								<td>{{$empresa->nombreFantasia}}</td>
								<td>{{$empresa->nomContacto}}</td>
								<td>{{$empresa->telefono}}</td>	
								<td>{{$empresa->domicilio}}</td>
							</tr>
						@endforeach
						</form>
						</tbody>						
						</table>
					</div>
				  </div>
		</div>	
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h4>DETALLE DEL CONTRATO</h4>
			</div>
			<div class="panel-body text-warning">					
				
				<form method="POST" action="{{ route('empleado.asociarEmpresa',[$persona->id]) }}" class="form-horizontal">
					@csrf
					<input type="hidden" id="idempresa" name="idempresa" value="">
					<div class="form-group row">
						<label for="cargo" class="control-label col-sm-3">CARGO </label>
						<div class="col-sm-6">
							<select name="cargo" class="form-control" id="cargo" required> 
							@foreach($cargos as $key => $tipo) 
								<option value="{{ $tipo->id }}" {{ old('tipo') == $key + 1 ? 'selected' : '' }}>{{ $tipo->nombre }}</option>   
							@endforeach 
                          </select> 
						</div>	
					</div>
					<div class="form-group row">
						<label for="fechaInicio" class="control-label col-sm-3">FECHA INICIO </label>
						<div class="col-sm-6">
							<input type="date" name="fechaInicio" id="fechaInicio" class="form-control" value="{{ old('fechaInicio') }}" required >
						</div>	
					</div>
					<div class="form-group row">
						<label for="fechaFin" class="control-label col-sm-3">FECHA FIN </label>
						<div class="col-sm-6">
							<input type="date" name="fechaFin" id="fechaFin" class="form-control" value="{{ old('fechaFin') }}" required>
						</div>	
					</div>
					<div class="form-group row">
						<label for="monto" class="control-label col-sm-3">MONTO </label>
						<div class="col-sm-6">
							<input type="number" name="monto" id="monto" class="form-control" value="{{ old('monto') }}" min="1" required>
						</div>	
					</div>
					<div class="form-group row">
						<label for="valorhr" class="control-label col-sm-3">VALOR HORA </label>
						<div class="col-sm-6">
							<input type="number" name="valorhr" id="valorhr" class="form-control" value="{{ old('valorhr') }}" min="1" required>
						</div>	
					</div>
					
					<div class="form-group row">
						<label for="noc" class="control-label col-sm-3">HORA NOCTURNIDAD </label>
						<div class="col-sm-6">
							 <input class="checkbox" type="checkbox" name="noc" id="noc">
						 </div>
					</div>
					<div class="form-group row">
						<label for="per" class="control-label col-sm-3">HORA PERNOCTE </label>
						<div class="col-sm-6">
							 <input class="checkbox" type="checkbox" name="per" id="per">
						 </div>
					</div>
					
					<div class="form-group row">
						<div class="col-xs-12 text-center">
							<button type="submit" class="btn btn-warning"><i class="fas fa-check"></i> Confirmar asosiación</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>


<script>
function darValor(radioSeleccionado) { 
 if (radioSeleccionado.checked==true){
   document.getElementById('idempresa').value=radioSeleccionado.value;
 } 
}
</script>



<script>
$(document).ready(function() {
    $('#tableEmpresas').DataTable( {        
		"pagingType": "numbers",
		"pageLength": 5,
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: "<'row'<'col-sm-6'><'col-sm-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-6'><'col-sm-6'p>>" 
		
    } );
} );
</script>



@endsection 
 