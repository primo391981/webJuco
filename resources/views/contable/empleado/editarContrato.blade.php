@extends('contable.contable') 
 
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
				<h4><i class="far fa-handshake"></i> EDITAR CONTRATO EMPLEADO</h4>
			</div>
			<div class="panel-body text-warning">					
				<div class="row">
					<div class="col-xs-12"><p><i class="fas fa-user"></i> {{$empleado->persona->tipoDoc->nombre}} {{$empleado->persona->documento}} - {{$empleado->persona->nombre}} {{$empleado->persona->apellido}}</p></div>
					<div class="col-xs-12"><p><i class="fas fa-building"></i> {{$empleado->empresa->nombreFantasia}}</p></div>
				</div>
				
			<hr>
			
			<form  method="post" action="{{route('empleado.guardarEditContrato')}} "class="form-horizontal">
					@csrf
					<input type="hidden" id="idEmpleado" name="idEmpleado" value="{{$empleado->id}}">
					<div class="form-group row">
						<label for="cargo" class="control-label col-sm-3">CATEGORIA </label>
						<div class="col-sm-6">
							<select name="cargo" class="form-control" id="cargo" required> 
							@foreach($cargos as $key => $tipo) 
								<option value="{{ $tipo->id }}" {{ $tipo->id == $empleado->idCargo ? 'selected' : '' }}>{{ $tipo->nombre }} - {{$tipo->remuneracion->nombre}}</option>   
							@endforeach 
                          </select> 
						</div>	
					</div>
					<div class="form-group row">
						<label for="tipo" class="control-label col-sm-3">TIPO HORARIO</label>
						<div class="col-sm-6">
							<select name="tipo" class="form-control" id="tipo" required> 
								<option value="1"	{{ ($empleado->tipoHorario)==1 ? 'selected' : '' }} >HABITUAL</option>   
								<option value="2" {{ ($empleado->tipoHorario)==2 ? 'selected' : '' }}>FLEXIBLE</option>   
						  </select> 
						</div>	
					</div>
					<div class="form-group row">
						<label for="fechaInicio" class="control-label col-sm-3">FECHA INICIO *</label>
						<div class="col-sm-6">
							<input type="date" name="fechaInicio" id="fechaInicio" class="form-control" value="{{$empleado->fechaDesde}}" required >
						</div>	
					</div>
					<div class="form-group row">
						<label for="fechaFin" class="control-label col-sm-3">FECHA FIN </label>
						<div class="col-sm-6">
							<input type="date" name="fechaFin" id="fechaFin" class="form-control" value="{{($empleado->fechaHasta) == '2118-01-01'? '': $empleado->fechaHasta }}" >
						</div>	
					</div>
					<div class="form-group row">
						<label for="monto" class="control-label col-sm-3">MONTO *</label>
						<div class="col-sm-6">
							<input type="number" name="monto" id="monto" class="form-control" value="{{$empleado->monto}}" min="1" required>
						</div>	
					</div>
					<div class="form-group row">
						<label for="esp" class="control-label col-sm-3">HORAS DE ESPERA </label>
						<div class="col-sm-6">
							 <input class="checkbox" type="checkbox" name="esp" id="esp" {{ ($empleado->espera)==true ? 'checked' : '' }}>
						 </div>
					</div>
					
					<div class="form-group row">
						<label for="noc" class="control-label col-sm-3">HORA NOCTURNIDAD </label>
						<div class="col-sm-6">
							 <input class="checkbox" type="checkbox" name="noc" id="noc" {{ ($empleado->nocturnidad)==true ? 'checked' : '' }}>
						 </div>
					</div>
					<div class="form-group row">
						<label for="per" class="control-label col-sm-3">HORA PERNOCTE </label>
						<div class="col-sm-6">
							 <input class="checkbox" type="checkbox" name="per" id="per" {{ ($empleado->pernocte)==true ? 'checked' : '' }}>
						 </div>
					</div>
			</div>
			<div class="panel-footer"><button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar edición</button>
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
 