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
						<a href="{{ route('menuitem.index') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-list"></i></a>				  
					</div>
					<h4><i class="fas fa-th-large"></i> LISTADO ITEMS MENU INACTIVOS</h4>
				</div>
				<div class="panel-body text-muted">					
					<div class="table-responsive">
						<table class="table" id="tableItems"> <!--table-hover-->
							<thead>
								<tr>
									<th>#</th>
									<th>TITULO</th>
									<th>DESCRIPCION</th>
									<th></th>
								</tr>
							</thead>
						<tbody>
						@foreach($menuitems as $menuitem)						
						<tr>
							<td>{{$menuitem->id}}</td>
							<td>{{$menuitem->titulo}}</td>
							<td>{{$menuitem->descripcion}}</td>

							<td>
								<form method="POST" action="{{ route('menuitem.activar') }}">
									@csrf	
									<input type="hidden" name="menuitem_id" value="{{$menuitem->id}}">
									<button type="submit"class="btn btn-danger"><i class="fas fa-recycle"></i></button>												
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
<script>
$(document).ready(function() {
    $('#tableItems').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: '<"top"f>t<"bottom"p><"clear">',
       
    } );
	
	
} );
</script>
@endsection

