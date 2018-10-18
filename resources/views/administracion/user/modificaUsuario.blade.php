@extends('Administracion.useradmin')

@section('navbar')
<a class="navbar-brand" href="#"><strong>ADMIN USUARIOS</strong></a>
@endsection
                
@section('librerias')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.js"></script>
@endsection				

@section('content')
<br>
@if (Session::has('success'))
	<div class="alert alert-success">
		{{Session::get('success')}}
	</div><br>
@endif 
@if (Session::has('error'))
	<div class="alert alert-danger">
		{{Session::get('error')}}
	</div><br>
@endif 

<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-primary text-muted">
			<div class="panel-heading">
				<a class="btn btn-primary pull-right" href="{{ route('user.index') }}" role="button" data-toggle="tooltip" title="Listado de usuarios"><i class="fas fa-list-ul"></i></a>
				<h4><i class="fas fa-edit"></i> EDITAR USUARIO </h4>				
			</div>
			<div class="panel-body">
				<form method="POST" action="{{ route('user.update', ['id' => $usuario->id]) }}" class="form-horizontal">
					@method('PUT')
					@include('administracion.user.formUsuario')	
			</div>
			<div class="panel-footer">
					<button type="submit" class="btn btn-primary btn-block"><i class="fas fa-check"></i> Confirmar</button>
				</form>
			</div>
		</div>
	</div>
		
</div>

<script>
var elem2 = document.querySelector('.js-switch-cmsadmin');
var checkCMS = new Switchery(elem2);

var elem3 = document.querySelector('.js-switch-juridicoadmin');
var checkJuridico = new Switchery(elem3);

var elem4 = document.querySelector('.js-switch-contableadmin');
var checkContable = new Switchery(elem4);

var elem5 = document.querySelector('.js-switch-invitado');
var checkInvitado = new Switchery(elem5);

elem5.onchange = function() {
  if(elem5.checked){
	  checkCMS.disable();
	  checkContable.disable();
	  checkJuridico.disable();
  } else {
	 checkCMS.enable();
	  checkContable.enable();
	  checkJuridico.enable();
  }

};

$( document ).ready(function() {
	if(elem5.checked){
		checkCMS.disable();
		checkContable.disable();
		checkJuridico.disable();
		checkSuper.disable();
	} 	
});

</script>

@endsection