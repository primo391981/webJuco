@extends('cms.cms')

@section('seccion', " - Nuevo Contenido")

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
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="btn-group pull-right">	
					<a href="{{ route('contenido.index') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-list-ul"></i></a>				  
				</div>
				<h4><i class="fas fa-th-large"></i> EDITAR CONTENIDO</h4>
			</div>
			<div class="panel-body text-muted">
				<div class="col-xs-12 col-md-7">
					<div class="row">
						<div class="col-xs-12">
							<h4>CONTENEDOR</h4>
							<hr class="hidden-xs hidden-sm">
						</div>
					</div>
					<form method="POST" action="{{ route('contenido.update', ['contenido' => $contenido]) }}" class="form-horizontal" enctype="multipart/form-data">
					{{ method_field('PUT') }}
					@include('cms.contenido.formContenido', ['textoBoton' => 'Confirmar'])
					</form>
				</div>
				<div class="col-xs-12 col-md-5">
					<div class="row">
						<div class="col-xs-12">
							<h4>CONTENEDORES ASOCIADOS</h4>
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
					@foreach($contenido->contenedor as $contenedor)
						<tr>
							<td>{{ $contenedor->id }}</td>
							<td>{{ $contenedor->titulo }}</td>
							<td>
								<form class="form-inline" action="{{ route('contenido.deassign') }}" method="POST">
									{{ csrf_field() }}
									<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
									<input type="hidden" name="contenido_id" value="{{ $contenido->id }}">
									<button class="btn btn-danger" type="submit" data-toggle="tooltip" title="Eliminar"><i class="far fa-trash-alt" aria-hidden="true"></i></button>
								</form>
							</td>				
							<td>
								<a class="btn btn-warning" role="button" href="{{ route('contenedor.edit', ['contenedor' => $contenedor]) }}" data-toggle="tooltip" title="Editar">
								<i class="far fa-edit" aria-hidden="true"></i></a>
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
				
@endsection

