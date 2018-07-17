@extends('contable.contable')

@section('seccion', " - AGREGAR")

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
	<div class="col-xs-12 visible-xs"><a href="{{ route('cargo.index') }}" class="btn btn-warning" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado parámetros generales</a></div>				  
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-9"><h4>AGREGAR NUEVO PARÁMETRO GENERAL</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('parametrogeneral.index') }}" class="btn btn-warning" role="button"><i class="fas fa-list-ul"></i> Listado parámetros gral.</a></div>
				</div>
			</div>
			<div class="panel-body text-warning">
				<form method="POST" action="{{ route('parametrogeneral.store') }}"class="form-horizontal" enctype="multipart/form-data" id="form">
					@include('contable.parametrogeneral.formParametroGral', ['textoBoton' => 'Confirmar'])
				</form>
			</div>
			<div class="panel-footer"><a href="{{ route('parametrogeneral.index') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado parámetros gral.</a></div>
		</div>
	</div>
	
</div>

<script>

$(document).ready(function(){
	var form = $('#form');
	
	
	form.submit(function() {
		var data = form.serialize();
		$.get("/parametrogeneral/search", data, function (result) {
			if(result.mensaje){
				if(confirm(result.mensaje)){
					$.post(form.attr('action'), data, function (result) {
						if(result.mensaje){
							alert(result.mensaje);
						}
					});
				}
			}
		});
		return false; // return false to cancel form action
	});
	
	
});

</script>	
    
	
				
@endsection

