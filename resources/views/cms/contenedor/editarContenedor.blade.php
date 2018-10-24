@extends('cms.cms')

@section('content')
<br>
@if (Session::has('error'))
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div><br>
@endif 

@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div><br>
@endif 
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="btn-group pull-right">	
					<a href="{{ route('contenedor.index') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-list-ul"></i></a>				  
				</div>
				<h4><i class="fas fa-th-large"></i> EDITAR CONTENEDOR</h4>
			</div>	
			
			<div class="panel-body text-muted">
				<div class="col-xs-12 col-md-7">
					<div class="row">
						<div class="col-xs-12">
							<h4>CONTENEDOR</h4>
							<hr class="hidden-xs hidden-sm">
						</div>
					</div>
					<form method="POST" action="{{ route('contenedor.update', ['contenedor' => $contenedor]) }}" class="form-horizontal">
					@method('PUT')
					@csrf
					@include('cms.contenedor.formContenedor', ['textoBoton' => 'Confirmar'])		
					</form>
				</div>
				<div class="col-xs-12 col-md-5">
				
					<div class="row">
						<div class="col-xs-12">
							<button class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal"> <i class="fas fa-plus"></i></button>
							<h4>CONTENIDOS ASOCIADOS</h4>
							<hr class="hidden-xs hidden-sm">
						</div>
					</div>
					<table class="table table-condensed">
						<thead>
							<tr>
								<th>#</th>
								<th>TITULO</th>
								<th colspan="4">ACCIONES</th>
							</tr>
						</thead>
						<tbody>
					@foreach($contenedor->contenidos->sortBy('orden') as $contenido)
						<tr>
							<td>{{ $contenido->id }}</td>
							<td>{{ $contenido->titulo }}</td>
							<td>
								<form class="form-inline" action="{{ route('contenido.deassign') }}" method="POST">
									{{ csrf_field() }}
									<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
									<input type="hidden" name="contenido_id" value="{{ $contenido->id }}">
									<button class="btn btn-danger" type="submit" data-toggle="tooltip" title="Eliminar"><i class="far fa-trash-alt" aria-hidden="true"></i></button>
								</form>
							</td>				
							<td>
								<a class="btn btn-warning" role="button" href="{{ route('contenido.edit', ['contenido' => $contenido]) }}" data-toggle="tooltip" title="Editar">
								<i class="far fa-edit" aria-hidden="true"></i></a>
							</td>
							<td>
								@if($contenido->pivot->orden != 1)
									<form  method="POST" class="form-inline" action="{{ route('contenido.up') }}">
										{{ csrf_field() }}
										<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
										<input type="hidden" name="contenido_id" value="{{ $contenido->id }}">
										<button class="btn btn-default" type="submit" data-toggle="tooltip" title="Subir nivel"><i class="fas fa-level-up-alt" aria-hidden="true"></i></button>
									</form>
								@else
									<button class="btn btn-default" style="color:red;" disabled><i class="fas fa-level-up-alt"></i></button>
								@endif												
							</td>
							<td>
								@if($contenido->pivot->orden < count($contenedor->contenidos))
									<form method="POST" class="form-inline" action="{{ route('contenido.down') }}" >
										{{ csrf_field() }}
										<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
										<input type="hidden" name="contenido_id" value="{{ $contenido->id }}">
										<button class="btn btn-default" type="submit" data-toggle="tooltip" title="Bajar nivel"><i class="fas fa-level-down-alt" aria-hidden="true"></i></button>
									</form>
								@else
									<button class="btn btn-default" style="color:red;" disabled><i class="fas fa-level-down-alt"></i></button>												
								@endif
							</td>
						</tr>
					@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div><!--CIERRA ROW-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Asociar contenido</h4>
      </div>
	  <div class="modal-body">
			<div class="table-responsive">
				<table class="table" id="tableContenidos">
					<thead>
						<tr>
							<th>#</th>
							<th>NOMBRE</th>
							<th>TEXTO</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($contenidos as $contenido)						
						<tr>
							<td>{{$contenido->id}}</td>
							<td>{{$contenido->titulo}}</td>
							<td>{!!str_limit($contenido->texto,20)!!}</td>
							<td>
								<form method="POST" action="{{ route('contenido.assign',$contenido->id) }}">
									@csrf	
									<input type="hidden" name="contenido_id" value="{{$contenido->id}}">
									<input type="hidden" name="contenedor_id" value="{{$contenedor->id}}">
									<button type="submit"class="btn btn-default"><i class="fas fa-check"></i></button>
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
<!-- fin Modal -->

<script>
$(document).ready(function() {
    $('#tableContenidos').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: '<"top"f>t<"bottom"Bpi><"clear">',
        buttons: []
    } );
	
	
} );
</script>

@endsection

