@extends('contable.contable')

@section('seccion', " - Listado")

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('empresa.create') }}" class="btn btn-warning" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nueva empresa</a></div>				  
</div>
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				  <div class="panel-heading text-center">
					<div class="row">
						<div class="col-sm-9"><h4>Listado empresas</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('empresa.create') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-plus"></i> Agregar nueva empresa</a></div>				  
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					<div class="table-responsive">
						<table id="tableEmpresas" class="table table-hover"> <!--table-hover-->
							
							<thead>
							<tr>
								<th>NOMBRE FANTASIA</th>
								<th>CONTACTO</th>
								<th>TELEFONO</th>
								<th>ACCION</th>
								
							</tr>
						</thead>
						<tbody>
						@foreach($empresas as $empresa)						
							<tr>								
								<td>{{$empresa->nombreFantasia}}</td>
								<td>{{$empresa->nomContacto}}</td>
								<td>{{$empresa->telefono}}</td>								
								<td>
								<a href="{{route('empresa.show', $empresa->id)}}" data-toggle="tooltip" title="Detalle"><i class="fas fa-info-circle fa-lg"></i></a>
								<a href="{{ route('empresa.edit', $empresa->id)}}" data-toggle="tooltip" title="Editar"><i class="far fa-edit fa-lg"></i></a>
								<a href="#" data-toggle="tooltip" title="Eliminar"><i class="far fa-trash-alt fa-lg"></i></a>	
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
@endsection

