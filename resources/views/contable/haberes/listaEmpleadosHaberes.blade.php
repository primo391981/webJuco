@extends('contable.contable')

@section('seccion', " - ACTIVOS")

@section('content')

@if (Session::has('success'))
<br>	
	<div class="alert alert-success">
		{{Session::get('success')}}
	</div>
@endif 
@if (Session::has('error'))
<br>	
	<div class="alert alert-danger">
		{{Session::get('error')}}
	</div>
@endif 

<br>

<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<h4><i class="fas fa-users"></i> LISTADO DE EMPLEADOS {{$calculo}} </h4>				
			</div>
			<div class="panel-body">
			<form method="POST" action="{{ route('haberes.store') }}">		
			@csrf
			<input type="hidden" id="fecha" name="fecha" value="{{$fecha}}">
			<input type="hidden" id="cantHabilitados" name="cantHabilitados" value="{{$cantHabilitados}}">
								
				<div class="table-responsive">
				<table id="tableEmpleados" class="table" style="width:100%" >
					<thead>
							<tr>
								<th>#</th>
								<th>DOCUMENTO</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th>VIATICOS</th>
								<th>ADELANTOS</th>
								<th>EXTRAS</th>
							</tr>
						</thead>
						<tbody>
							@php $i=1; @endphp
							@foreach($habilitadas as $emp)
							<tr>
								<input type="hidden" id="{{$i}}idEmp" name="{{$i}}idEmp" value="{{$emp[0]->pivot->id}}" {{ $emp[1]==1 ? '' : 'disabled' }}>
								<td><input type="checkbox" id="{{$i}}hab" name="{{$i}}hab" {{ $emp[1]==1 ? 'checked' : 'disabled' }}></td>								
								<td>{{$emp[0]->documento}}</td>
								<td>{{$emp[0]->nombre}}</td>
								<td>{{$emp[0]->apellido}}</td>
								
								
								<td>
									<div class="input-group">
									<input id="v{{$i}}" name="v{{$i}}" type="number" class="form-control input-sm" value="{{$emp[2]}}" readonly>
										<div class="input-group-btn">
											<button type="button" class="abrirModal btn btn-success btn-sm" data-id="{{$emp[0]->pivot->id}}" data-toggle="modal" data-target="#modalViaticoAdd"><i class="fas fa-plus"></i></button>
											<button type="button" class="abrirModal btn btn-info btn-sm" data-id="{{$emp[0]->pivot->id}}" data-toggle="modal" data-target="#modalViaticoList"><i class="fas fa-info-circle"></i></button>
										</div>
									</div>
								</td>
								
								<td>
									<div class="input-group">
									<input id="a{{$i}}" name="a{{$i}}" type="number" class="form-control input-sm" value="{{$emp[3]}}" readonly>
										<div class="input-group-btn">
											<button type="button" class="abrirModal btn btn-success btn-sm" data-id="{{$emp[0]->pivot->id}}" data-toggle="modal" data-target="#modalAdelantoAdd" ><i class="fas fa-plus"></i></button>
											<button type="button" class="abrirModal btn btn-info btn-sm" data-id="{{$emp[0]->pivot->id}}" data-toggle="modal" data-target="#modalAdelantoList"><i class="fas fa-info-circle"></i></button>
										</div>
									</div>
								</td>
								
								
								<td><input id="{{$i}}ex" name="{{$i}}ex" type="number" class="form-control" {{ $emp[1]==1 ? '' : 'disabled' }} value="100"></td>								
							</tr>
							@php $i++;  @endphp
							@endforeach
						</tbody>
				</table>
				</div>
			
			</div>
			
			<div class="panel-footer">
			<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Calcular</button>
			</form>
		</div>
		</div><!--cierre panel-->
		
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->

<!-- Modal add viatico -->
<div id="modalViaticoAdd" class="modal fade" role="dialog">
  <div class="modal-dialog">
 <div class="modal-content text-warning">
      <div class="modal-header"  style="background:#fcf8e3;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fas fa-book"></i> INGRESO DE NUEVO VIATICO</h4>
      </div>
      <div class="modal-body">
		<form class="form-horizontal" action="{{route('pago.altaViatico')}}" method="post">
		@csrf        
		<input type="hidden" id="idEmpleado" name="idEmpleado" value="">
		<input type="hidden" id="fecha" name="fecha" value="{{$fecha}}">
		<div class="form-group">
				<label class="control-label col-sm-3">DESCRIPCION </label>
				<div class="col-sm-9">
					<input class="form-control" type="text" id="desc" name="desc" required>
				</div>
		</div>
		<div class="form-group">
				<label class="control-label col-sm-3">MONTO </label>
				<div class="col-sm-9">
					<input class="form-control" type="number" id="monto" name="monto" min="0" required>
				</div>
		</div>
		<div class="form-group">
				<label class="control-label col-sm-3">DIAS </label>
				<div class="col-sm-9">
					<input class="form-control" type="number" id="dias" name="dias" min="0" required>
				</div>
		</div>
		
		<div class="form-group">
				<label class="control-label col-sm-3">GRAVADO </label>
				<div class="col-sm-9">
					<input type="checkbox" id="gravado" name="gravado"  onclick="habilitarPorcentajeV()">
				</div>
		</div>
		<div class="form-group">
				<label class="control-label col-sm-3">PORCENTAJE </label>
				<div class="col-sm-9">
					<input class="form-control" type="number" id="porcentaje" name="porcentaje" min="1" required disabled>
				</div>
		</div>
		
	  </div>
      <div class="modal-footer">
        <div class="row">
			<div class="col-xs-6">
					<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar</button>
			</div>
			<div class="col-xs-6">
				<button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
			</form>
			</div>
			</div>
	  </div>
    </div>

  </div>
</div><!-- cierre add viatico -->



<script>
$(document).ready(function() {
    $('#tableEmpleados').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: "<'row'<'col-sm-6'><'col-sm-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-6'B><'col-sm-6'>>",
        buttons: [
           { extend: 'print', text: 'IMPRIMIR' },
		   { extend: 'pdf', text: 'PDF' },		   
		   { extend: 'excel', text: 'EXCEL' },
		   { extend: 'copy', text: 'COPIAR' }
        ],
		
    } );
} );

$(document).on("click", ".abrirModal", function () {
     var idEmp = $(this).data('id');
	 var tipoBoton=$(this).val();
     $(".modal-body #idEmpleado").val( idEmp );
	 $(".modal-body #tipobtn").val( tipoBoton );
     // obtener el idEmpleado cuando apreta boton de viaticos,adelanto o extra 
});

function habilitarPorcentajeV() {
    var checkBox = document.getElementById("gravado");
    if (checkBox.checked == true){
        document.getElementById("porcentaje").disabled = false;
    } else {
       document.getElementById("porcentaje").disabled = true;
    }
}

$('.modal').on('hidden.bs.modal', function(){
    $(this).find('form')[0].reset();
});
</script>
@endsection

