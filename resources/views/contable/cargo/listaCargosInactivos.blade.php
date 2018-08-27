@extends('contable.contable')

@section('seccion', " - INACTIVOS")

@section('content')


@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif 
<script>
$(document).ready(function() {
    $('#tableCargos').DataTable( {        
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
<br>

<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<h4><i class="fas fa-briefcase"></i> LISTADO DE CARGOS INACTIVOS </h4>				
			</div>
			<div class="panel-body">
				<div class="table-responsive">
						<table id="tableCargos" class="table">
							
							<thead>
							<tr>
								<th class="scope">ID</th>
								<th>NOMBRE</th>
								<th>DESCRIPCIÓN</th>
								<th>TIPO DE REMUNERACIÓN</th>
								<th></th>								
							</tr>
						</thead>
						<tbody>
						@foreach($cargos as $cargo)						
							<tr>
								<td>{{$cargo->id}}</td>
								<td>{{$cargo->nombre}}</td>
								<td>{{$cargo->descripcion}}</td>
								<td>{{$cargo->remuneracion->nombre}}</td>
								<td>
									<form method="POST" action="{{ route('cargo.activar') }}">
										@csrf	
										<input type="hidden" name="cargo_id" value="{{$cargo->id}}">
										<button type="submit"class="btn btn-primary"><i class="fas fa-recycle"></i></button>												
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
@endsection