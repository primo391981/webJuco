@extends('contable.contable')

@section('seccion', " - DETALLE")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('empresa.index') }}" class="btn btn-warning" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado empresas</a></div>				  
</div>
<div class="row text-info">
	<div class="col-xs-12 col-md-3">
		<div class="panel panel-warning">
				  <div class="panel-heading">
					<div class="row">
						<div class="col-sm-9"><h4>DETALLE EMPRESA</h4></div>
						<!--<div class="col-sm-3 hidden-xs"><a href="{{ route('empresa.index') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-list-ul"></i> Listado empresas</a></div>-->
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					
					<p>{{$empresa->nombreFantasia}}</p>
					<hr>
						
								<p><strong>RUT :</strong> {{$empresa->rut}}</p>
								<p><strong>NÚMERO BPS :</strong> {{$empresa->numBps}}</p>
								<p><strong>NÚMERO BSE :</strong> {{$empresa->numBse}}</p>	
								<p><strong>NÚMERO MTSS :</strong> {{$empresa->numMtss}}</p>	
								<p><strong>GRUPO :</strong> {{$empresa->grupo}}</p>	
								<p><strong>SUBGRUPO :</strong> {{$empresa->subGrupo}}</p>	
								<p><strong>RAZÓN SOCIAL :</strong> {{$empresa->razonSocial}}</p>
								<p><strong>CONTACTO :</strong> {{$empresa->nomContacto}}</p>
								<p><strong>TELÉFONO :</strong> {{$empresa->telefono}}</p>
								<p><strong>EMAIL :</strong> {{$empresa->email}}</p>
								<p><strong>DOMICILIO :</strong> {{$empresa->domicilio}}</p>
						
				  </div>
		<div class="panel-footer"><a href="{{ route('empresa.index') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado empresas</a></div>
		</div>
	</div>
	<div class="col-xs-12 col-md-9">
		<div class="panel panel-warning">
				  <div class="panel-heading">
					<div class="row">
						<div class="col-sm-9"><h4>GESTIÓN EMPLEADOS</h4></div>
					</div>
				  </div>
				  <div class="panel-body text-warning">			
					
					<div class="table-responsive">
						<table id="tableEmpleados" class="table">
							<thead>
							<tr>
								<th>NOMBRE FANTASIA</th>
								<th>CONTACTO</th>
								<th>TELEFONO</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($empleados as $emp)						
							<tr>								
								<td>{{$emp->documento}}</td>
								<td>{{$emp->nombre}}</td>
								<td>{{$emp->apellido}}</td>
								<td>									
									<button type="submit"class="btn btn-info" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-info-circle"></i></button>
										<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										  <div class="modal-dialog" role="document">
											<div class="modal-content">
											  <div class="modal-header">
												<h3 class="modal-title" id="exampleModalLabel">DETALLE EMPLEADO</h3>
											  </div>
											  <div class="modal-body">
													<p><strong>NOMBRE :</strong> {{$emp->nombre}}</p>
													<p><strong>APELLIDO :</strong> {{$emp->apellido}}</p>
													<p><strong>DOCUMENTO :</strong> {{$emp->documento}}</p>
													<p><strong>TELÉFONO :</strong> {{$emp->telefono}}</p>
													<p><strong>CORREO ELECTRÓNICO :</strong> {{$emp->email}}</p>
													<p><strong>DOMICILIO :</strong> {{$emp->domicilio}}</p>
													<p><strong>ESTADO CIVIL :</strong> {{$emp->estadoCivil}}</p>
													<p><strong>CANTIDAD DE HIJOS :</strong> {{$emp->cantHijos}}</p>
											  </div>
											  <div class="modal-footer">
												<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>												
											  </div>
											</div>
										  </div>
										</div>
								</td>
								<td>
									<form method="POST" action="{{ route('empleado.destroy',$emp->id) }}">
									{{ method_field('DELETE') }}
									@csrf	
									<button type="submit"class="btn btn-danger"><i class="far fa-trash-alt"></i> Desvincular</button>	
									</form>
								</td>								
							</tr>
						@endforeach
						</tbody>						
						</table>
					</div>
						
				  </div>
			<div class="panel-footer">
				<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> Agregar nuevo empleado</button>
				
				<div class="modal fade" tabindex="-1" id="myModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">
					   
					   <div class="modal-header">
							<h5 class="modal-title">Modal title</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						 </div>
						 
						<div class="modal-body">
							<form class="form-horizontal" id="form">
						
								<div class="form-group row">
									<label for="documento" class="control-label col-sm-3">DOCUMENTO</label>
									<div class="col-sm-9">
										<input id="documento" type="number" class="form-control" name="documento">
											<span style="color:red;" id="errorDocumento"></span>
									</div>
								</div>
								<div class="form-group row">
									<label for="nombre" class="control-label col-sm-3">NOMBRE</label>
									<div class="col-sm-9">
										<input id="nombre" type="text" class="form-control" name="nombre">
										<span style="color:red;" id="errorNombre"></span>
									</div>	
								</div>
								<div class="form-group row">
									<label for="apellido" class="control-label col-sm-3">APELLIDO</label>
									<div class="col-sm-9">
										<input id="apellido" type="text" class="form-control" name="apellido">
										<span style="color:red;" id="errorApellido"></span>
									</div>	
								</div>
								
							</form>
						</div>
						
						<div class="modal-footer">
							<button type="button" id="Grabar" class="btn btn-primary">Save changes</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					   
					   
					</div>
				  </div>
				</div>
			
			
			</div>
	</div>
	
</div>

<script>
$(document).ready(function() {
    $('#tableEmpleados').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: '<"top"f>t<"bottom"Bpi><"clear">',
        buttons: [
           { extend: 'print', text: 'IMPRIMIR' },
		   { extend: 'pdf', text: 'PDF' },		   
		   { extend: 'excel', text: 'EXCEL' },
		   { extend: 'copy', text: 'COPIAR TABLA' }
        ]
    } );
	
	
} );
</script>

<script>
$("#Grabar").click(function(event){
	var documento=$("#documento").val();
	var nombre=$("#nombre").val();
	var apellido=$("#apellido").val();
	var token=$("input[name=_token]").val();
	
	var ruta="{{route('empleado.store')}}";
	var dataString="documento="+documento+"nombre="+nombre+"apellido="+apellido;
	
	$.ajax({
		url:ruta,
		headers:{'X-CSRF-TOKEN':token},
		type:'post',
		datatype:'json',
		data:dataString,
		success:function(data){
			alert('ok');
		},
		error:function(data)
		{
			$("#errorDocumento").html(data.responseJSON.errors.documento);
			$("#errorNombre").html(data.responseJSON.errors.nombre);
			$("#errorApellido").html(data.responseJSON.errors.apellido);	
		}
	})		
});

$("#myModal").on("hidden.bs.modal",function(){
	$("#errorDocumento").html("")
	$("#errorApellido").html("")
	$("#errorNombre").html("")
	
});
</script>

@endsection

