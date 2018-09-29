@extends('contable.contable')

@section('seccion', " - AGREGAR")

@section('content')
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
<br>
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{ route('parametrogeneral.index') }}" role="button" data-toggle="tooltip" title="Listado de parametros"><i class="fas fa-list-ul"></i></a>
				<h4><i class="fas fa-cogs"></i> AGREGAR NUEVO PARAMETRO GENERAL </h4>				
			</div>
			<div class="panel-body">

				<form method="POST" action="{{ route('parametrogeneral.store') }}"class="form-horizontal" enctype="multipart/form-data" id="form">
					@include('contable.parametrogeneral.formParametroGral', ['readonly' => ''])
				</div>
				<div class="panel-footer">
				<button type="submit" class="btn btn-warning btn-block" id="btnSubmit"><i class="fas fa-check"></i> Confirmar</button>
			</form>
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->
				

<script>

$(document).ready(function(){
	var form = $('#form');
	var btnSubmit = $("#btnSubmit");
	btnSubmit.click(function() {
		//e.preventDefault();
		if( $('#nombre').val()=="" || $('#fecha_inicio').val()=="" || $('#valor').val()==""){
			console.log("check");
			//form.submit();
			return true;
		} else {
			console.log("check1");
			var data = form.serialize();
			$.get("/parametrogeneral/search", data, function (result) {
				if(result.find){
					console.log("check2");
					if(confirm(result.mensaje)){
						console.log("check3");
						form.submit();
					}
				} else {
					form.submit();
				}
			});
		}
		console.log("check final");
		return false;
		

	});
	
	
});

</script>	
    
	
				
@endsection

