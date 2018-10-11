@extends('cms.cms')

@section('seccion', " - Editar Item de Menú")

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
				<a class="btn btn-info pull-right" href="{{route('menuitem.index')}}" role="button"><i class="fas fa-list-ul"></i></a>
				<h4><i class="far fa-building"></i> EDITAR ITEM MENU</h4>		
			</div>
			<div class="panel-body text-muted">
				<div class="col-md-7 col-xs-12">
					<h4>DETALLES ITEM</h4>
					<hr class="hidden-xs hidden-sm">
					<form method="POST" action="{{ route('menuitem.update', ['menuitem' => $menuitem]) }}" class="form-horizontal">
					{{ method_field('PUT') }}
					@include('cms.menuitem.formMenuitem', ['textoBoton' => 'Confirmar'])		
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
						@foreach($menuitem->contenedores->sortBy('orden_menu') as $contenedor)
						<tr>
							<td>{{ $contenedor->id }}</td>
							<td>{{ $contenedor->titulo }}</td>
							<td>
								<form class="form-inline" action="{{ route('contenedor.deassign') }}" method="POST">
									{{ csrf_field() }}
									<input type="hidden" name="menuitem_id" value="{{ $menuitem->id }}">
									<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
									<button class="btn btn-danger" type="submit" data-toggle="tooltip" title="Eliminar"><i class="far fa-trash-alt" aria-hidden="true"></i></button>
								</form>
							</td>				
							<td>
								<a class="btn btn-warning" role="button" href="{{ route('contenedor.edit', ['contenedor' => $contenedor]) }}" data-toggle="tooltip" title="Editar">
								<i class="far fa-edit" aria-hidden="true"></i></a>
							</td>
							<td>
								@if($contenedor->orden_menu != 1)
									<form  method="POST" class="form-inline" action="{{ route('contenedor.up') }}">
										{{ csrf_field() }}
										<input type="hidden" name="menuitem_id" value="{{ $menuitem->id }}">
										<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
										<button class="btn btn-default" type="submit" data-toggle="tooltip" title="Subir nivel"><i class="fas fa-level-up-alt" aria-hidden="true"></i></button>
									</form>
								@else
									<button class="btn btn-default" style="color:red;" disabled><i class="fas fa-level-up-alt"></i></button>
								@endif
							</td>
							<td>
								@if($contenedor->orden_menu < count($menuitem->contenedores))
									<form method="POST" class="form-inline" action="{{ route('contenedor.down') }}" >
										{{ csrf_field() }}
										<input type="hidden" name="menuitem_id" value="{{ $menuitem->id }}">
										<input type="hidden" name="contenedor_id" value="{{ $contenedor->id }}">
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
@endsection

