@extends('juridico.juridico')

@section('seccion', " - ACTIVOS")

@section('content')
@if (Session::has('success'))
	<br>
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif

<div class="row">
<form method="GET" action="{{route('expediente.search')}}">
					@csrf
	<div class="form-group">
		<label class="control-label col-xs-12 col-md-3">IUE - Identificación Unica de Expedientes</label>
		@if ($errors->has('iue'))
			<span style="color:red;">{{ $errors->first('iue') }}</span>
		@endif
		<div class="col-xs-12 col-md-9">
			<div class="input-group">
				<input id="iue" name="iue" type="text" class="form-control" required autofocus placeholder="xxxx-xxxx/xxxx - Consulta en el Sistema del Poder Judicial ">
				
				<div class="input-group-btn">
				<button type="submit" class="btn btn-success btn-block"><i class="fas fa-search"></i> Consultar</button>
				</form>
				</div>
			</div>
		</div>	
	</div>

</div>
<hr>

<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-success text-success">
			<div class="panel-heading">
				@if(Auth::user()->hasRole('juridicoAdmin'))
					<a href="{{ route('expediente.create') }}" class="btn btn-success pull-right" role="button"><i class="fas fa-plus"></i></a>
				@endif
				<h4><i class="fas fa-book"></i> LISTADO DE EXPEDIENTES</h4>				
			</div>
			<div class="panel-body">
				@if(!is_null($expedientes))
					<div class="table-responsive">
						<table id="tableExp" class="table">
							
							<thead>
								<tr>
									<th>IDENTIFICACION</th>
									<th>TIPO EXPEDIENTE</th>
									<th class="col-xs-3">CARATULA</th>
									<th>CLIENTES</th>
									<th>PASO ACTUAL</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							@foreach($expedientes as $expediente)						
								<tr>
									<td>{{$expediente->iue}}</td>
									<td>{{$expediente->tipo->nombre}}</td>
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
									<td>{{$expediente->actual->nombre}}</td>
									<td>
										<form method="GET" action="{{route('expediente.show', $expediente)}}">																
											<button type="submit"class="btn btn-info"><i class="fas fa-info-circle"></i></button>												
										</form>
									</td>				
									<td>
									@if(Auth::user()->hasRole('juridicoAdmin'))
										@if($expediente->pasos->count() <= 1)
											<form method="GET" action="{{ route('expediente.edit', $expediente) }}">
												<button type="submit"class="btn btn-warning"><i class="far fa-edit"></i></button>												
											</form>
										@endif
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
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->

<script>
$(document).ready(function() {
    $('#tableExp').DataTable( {        
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