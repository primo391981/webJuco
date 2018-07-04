@extends('contable.contable')

@section('seccion', " - Listado")

@section('content')

<br>
@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif 
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				  <div class="panel-heading text-center">
					<div class="row">
						<div class="col-sm-9"><h4>Listado parámetros generales Activos</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('parametrogeneral.create') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-plus"></i> Agregar nuevo parámetro general</a></div>				  
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					<div class="table-responsive">
						<table id="tableEmpresas" class="table">
							
							<thead>
							<tr>
								<th class="scope">ID</th>
								<th>nombre</th>
								<th>descripción</th>
								<th>fecha inicio</th>
								<th>fecha fin</th>
								<th>valor</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($params as $param)						
							<tr>
								<td>{{$param->id}}</td>
									
								<td>{{$param->nombre}}</td>
								<td>{{$param->descripcion}}</td>
								<td>{{$param->fecha_inicio}}</td>
								<td>{{$param->fecha_fin}}</td>
								<td>{{$param->valor}}</td>
								<td>
									<form method="POST" action="{{ route('parametrogeneral.activar') }}">
										@csrf	
										<input type="hidden" name="param_id" value="{{$param->id}}">
										<button type="submit"class="btn btn-danger"><i class="fas fa-recycle"></i></button>												
									</form>
									</td>
							</tr>
						@endforeach
						</tbody>
						
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('parametrogeneral.create') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-plus"></i> Agregar nuevo parámetro general</a></div>
		</div>
	</div>
</div>
<script>
$(window).resize(function() {
    if( $(this).width() > 1024 ) {
        $(document).ready(function() {
    $('#tableEmpresas').DataTable();
} );
    }
});


</script>
@endsection