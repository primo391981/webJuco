@extends('cms.cms')

@section('seccion', " - Items de Menú")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('menuitem.create') }}" class="btn btn-info" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nuevo</a></div>				  
</div>

<div class="row text-info">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
			<div class="panel panel-info">
				  <div class="panel-heading">
				  <div class="row">
					<div class="col-sm-9"><h4>Listado de items de Menú (activos) ??</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('menuitem.create') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-plus"></i> Agregar nuevo</a></div>				  
				  </div>
				  </div>
				  
				  <div class="panel-body text-info">					
					<div class="table-responsive">
						<table class="table"> <!--table-hover-->
							<thead>
							<tr>
								<th>ID</th>
								<th>Título</th>
								<th>Descripción</th>
								<th>Órden Menú</th>
							</tr>
						</thead>
						<tbody>
						@foreach($menuitems as $menuitem)						
						<tr>
							<td>{{$menuitem->id}}</td>
							<td>{{$menuitem->titulo}}</td>
							<td>{{$menuitem->descripcion}}</td>
							<td>{{$menuitem->orden_menu}}</td>
							<td><a href="{{ route('menuitem.edit', ['menuitem' => $menuitem])}}" data-toggle="tooltip" title="Editar"><i class="far fa-edit"></i></a> <a href="#" data-toggle="tooltip" title="Eliminar"><i class="far fa-trash-alt"></i></a>
							</td>
						</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('menuitem.create') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-plus"></i> Agregar nuevo</a></div>
		</div>
	</div>
</div>	
@endsection

