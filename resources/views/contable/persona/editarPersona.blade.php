@extends('contable.contable') <!--layotu: carpeta contable/blade contable-->

@section('seccion', " - EDITAR")

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{ route('persona.index') }}" role="button" data-toggle="tooltip" title="Listado de empleados"><i class="fas fa-list-ul"></i></a>
				<h4><i class="far fa-edit"></i> EDITAR EMPLEADO </h4>				
			</div>
			<div class="panel-body">

					<form method="POST" action="{{ route('persona.update',$persona->id) }}" class="form-horizontal">		
						 {{ method_field('PUT') }}
						  @include('persona.formPersona') 
						  @include('persona.formPersonaInfo')
					</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar</button>
			</form>
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->
@endsection

