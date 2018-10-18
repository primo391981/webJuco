@extends('juridico.juridico')

@section('seccion', " - AGREGAR")

@section('content')
<br>

@if (Session::has('error'))
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div>
@endif 

@if (Session::has('message'))
		<div class="alert alert-success">
			{{Session::get('message')}}
		</div>
@endif 

<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<a class="btn btn-warning pull-right" href="{{route('reporte.index')}}" role="button"><i class="fas fa-undo-alt"></i></a>
				<h4><i class="far fa-building"></i> CREAR REPORTE DE EXPEDIENTE</h4>		
			</div>
			<div class="panel-body">
				<div class="col-xs-12">
						@if(!is_null($expedientes))
							<div class="table-responsive">
								<table id="tableExp" class="table">
									
									<thead>
										<tr>
											<th>ID</th>
											<th>TIPO</th>
											<th>IUE</th>
											<th>CARATULA</th>
											<th>ESTADO</th>
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
											<td>{{$expediente->estado->nombre}}</td>
											<td>
												<form method="POST" action="{{ route('reporte.store.expediente') }}">
													@csrf
													<input type="hidden" name="expediente_id" value="{{$expediente->id}}">
													<button type="submit"class="btn btn-default"><i class="fas fa-check"></i></button>
												</form>
											</td>
										</tr>
									@endforeach
									</tbody>
								
								</table>
							</div>
						@else
							<div class="alert alert-info">No hay expedientes registrados en el sistema.</div>
						@endif
				</div>
			</div>
		</div>
	</div>
</div>


<script>
$(document).ready(function() {
    $('#tableExp').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: '<"top"f>t<"bottom"Bpi><"clear">',
        buttons: []
    } );
	
	
} );
</script>
				
@endsection

