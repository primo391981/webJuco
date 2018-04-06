<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->
@extends('cms.layouts.layout_cms')

@section('titulo-seccion', 'Editar Contenedor')

@section('active', 'active')

@section('content')
                
	<form method="POST" action="{{ route('contenedor.update', ['contenedor' => $contenedor]) }}">
	{{ method_field('PUT') }}
	@include('cms.contenedor.formContenedor', ['textoBoton' => 'editar contenedor'])
		
	</form>		

						<div class="form-horizontal">
							<div class="form-group">
								<label for="contenidos" class="col-md-2 control-label"><a id="contenidos"></a>Contenidos</label>
								<div class="col-md-10">
									@foreach($contenedor->contenidos->sortBy('orden') as $contenido)
										<div class="form-group">
											<div class="col-md-8">
												{{ $contenido->titulo }}
											</div>
											<div class="col-md-1">
												<form class="form-inline" action="" method="POST">
													{{ csrf_field() }}
													<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
													<input type="hidden" name="contenido_id" value="{{ $contenido->id }}">
													<button class="btn btn-link" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
												</form>
											</div>
											<div class="col-md-1">
												<a class="btn btn-link" role="button" href="{{ route('contenido.edit', ['contenido' => $contenido]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											</div>
											<div class="col-md-1">
											@if($contenido->pivot->orden != 1)
												<form  method="POST" class="form-inline" action="{{ route('contenido.up') }}">
													{{ csrf_field() }}
													<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
													<input type="hidden" name="contenido_id" value="{{ $contenido->id }}">
													<button class="btn btn-link" type="submit"><i class="fa fa-level-up" aria-hidden="true"></i></button>
												</form>
											@endif
											</div>
											<div class="col-md-1">
											@if($contenido->pivot->orden < count($contenedor->contenidos))
												<form method="POST" class="form-inline" action="{{ route('contenido.down') }}" >
												
													{{ csrf_field() }}
													<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
													<input type="hidden" name="contenido_id" value="{{ $contenido->id }}">
													<button class="btn btn-link" type="submit"><i class="fa fa-level-down" aria-hidden="true"></i></button>
												</form>
											@endif
											</div>
										</div>
									@endforeach
								</div>
								
								
							</div>
						</div>	
@endsection

