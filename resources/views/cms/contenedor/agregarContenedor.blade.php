@extends('cms.cms')


@if(1==1)
	@section('ayuda')
		<li class="nav-item"> 
			<button class="btn btn-link" data-toggle="modal" data-target="#modalAyuda" title="Ayuda"><i class="fas fa-question-circle"></i> </button>
		</li>
	@endsection
	@section('contentAyuda')
		<h1>Ayuda para creación de contenedor</h1>
	@endsection
@endif	

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
					<a href="{{ route('contenedor.index') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-list-ul"></i></a>				  
				</div>
				<h4><i class="fas fa-th-large"></i> CREAR CONTENEDOR</h4>
			</div>			
			
			<div class="panel-body text-muted">
					<form method="POST" action="{{ route('contenedor.store') }}" class="form-horizontal">
						@csrf					
						@include('cms.contenedor.formContenedor', ['textoBoton' => 'Confirmar'])		
					</form>
			</div>
		</div>
	</div>
</div>
			
@endsection

