@extends('contable.contable')

@section('seccion', " - ADELANTOS")

@section('content')

@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
			
		</div>
@endif 
@if (Session::has('error'))
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div>
@endif 
<br>
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{ route('pago.create', ['idTipo' => 2]) }}" role="button"><i class="fas fa-plus"></i></a>
				<h4><i class="fas fa-credit-card"></i> LISTADO DE ADELANTOS ACTIVOS </h4>				
			</div>
			<div class="panel-body">
				<div class="table-responsive">
						<table id="tableAdelantos" class="table" style="width:100%" >
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
								@foreach($adelantos->sortBy('empleado.empresa.razonSocial') as $pago)
								<tr>								
									<td>{{$pago->empleado->persona->tipoDoc->nombre}} - {{$pago->empleado->persona->documento}}</td>
									<td>{{$pago->empleado->persona->nombre}} {{$pago->empleado->persona->apellido}}</td>
									<td>{{$pago->empleado->empresa->nombreFantasia}}</td>
									<td>{{$pago->monto}}</td>
									
									<td>{{$pago->fecha}}</td>	
									<td>
										<form method="GET" action="{{ route('pago.edit', $pago) }}">																
											<button type="submit"class="btn btn-warning"><i class="far fa-edit"></i></button>												
										</form>
									</td>				
									<td>
										<form method="POST" action="{{ route('pago.destroy',$pago) }}">
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
    $('#tableAdelantos').DataTable( {        
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

