@extends('contable.contable')

@section('seccion', " - EDITAR")

@section('content')
<br>
@if (Session::has('success'))
	<div class="alert alert-success">
		{{Session::get('success')}}
	</div>
@endif 
@if (Session::has('error'))
	<div class="alert alert-danger">
		{{Session::get('error')}}
	</div>
@endif 
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('pago.viaticos') }}" class="btn btn-warning" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado viáticos</a></div>				  
</div>
<br>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-9"><h4>EDITAR VIATICO</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('pago.viaticos') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-list-ul"></i> Listado viáticos</a></div>
				</div>
			</div>
			<div class="panel-body text-warning">
				<form method="POST" action="{{ route('pago.update', ['pago' => $pago]) }}" class="form-horizontal" enctype="multipart/form-data">
				{{ method_field('PUT') }}
				@include('contable.pago.formEditPagos', ['textoBoton' => 'Confirmar'])
				</form>
				
			</div>
			<div class="panel-footer"><a href="{{ route('pago.viaticos') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado viáticos</a></div>
		</div>
	</div>
	
	
	
</div>	
				
@endsection
