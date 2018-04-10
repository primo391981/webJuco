<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->
@extends('layouts.layout_intranet')

<!--@section('titulo-seccion', 'Editar Contenedor')

@section('active', 'active')-->
@section('menu-lateral')
<li><a href="{{ route('contenedor.index') }}"><i class="fas fa-list-ul"></i> Listado</a></li>
<li><a href="{{ route('contenedor.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>



<li>
    <a href="#"><i class="fas fa-th"></i> Contenidos <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('contenido.index') }}"><i class="fas fa-list-ul"></i> Listado</a></li>
			 <li><a href="{{ route('contenido.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>

        </ul>
</li>
@endsection


@section('content')
<br>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-7">
		<div class="panel panel-info">
			<div class="panel-heading text-center"><h4>Editar contenedor</h4></div>
			<div class="panel-body text-info">
					<form method="POST" action="{{ route('contenedor.update', ['contenedor' => $contenedor]) }}" class="form-horizontal">
					{{ method_field('PUT') }}
					@include('cms.contenedor.formContenedor', ['textoBoton' => 'Confirmar'])		
					</form>
			</div>
			<div class="panel-footer"><a href="{{ route('contenedor.index') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-list-ul"></i> Listado contenedores</a></div>
		</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-5">
		
		<div class="panel panel-info">
			<div class="panel-heading text-center"><h4>Contenidos</h4></div>
			<div class="panel-body text-info">
							
								<!--<label for="contenidos" class="col-md-2 control-label"><a id="contenidos"></a>Contenidos</label>-->
									@foreach($contenedor->contenidos->sortBy('orden') as $contenido)
									<div class="row">
										<!--<div class="form-group">-->
											<div class="col-xs-4">
												<p class="text-center">{{ $contenido->titulo }}</p>
											</div>
											<div class="col-xs-2">
												<form class="form-inline" action="" method="POST">
													{{ csrf_field() }}
													<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
													<input type="hidden" name="contenido_id" value="{{ $contenido->id }}">
													<button class="btn btn-link" type="submit" data-toggle="tooltip" title="Eliminar"><i class="far fa-trash-alt" aria-hidden="true"></i></button>
												</form>
											</div>				
											<div class="col-xs-2">
												<a class="btn btn-link" role="button" href="{{ route('contenido.edit', ['contenido' => $contenido]) }}" data-toggle="tooltip" title="Editar">
												<i class="far fa-edit" aria-hidden="true"></i></a>
											</div>
											<div class="col-xs-2">
												@if($contenido->pivot->orden != 1)
												<form  method="POST" class="form-inline" action="{{ route('contenido.up') }}">
													{{ csrf_field() }}
													<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
													<input type="hidden" name="contenido_id" value="{{ $contenido->id }}">
													<button class="btn btn-link" type="submit" data-toggle="tooltip" title="Subir nivel"><i class="fas fa-level-up-alt" aria-hidden="true"></i></button>
												</form>
												@else
													<button class="btn btn-link" style="color:red;" disabled><i class="fas fa-level-up-alt"></i></button>
												@endif												
											</div>
											<div class="col-xs-2">
												@if($contenido->pivot->orden < count($contenedor->contenidos))
													<form method="POST" class="form-inline" action="{{ route('contenido.down') }}" >
													{{ csrf_field() }}
													<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
													<input type="hidden" name="contenido_id" value="{{ $contenido->id }}">
													<button class="btn btn-link" type="submit" data-toggle="tooltip" title="Bajar nivel"><i class="fas fa-level-down-alt" aria-hidden="true"></i></button>
													</form>
												@else
													<button class="btn btn-link" style="color:red;" disabled><i class="fas fa-level-down-alt"></i></button>												
												@endif
											</div>
										<!--</div>-->
									</div>
									<hr>
									@endforeach
								
							
						
			</div>
			<div class="panel-footer"><a href="{{ route('cms') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-sign-in-alt"></i> Ingresar</a></div>
		</div>
	</div>
</div><!--CIERRA ROW-->

<div class=" row">
	<h1>OTRO CONTENIDO</h1>
</div>
@endsection

