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
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-success text-success">
				  <div class="panel-heading">
					<div class="btn-group pull-right">
						@if(Auth::user()->hasRole('juridicoAdmin'))
							<a href="{{ route('expediente.create') }}" class="btn btn-success pull-right" role="button"><i class="fas fa-plus"></i></a>
						@endif
					</div>
					<h4>LISTADO EXPEDIENTES</h4>
				  </div>
				<div class="panel-body text-muted">					
					@if(!is_null($expedientes))
					<div class="table-responsive">
						<table id="tableExp" class="table table-bordered">
							
							<thead>
								<tr class='active'>
									<th class="scope">ID</th>
									<th>TIPO</th>
									<th>IUE</th>
									<th>CARATULA</th>
									<th>CLIENTES</th>
									<th>PASO</th>
									<th></th>
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
									<td>
										@foreach($expediente->clientes as $cliente)
											@if($cliente->persona_type == 'App\Empresa')
												<i class="far fa-building"></i> {{$cliente->persona->razonSocial}}<br>
											@else
												<i class="fas fa-male"></i> {{$cliente->persona->nombre}} {{$cliente->persona->apellido}}<br>
											@endif
											
										@endforeach
									</td>
									<td>{{$expediente->pasos->last()->tipo->nombre}}</td>
									<td>
										<form method="GET" action="{{route('expediente.show', $expediente)}}">																
											<button type="submit"class="btn btn-info"><i class="fas fa-info-circle"></i></button>												
										</form>
									</td>				
									<td>
									@if(Auth::user()->hasRole('juridicoAdmin'))
										
											<form method="GET" action="{{ route('expediente.edit', $expediente) }}">
												@if($expediente->pasos->count() > 1)
													<fieldset disabled>
												@endif
												<button type="submit"class="btn btn-warning"><i class="far fa-edit"></i></button>
												@if($expediente->pasos->count() > 1)
													</fieldset>
												@endif												
												
											</form>
										
									@endif
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