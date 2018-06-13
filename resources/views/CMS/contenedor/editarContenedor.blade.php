@extends('cms.cms')

@section('seccion', " - Editar Contenedor")

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
												<p class="text-center">{{ $contenido->id }} {{ $contenido->titulo }}</p>
											</div>
											<div class="col-xs-2">
												<form class="form-inline" action="{{ route('contenido.deassign') }}" method="POST">
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
			<div class="panel-footer"><button class="btn btn-info btn-block" data-toggle="modal" data-target="#myModal"><i class="fas fa-hands-helping"></i> Asociar contenido</button>
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
        <h4 class="modal-title" id="myModalLabel">Seleccionar contenido</h4>
      </div>
      <div class="modal-body">
			<form id="form-search" action="{{ route('contenido.search') }}">
				@csrf
				<div class="input-group">
				  <input type="text" class="form-control" placeholder="Search for..." name="search">
				  <span class="input-group-btn">
					<button class="btn btn-default" id="btn_buscar" value="buscar">busqueda</button>
				  </span>
				</div><!-- /input-group -->
			</form>
      </div>
	  <div class="modal-body">
			<table class="table table-striped" id="contenidos">
			</table>
			
			<form id='form-delete' action="{{ route('contenido.assign', ':CONTENIDO_ID') }}">
				{{ csrf_field() }}
				<input type="hidden" name="contenedor_id" value="{{ $contenedor->id}}">
			</form>
		
	  </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- fin Modal -->

<script>
$(document).ready(function(){
	
	$('#contenidos').on('click','.btn-delete',function () {
        
		//e.preventDefault();
		
		var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':CONTENIDO_ID', id);
        var data = form.serialize();
		
        $.post(url, data, function (result) {
            alert(result.message);
			location.reload();
        }).fail(function () {
            alert('El contenido no fue asignado');
        });
		
    });
	
	$('#btn_buscar').click(function(e){
		
		e.preventDefault();
		
		$('#contenidos').empty();
		$('#contenidos').append("<tr><th>#</th><th>Nombre</th></tr>");
		var form = $('#form-search');
		var url = form.attr('action');
		var data = form.serialize();
		
		$.get(url, data, function(result){
			
			$.each(result, function( index, value ) {
				$.each(value, function( i, v ) {
					$("#contenidos").append("<tr data-id='"+v.id+"'><td>"+v.id+"</td><td>"+v.titulo+"</td><td><a href='#!' class='btn-delete' id='"+v.id+"' >asignar</a></td></tr>");
				});
				
			});
			
			

		});
		
	});
	
	
});



</script>

<div class=" row">
	<h1>OTRO CONTENIDO</h1>
</div>
@endsection

