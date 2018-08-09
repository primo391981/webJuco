@extends('contable.contable')

@section('seccion', " - VIATICOS")

@section('content')

<br>

<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				  <div class="panel-heading">
					<div class="row">
						<div class="col-sm-9"><h4>LISTADO VIATICOS</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="#" class="btn btn-warning pull-right" role="button"><i class="fas fa-plus"></i> Agregar nuevo viático</a></div>				  
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					<div class="table-responsive">
						<table id="tableViaticos" class="table" style="width:100%" >
							<thead>
								<tr>
									<th>DOCUMENTO</th>
									<th>EMPLEADO</th>
									<th>EMPRESA</th>
									<th>MONTO</th>
									<th>FECHA</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($viaticos->sortBy('empleado.empresa.razonSocial') as $pago)
								<tr>								
									<td>{{$pago->empleado->persona->tipoDoc->nombre}} - {{$pago->empleado->persona->documento}}</td>
									<td>{{$pago->empleado->persona->nombre}} {{$pago->empleado->persona->apellido}}</td>
									<td>{{$pago->empleado->empresa->nombreFantasia}}</td>
									<td>{{$pago->monto}}</td>
									
									<td>{{$pago->fecha}}</td>	
									<td> </td>				
									<td> </td>									
								</tr>
								@endforeach
							</tbody>						
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="#" class="btn btn-warning btn-block" role="button"><i class="fas fa-plus"></i> Agregar nuevo viático</a></div>
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

