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
		<div class="panel-footer">
			<form method="GET" action="{{ route('empresa.edit', $empresa->id) }}">																
				<button type="submit"class="btn btn-warning btn-block"><i class="far fa-edit"></i> Modificar datos</button>												
			</form>
		</div>
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
								<th>DOCUMENTO</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th>TELEFONO</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($empresa->empleados as $emp)						
							<tr>								
								<td>{{$emp->tipoDoc->nombre}} - {{$emp->documento}}</td>
								<td>{{$emp->nombre}}</td>
								<td>{{$emp->apellido}}</td>
								<td>{{$emp->telefono}}</td>
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
													<p><strong>TIPO DOCUMENTO :</strong> {{$emp->tipoDoc->nombre}}</p>
													<p><strong>DOCUMENTO :</strong> {{$emp->documento}}</p>
													<p><strong>TELÉFONO :</strong> {{$emp->telefono}}</p>
													<p><strong>CORREO ELECTRÓNICO :</strong> {{$emp->email}}</p>
													<p><strong>DOMICILIO :</strong> {{$emp->domicilio}}</p>
													<p><strong>ESTADO CIVIL :</strong> {{$emp->eCivil->nombre}}</p>
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
									
								</td>								
							</tr>
						@endforeach
						</tbody>						
						</table>
					</div>
						
				  </div>
			<div class="panel-footer">
				<form method="GET" action="#">																
					<button type="submit"class="btn btn-warning btn-block"><i class="far fa-handshake"></i> Asociar empleado</button>												
				</form>
			</div>
	</div>
	
</div>
<script>
$(document).ready(function() {
    $('#tableEmpleados').DataTable( {        
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
</script>
@endsection

