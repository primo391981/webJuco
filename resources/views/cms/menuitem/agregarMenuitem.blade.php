@extends('cms.cms')

@section('seccion', " - Nuevo Item de Menú")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('menuitem.index') }}" class="btn btn-info" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado de Items de Menú</a></div>				  
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="btn-group pull-right">	
					<a href="{{ route('menuitem.index') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-list-ul"></i></a>				  
				</div>
				<h4><i class="fas fa-th-large"></i> NUEVO ITEM MENU</h4>
			</div>
			<div class="panel-body text-muted">
					<form method="POST" action="{{ route('menuitem.store') }}" class="form-horizontal">		
						@include('cms.menuitem.formMenuitem', ['textoBoton' => 'Confirmar'])		
					</form>
			</div>
		</div>
	</div>
	
	
</div>
			
@endsection

