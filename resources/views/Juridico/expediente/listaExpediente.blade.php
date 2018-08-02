@extends('juridico.juridico')

@section('seccion', " - ACTIVOS")

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('cliente.create') }}" class="btn btn-success" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nuevo expediente</a></div>				  
</div>
@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif 
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel">
				  <div class="panel-heading">
					<div class="row">
						<div class="col-sm-9"><h4>LISTADO EXPEDIENTES</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('expediente.create') }}" class="btn btn-success pull-right" role="button"><i class="fas fa-plus"></i> Agregar nuevo expediente</a></div>				  
					</div>
				  </div>
				  <div class="panel-body text-muted">					
					<div class="table-responsive">
						<table id="tableExp" class="table table-bordered">
							
							<thead>
							<tr class='active'>
								<th class="scope">ID</th>
								<th>TIPO</th>
								<th>IUE</th>
								<th>CARATULA</th>
								<th>PASO</th>
								<th></th>
								
							</tr>
						</thead>
						<tbody>
						@foreach($expedientes as $expediente)						
							<tr>
								<td>{{$expediente->id}}</td>
								<td>{{$expediente->tipo->nombre}}</td>
								<td>{{$expediente->iue}}</td>
								<td>{{$expediente->caratula}}</td>
								<td>{{$expediente->paso_actual}}</td>
								<td>
									<form method="GET" action="{{route('expediente.show', $expediente)}}">																
										<button type="submit"class="btn btn-info"><i class="fas fa-info-circle"></i></button>												
									</form>
								</td>				
								<td>
									<form method="GET" action="{{ route('expediente.edit', $expediente) }}">																
										<button type="submit"class="btn btn-warning"><i class="far fa-edit"></i></button>												
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
						
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('expediente.create') }}" class="btn btn-success btn-block" role="button"><i class="fas fa-plus"></i> Agregar expediente</a></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
    $('#tableExp').DataTable( {        
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