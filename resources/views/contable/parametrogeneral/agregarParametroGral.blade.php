@extends('contable.contable')

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
function myFunction() {
    var x = document.getElementById("nombre").value;
    if(x=='VMD1' || x=='VMD2' || x=='BPC' || x=='FRL' || x=='BPS'){
		document.getElementById("minimo").readOnly=true;
		document.getElementById("maximo").readOnly=true;		
	}
	else if(x=='IRPF1'){
		document.getElementById("minimo").readOnly=false;
		document.getElementById("maximo").readOnly=true;
	}
	else if(x=='IRPF2' || x=='IRPF3' || x=='IRPF4' || x=='IRPF5' || x=='IRPF6' || x=='IRPF7'){
		document.getElementById("minimo").readOnly=false;
		document.getElementById("maximo").readOnly=false;
	}
	else if(x=='IRPF8'){
		document.getElementById("minimo").readOnly=true;
		document.getElementById("maximo").readOnly=false;
	}
	else if(x=='TFD1'){
		document.getElementById("minimo").readOnly=true;
		document.getElementById("maximo").readOnly=false;
	}
	else if(x=='TFD2'){
		document.getElementById("minimo").readOnly=false;
		document.getElementById("maximo").readOnly=true;
	}
	else if(x=='FONASA1' ||x=='FONASA2' ||x=='FONASA3' ||x=='FONASA4'){
		document.getElementById("minimo").readOnly=true;
		document.getElementById("maximo").readOnly=false;
	}
	else if(x=='FONASA5' ||x=='FONASA6' ||x=='FONASA7' ||x=='FONASA8'){
		document.getElementById("minimo").readOnly=false;
		document.getElementById("maximo").readOnly=true;
	}
	
}

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

