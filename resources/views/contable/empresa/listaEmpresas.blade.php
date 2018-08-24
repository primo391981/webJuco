@extends('contable.contable')

@section('seccion', " - ACTIVAS")

@section('content')

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
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->

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

