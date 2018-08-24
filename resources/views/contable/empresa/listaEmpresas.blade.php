@extends('contable.contable')

@section('seccion', " - ACTIVAS")

@section('content')

<br>

<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('empresa.create') }}" class="btn btn-warning" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nueva empresa</a></div>				  
</div>
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				  <div class="panel-heading">
					<div class="row">
						<div class="col-sm-9"><h4>LISTADO EMPRESAS ACTIVAS</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('empresa.create') }}" class="btn btn-success pull-right" role="button"><i class="fas fa-plus"></i></a></div>				  
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					<div class="table-responsive">
						<table id="tableEmpresas" class="table" style="width:100%" >
							
							<thead>
							<tr>
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
								<td>{{$empresa->nombreFantasia}}</td>
								<td>{{$empresa->nomContacto}}</td>
								<td>{{$empresa->telefono}}</td>								
								
								
								<td>
									<form method="GET" action="{{route('empresa.show', $empresa->id)}}">																
										<button type="submit"class="btn btn-info"><i class="fas fa-info-circle"></i></button>												
									</form>
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
				  <div class="panel-footer"><a href="{{ route('empresa.create') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-plus"></i> Agregar nueva empresa</a></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
    $('#tableEmpresas').DataTable( {        
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
</script>
@endsection

