@extends('contable.contable')

@section('seccion', " - DESACTIVADOS")

@section('content')
<script>
$(document).ready(function() {
    $('#tablePersonas').DataTable( {        
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
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('persona.create') }}" class="btn btn-warning" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nuevo empleado</a></div>				  
</div>
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				  <div class="panel-heading">
					<div class="row">
						<div class="col-sm-9"><h4>LISTADO EMPLEADOS DESACTIVADOS</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('persona.create') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-plus"></i> Agregar nuevo empleado</a></div>				  
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					<div class="table-responsive">
						<table id="tablePersonas" class="table">
							
							<thead>
							<tr>
								<th>DOCUMENTO</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th></th>								
							</tr>
						</thead>
						<tbody>
						
						@foreach($personas as $persona)			
						<tr>										
								<td>{{$persona->documento}}</td>
								<td>{{$persona->nombre}}</td>
								<td>{{$persona->apellido}}</td>
								
								<td>
									<form method="GET" action="{{route('persona.restaurar', $persona->id)}}">																
										<button type="submit"class="btn btn-info"><i class="fas fa-recycle"></i></button>												
									</form>
								</td>
											
								
						</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('persona.create') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-plus"></i> Agregar nuevo empleado</a></div>
		</div>
	</div>
</div>

@endsection

