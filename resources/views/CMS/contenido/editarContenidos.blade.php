@extends('cms.cms')

@section('seccion', " - Nuevo Contenido")

@section('content')
<br>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading text-center"><h4>Editar Contenido</h4></div>
			<div class="panel-body text-info">
				<form method="POST" action="{{ route('contenido.update', ['contenido' => $contenido]) }}" class="form-horizontal" enctype="multipart/form-data">
				{{ method_field('PUT') }}
				@include('cms.contenido.formContenido', ['textoBoton' => 'Confirmar'])
				</form>
				
			</div>
			<div class="panel-footer"><a href="{{ route('contenido.index') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-list-ul"></i> Listado contenidos</a></div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading text-center"><h4>Contenedores</h4></div>
			<div class="panel-body text-info">
				<!--<form method="POST" action="{{ route('contenido.update', ['contenido' => $contenido]) }}" class="form-horizontal">
				{{ method_field('PUT') }}
				@include('cms.contenido.formContenido', ['textoBoton' => 'Confirmar'])
				</form>-->
				
			</div>
			<!--<div class="panel-footer"><a href="{{ route('contenido.index') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-list-ul"></i> Listado contenidos</a></div>
			-->
		</div>
	</div>
	
	
</div>	
				
@endsection

