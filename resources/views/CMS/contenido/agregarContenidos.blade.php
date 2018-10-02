@extends('cms.cms')

@section('seccion', " - Nuevo Contenido")

@section('content')
<br>

<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="btn-group pull-right">	
					<a href="{{ route('contenido.index') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-list-ul"></i></a>				  
				</div>
				<h4><i class="fas fa-th-large"></i> AGREGAR CONTENIDO</h4>
			</div>
			<div class="panel-body text-info">
				<form method="POST" action="{{ route('contenido.store') }}"class="form-horizontal" enctype="multipart/form-data">
					@include('cms.contenido.formContenido', ['textoBoton' => 'Confirmar'])
				</form>
			</div>
		</div>
	</div>
	
</div>
    
	
				
@endsection

