@extends('contable.contable')

@section('seccion', " - Listado")

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('cargo.create') }}" class="btn btn-warning" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nuevo cargo</a></div>				  
</div>
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				  <div class="panel-heading text-center">
					<div class="row">
						<div class="col-sm-9"><h4>Listado cargos</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('cargo.create') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-plus"></i> Agregar nuevo cargo</a></div>				  
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					<div class="table-responsive">
						<table id="tableEmpresas" class="table"> <!--table-hover-->
							
							<thead>
							<tr>
								<th class="scope">ID</th>
								<th>nombre</th>
								<th>descripción</th>
								
							</tr>
						</thead>
						<tbody>
						@foreach($cargos as $cargo)						
							<tr>
								<td>{{$cargo->id}}</td>
								<td>{{$cargo->nombre}}</td>
								<td>{{$cargo->descripcion}}</td>
								<td><a href="{{ route('cargo.edit', ['cargo' => $cargo])}}" data-toggle="tooltip" title="Editar"><i class="far fa-edit"></i></a> <a href="#" data-toggle="tooltip" title="Eliminar"><i class="far fa-trash-alt"></i></a>
							</td>
							</tr>
						@endforeach
						</tbody>
						
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('cargo.create') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-plus"></i> Agregar nuevo cargo</a></div>
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