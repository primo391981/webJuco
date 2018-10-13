@extends('layouts.layout_intranet')

@section('navbar')
<a class="navbar-brand" href="#"><strong>ADMIN USUARIOS</strong></a>
@endsection
@section('menu-lateral')
<li><a href="{{ route('user.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
<li><a href="{{ route('user.create') }}"><i class="fas fa-user-plus"></i> Agregar nuevo</a></li>
<li><a href="{{ route('user.index.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12 text-center">
		<h1 class="page-header">Bienvenido administración de usuarios</h1>
	</div>
</div>					
<div class="row">
			  <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 text-center">
				<div class="panel panel-info">
				  <div class="panel-heading"><h4><i class="fas fa-users"></i> Usuarios</h4></div>
				  <div class="panel-body">
				  
				  </div>
				 <!-- <div class="panel-footer"><a href="{{ route('cms') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-sign-in-alt"></i> Ingresar</a></div>-->
				</div>
			  </div>
</div>
@endsection

