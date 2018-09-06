@extends('contable.contable') <!--layotu: carpeta contable/blade contable-->

@section('seccion', " - AGREGAR")

@section('content')

<br>
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{ route('empresa.index') }}" role="button" data-toggle="tooltip" title="Listado de empresas"><i class="fas fa-list-ul"></i></a>
				<h4><i class="fas fa-building"></i> AGREGAR NUEVA EMPRESA </h4>				
			</div>
			<div class="panel-body">
			<form method="POST" action="{{ route('empresa.store') }}">		
			
				 @include('persona.formEmpresa')
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar</button>
			</form>
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->
@endsection

