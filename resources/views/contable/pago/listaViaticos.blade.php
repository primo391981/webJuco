@extends('contable.contable')

@section('seccion', " - ACTIVAS")

@section('content')

<br>

<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				  <div class="panel-heading">
					<div class="row">
						<div class="col-sm-9"><h4>LISTADO VIATICOS</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="#" class="btn btn-warning pull-right" role="button"><i class="fas fa-plus"></i> Agregar nueva empresa</a></div>				  
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
						
						</tbody>
						
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="#" class="btn btn-warning btn-block" role="button"><i class="fas fa-plus"></i> Agregar nueva empresa</a></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
    $('#tableEmpresas').DataTable( {        
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

