@extends('cms.cms')

@section('seccion', " - Editar Item de Menú")

@section('content')
<br>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-7">
		<div class="panel panel-info">
			<div class="panel-heading text-center"><h4>Editar Item de Menú</h4></div>
			<div class="panel-body text-info">
					<form method="POST" action="{{ route('menuitem.update', ['menuitem' => $menuitem]) }}" class="form-horizontal">
					{{ method_field('PUT') }}
					@include('cms.menuitem.formMenuitem', ['textoBoton' => 'Confirmar'])		
					</form>
			</div>
			<div class="panel-footer"><a href="{{ route('menuitem.index') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-list-ul"></i> LISTADO ITEMS MENU</a></div>
		</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-5">
		
		<div class="panel panel-info">
			<div class="panel-heading text-center"><h4>Contenedores</h4></div>
			<div class="panel-body text-info">
														
								<!--<label for="contenidos" class="col-md-2 control-label"><a id="contenidos"></a>Contenidos</label>-->
									@foreach($menuitem->contenedores->sortBy('orden_menu') as $contenedor)
									<div class="row">
										<!--<div class="form-group">-->
											<div class="col-xs-4">
												<p class="text-center">{{ $contenedor->id }} {{ $contenedor->titulo }}</p>
											</div>
											<div class="col-xs-2">
												<form class="form-inline" action="{{ route('contenedor.deassign') }}" method="POST">
													{{ csrf_field() }}
													<input type="hidden" name="menuitem_id" value="{{ $menuitem->id }}">
													<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
													<button class="btn btn-link" type="submit" data-toggle="tooltip" title="Eliminar"><i class="far fa-trash-alt" aria-hidden="true"></i></button>
												</form>
											</div>				
											<div class="col-xs-2">
												<a class="btn btn-link" role="button" href="{{ route('contenedor.edit', ['contenedor' => $contenedor]) }}" data-toggle="tooltip" title="Editar">
												<i class="far fa-edit" aria-hidden="true"></i></a>
											</div>
											<div class="col-xs-2">
												@if($contenedor->orden_menu != 1)
												<form  method="POST" class="form-inline" action="{{ route('contenedor.up') }}">
													{{ csrf_field() }}
													<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
													<input type="hidden" name="menuitem_id" value="{{ $menuitem->id }}">
													<button class="btn btn-link" type="submit" data-toggle="tooltip" title="Subir nivel"><i class="fas fa-level-up-alt" aria-hidden="true"></i></button>
												</form>
												@else
													<button class="btn btn-link" style="color:red;" disabled><i class="fas fa-level-up-alt"></i></button>
												@endif												
											</div>
											<div class="col-xs-2">
												@if($contenedor->orden_menu < count($menuitem->contenedores))
													<form method="POST" class="form-inline" action="{{ route('contenedor.down') }}" >
													{{ csrf_field() }}
													<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
													<input type="hidden" name="menuitem_id" value="{{ $menuitem->id }}">
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
			<div class="panel-footer"><button class="btn btn-info btn-block" data-toggle="modal" data-target="#myModal"><i class="fas fa-hands-helping"></i> Asociar contenido</button>
			</div>
			
		</div>
	</div>
</div><!--CIERRA ROW-->
@endsection

