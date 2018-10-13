@extends('cms.cms')

@section('seccion', " - Items de Menú")

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
						<a href="{{ route('menuitem.create') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-plus"></i></a>				  
					</div>
					<h4><i class="fas fa-th-large"></i> LISTADO ITEMS MENU</h4>
				</div>
				<div class="panel-body text-muted">					
					<div class="table-responsive">
						<table class="table" id="tableItems"> <!--table-hover-->
							<thead>
								<tr>
									<th>#</th>
									<th>Título</th>
									<th>Descripción</th>
									<th>Subir Orden</th>
									<th>Bajar Orden</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
						<tbody>
						@foreach($menuitems as $menuitem)						
						<tr>
							<td>{{$menuitem->orden_menu}}</td>
							<td>{{$menuitem->titulo}}</td>
							<td>{{$menuitem->descripcion}}</td>

							<td>
								@if($menuitem->orden_menu != 1)
									<form  method="POST" class="form-inline" action="{{ route('menuitem.up') }}">
										{{ csrf_field() }}
										<input type="hidden" name="menuitem_id" value="{{ $menuitem->id }}">
										<button class="btn btn-default" type="submit" data-toggle="tooltip" title="Subir nivel"><i class="fas fa-level-up-alt" aria-hidden="true"></i></button>
									</form>
								@else
									<button class="btn btn-default" style="color:red;" disabled><i class="fas fa-level-up-alt"></i></button>
								@endif												
							</td>							
							<td>
								@if($menuitem->orden_menu < count($menuitems))
									<form method="POST" class="form-inline" action="{{ route('menuitem.down') }}" >
										{{ csrf_field() }}
										<input type="hidden" name="menuitem_id" value="{{ $menuitem->id }}">
										<button class="btn btn-default" type="submit" data-toggle="tooltip" title="Bajar nivel"><i class="fas fa-level-down-alt" aria-hidden="true"></i></button>
									</form>
								@else
									<button class="btn btn-default" style="color:red;" disabled><i class="fas fa-level-down-alt"></i></button>							
								@endif
							</td>
							
							<td><a class="btn btn-warning" href="{{ route('menuitem.edit', ['menuitem' => $menuitem])}}" data-toggle="tooltip" title="Editar" ><i class="far fa-edit"></i></a></td>
							
							<td>
								<form method="POST" action="{{ route('menuitem.destroy', $menuitem) }}">
									@method('DELETE')
									@csrf
									@if($menuitem->contenedores->count() > 0)
										<fieldset disabled>
									@endif
									<button type="submit"class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
									@if($menuitem->contenedores->count() > 0)
										</fieldset>
									@endif												
								</form>
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
<script>
$(document).ready(function() {
    $('#tableItems').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: '<"top"f>t<"bottom"Bpi><"clear">',
        buttons: [
           { extend: 'print', text: 'IMPRIMIR' },
		   { extend: 'pdf', text: 'PDF' },		   
		   { extend: 'excel', text: 'EXCEL' },
		   { extend: 'copy', text: 'COPIAR TABLA' }
        ]
    } );
	
	
} );
</script>
@endsection

