@extends('contable.contable')

@section('seccion', " - ACTIVAS")

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
				<a class="btn btn-success pull-right" href="{{ route('empresa.create') }}" role="button"><i class="fas fa-plus"></i></a>
				<h4><i class="fas fa-building"></i> LISTADO DE EMPRESAS ACTIVAS </h4>				
			</div>
			<div class="panel-body">
			
				<div class="table-responsive">
				<table id="tableEmpresas" class="table" style="width:100%" >
							<thead>
							<tr>
								<th>RUT</th>
								<th>RAZÓN SOCIAL</th>
								<th>NOMBRE FANTASIA</th>
								<th>CONTACTO</th>
								<th>TELEFONO</th>
								<th></th>
								<th></th>
								<th></th>								
							</tr>
						</thead>
						<tbody>
						@foreach($empresas as $empresa)						
							<tr>
								<td>{{$empresa->rut}}</td>
								<td>{{$empresa->razonSocial}}</td>
								<td>{{$empresa->nombreFantasia}}</td>
								<td>{{$empresa->nomContacto}}</td>
								<td>{{$empresa->telefono}}</td>		
								<td>
									<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal{{$empresa->id}}"><i class="fas fa-info-circle"></i></button>
									 	 <div class="modal fade" id="modal{{$empresa->id}}" role="dialog">
											<div class="modal-dialog">
											  <div class="modal-content">
												<div class="modal-header">
												  <button type="button" class="close" data-dismiss="modal">&times;</button>
												  <h4 class="modal-title"><i class="fas fa-building"></i> {{$empresa->razonSocial}}</h4>
												</div>
												<div class="modal-body">												  
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
														{{$empresa->cliente}}
												</div>	
												 <div class="modal-footer">
														<button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
													  </div>												
											  </div>											  
											</div>
										  </div>
										  
								</td>	
								<td>
									<form method="GET" action="{{ route('empresa.edit', $empresa->id) }}">																
										<button type="submit"class="btn btn-warning"><i class="far fa-edit"></i></button>												
									</form>
								</td>				
								<td>
									<form method="POST" action="{{ route('empresa.destroy',$empresa->id) }}">
										{{ method_field('DELETE') }}
										@csrf	
										<button type="submit"class="btn btn-danger"><i class="far fa-trash-alt"></i></button>												
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
				</table>
				</div>
			
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->

<script>
$(document).ready(function() {
    $('#tableEmpresas').DataTable( {        
		"pagingType": "numbers",
		"pageLength": 10,
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

