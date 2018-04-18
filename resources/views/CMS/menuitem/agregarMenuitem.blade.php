@extends('cms.cms')

@section('seccion', " - Nuevo Item de Menú")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('menuitem.index') }}" class="btn btn-info" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado de Items de Menú</a></div>				  
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel panel-info">
			<div class="panel-heading">
			<div class="row">
					<div class="col-sm-9"><h4>Agregar nuevo Item de Menú</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('menuitem.index') }}" class="btn btn-info" role="button"><i class="fas fa-list-ul"></i> Listado de Items de Menú</a></div>
			</div>	
			</div>	
			
			<div class="panel-body text-info">
					<form method="POST" action="{{ route('menuitem.store') }}" class="form-horizontal">		
						@include('cms.menuitem.formMenuitem', ['textoBoton' => 'Confirmar'])		
					</form>
			</div>
			<div class="panel-footer"><a href="{{ route('menuitem.index') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-list-ul"></i> Listado de Items de Menú</a></div>
		</div>
	</div>
	
	
</div>
			
@endsection

