@extends('Administracion.useradmin')

@section('navbar')
<a class="navbar-brand" href="#"><strong>ADMIN USUARIOS</strong></a>
@endsection
                
@section('librerias')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.js"></script>
@endsection				

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
		
		<div class="panel panel-default text-muted">
			<div class="panel-heading">
				<a class="btn btn-default pull-right" href="{{ route('user.index') }}" role="button" data-toggle="tooltip" title="Listado de usuarios"><i class="fas fa-list-ul"></i></a>
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
var elem1 = document.querySelector('.js-switch-superadmin');
var checkSuper = new Switchery(elem1);

var elem2 = document.querySelector('.js-switch-cmsadmin');
var checkCMS = new Switchery(elem2);

var elem3 = document.querySelector('.js-switch-juridicoadmin');
var checkContable = new Switchery(elem3);

var elem4 = document.querySelector('.js-switch-contableadmin');
var checkJuridico = new Switchery(elem4);

var elem5 = document.querySelector('.js-switch-invitado');
var checkInvitado = new Switchery(elem5);

elem1.onchange = function() {
  if(elem1.checked){
	  checkCMS.disable();
	  checkContable.disable();
	  checkJuridico.disable();
	  checkInvitado.disable();
  } else {
	 checkCMS.enable();
	  checkContable.enable();
	  checkJuridico.enable();
	  checkInvitado.enable(); 
  }

};

elem5.onchange = function() {
  if(elem5.checked){
	  checkCMS.disable();
	  checkContable.disable();
	  checkJuridico.disable();
	  checkSuper.disable();
  } else {
	 checkCMS.enable();
	  checkContable.enable();
	  checkJuridico.enable();
	  checkSuper.enable(); 
  }

};
</script>

@endsection