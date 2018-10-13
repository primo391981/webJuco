@extends('juridico.juridico')
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

		<div class="panel panel-success text-success">
			<div class="panel-heading">
				<div class="btn-group pull-right">
					<a name="juridico" href="{{ route('reporte.create')}}"><i class="fas fa-plus"></i></a>
				</div>
				<h4>LISTADO REPORTES GERENCIALES</h4>
			</div>
			<div class="panel-body">					
				<div class="table-responsive">
					<table id="tableCli" class="table">
						<thead>
						<tr>
							<th class="scope">ID</th>
							<th>FECHA CREACION</th>
							<th>FECHA INICIO</th>
							<th>FECHA FIN</th>
							<th></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
							@foreach($reportes as $reporte)						
							<tr>
								<td>{{$reporte->id}}</td>
								<td>{{$reporte->created_at}}</td>
								<td>{{$reporte->fecha_desde}}</td>
								<td>{{$reporte->fecha_hasta}}</td>
								<td>
									<form method="GET" action="{{route('reporte.show', $reporte)}}">
										<button type="submit" class="btn btn-info"><i class="fas fa-info-circle"></i></button>
									</form>
								</td>
								<td>
									<form method="POST" action="{{ route('reporte.destroy',$reporte) }}">
										{{ method_field('DELETE') }}
										@csrf	
										<button type="submit"class="btn btn-danger"><i class="far fa-trash-alt" disabled></i></button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
    $('#tableCli').DataTable( {        
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