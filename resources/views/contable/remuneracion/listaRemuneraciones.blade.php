@extends('contable.contable')

@section('seccion', " - Listado")

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('remuneracion.create') }}" class="btn btn-warning" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nueva remuneración</a></div>				  
</div>
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				  <div class="panel-heading text-center">
					<div class="row">
						<div class="col-sm-9"><h4>Listado remuneraciones</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('remuneracion.create') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-plus"></i> Agregar nueva remuneración</a></div>				  
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
						@foreach($remuneraciones as $remuneracion)						
							<tr>
								<td>{{$remuneracion->id}}</td>
								<td>{{$remuneracion->nombre}}</td>
								<td>{{$remuneracion->descripcion}}</td>
								
							</tr>
						@endforeach
						</tbody>
						
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('remuneracion.create') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-plus"></i> Agregar nueva remuneración</a></div>
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