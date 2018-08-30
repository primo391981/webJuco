@extends('contable.contable')

@section('seccion', " - ACTIVOS")

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
				<a class="btn btn-success pull-right" href="{{ route('cargo.create') }}" role="button"><i class="fas fa-plus"></i></a>
				<h4><i class="fas fa-briefcase"></i> LISTADO DE CARGOS ACTIVOS </h4>				
			</div>
			<div class="panel-body">
				<div class="table-responsive">
						<table id="tableCargos" class="table">
							
							<thead>
							<tr>
								<th class="scope">ID</th>
								<th>NOMBRE</th>
								<th>DESCRIPCION</th>
								<th>TIPO REMUNERACION</th>
								<th></th>
								<th></th>
								
							</tr>
						</thead>
						<tbody>
						@foreach($cargos as $cargo)						
							<tr>
								<td>{{$cargo->id}}</td>
								<td>{{$cargo->nombre}}</td>
								<td>{{$cargo->descripcion}}</td>
								<td>{{--$cargo->remuneracion->nombre--}}</td>
								<td>
									<form method="GET" action="{{ route('cargo.edit', $cargo) }}">																
										<button type="submit"class="btn btn-warning"><i class="far fa-edit"></i></button>												
									</form>
								</td>				
								<td>
									<form method="POST" action="{{ route('cargo.destroy',$cargo) }}">
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
    $('#tableCargos').DataTable( {        
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