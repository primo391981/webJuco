@extends('juridico.juridico')

@section('seccion', " - EDITAR")

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-success text-success">
			<div class="panel-heading">
				<a href="{{ route('cliente.index') }}" class="btn btn-success pull-right" role="button"><i class="fas fa-list-ul"></i></a>
				<h4><i class="far fa-edit"></i> EDITAR DATOS CLIENTE</h4>				
			</div>
			<div class="panel-body">
				
				<form method="POST" action="{{ route('cliente.update', ['persona' => $persona]) }}" class="form-horizontal" enctype="multipart/form-data">
				{{ method_field('PUT') }}
				@if($tipo=='fisica')
					@include('persona.formPersona')
				@else
					@include('persona.formEmpresa')
				@endif 
				
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Confirmar</button>
			</form>
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->
    





				
				
@endsection

