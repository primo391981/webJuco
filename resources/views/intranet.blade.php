@extends('layouts.layout_intranet')

<!-- SI TIENE MAS DE UN ROL UTILIZA ESTA VIEW -->
@section('menu-lateral')
@if(Auth::user()->hasRole('cmsAdmin'))
<li><a href="{{ route('cms') }}"><i class="fas fa-edit"></i> Edición web</a>
</li>
@endif
@if(Auth::user()->hasRole('juridicoAdmin'))<li><a href="{{ route('juridico') }}"><i class="fas fa-balance-scale"></i> Admin. Jurídica</a></li>@endif
@if(Auth::user()->hasRole('contableAdmin'))<li><a href="{{ route('contable') }}"><i class="fas fa-university"></i> Admin. Contable</a></li>@endif
@endsection

@section('content')

<div class="row">
	<div class="col-xs-12 text-center">
		<h1 class="page-header">Bienvenido administración Juco</h1>
	</div>
</div>					
<div class="row">
			@if(Auth::user()->hasRole('cmsAdmin'))
			<div class="col-xs-12 col-md-4">
				<div class="panel panel-info">
				  <div class="panel-heading"><h4><i class="far fa-edit"></i> MÓDULO DE EDICIÓN WEB</h4></div>
				  <div class="panel-body text-info">
				  <h4>Mantenimineto del sitio web.</h4>
					<hr>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('cms') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-sign-in-alt"></i> Ingresar</a></div>
				</div>				
			</div>
			@endif
			@if(Auth::user()->hasRole('juridicoAdmin'))
			<div class="col-xs-12 col-md-4">
				<div class="panel panel-success">
				  <div class="panel-heading"><h4><i class="fas fa-balance-scale" style="color:green;"></i> MÓDULO JURÍDICO</h4></div>
				  <div class="panel-body text-success">
				  <h4>Gestión de expedientes por empresa o persona/s.</h4>
					<hr>
					<p><i class="fas fa-building"></i> Empresas</p>
					<p><i class="fas fa-users"></i> Persona </p>
				  
				  </div>
				  <div class="panel-footer"><a href="{{ route('juridico') }}" class="btn btn-success btn-block" role="button"><i class="fas fa-sign-in-alt"></i> Ingresar</a></div>
				</div>				
			</div>	
			@endif
			@if(Auth::user()->hasRole('contableAdmin'))
			<div class="col-xs-12 col-md-4">
				<div class="panel panel-warning" >
				  <div class="panel-heading"><h4><i class="fas fa-university"></i> MÓDULO CONTABLE</h4></div>
				  <div class="panel-body text-warning">
					<h4>Gestión de empleados por empresa.</h4>
					<hr>
					<p><i class="fas fa-building"></i> Empresas</p>
					<p><i class="fas fa-users"></i> Empleados </p>
					<p><i class="fas fa-clock"></i> Marcas reloj</p>
					<p><i class="fas fa-briefcase"></i> Cargos</p>
					<p><i class="fas fa-money-bill-alt"></i> Pagos</p>
					<p><i class="fas fa-hand-holding-usd"></i> Liquidación de Haberes</p>
				  </div>
				  <div class="panel-footer"><a href="{{ route('contable') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-sign-in-alt"></i> Ingresar</a></div>
				</div>				
			</div>				
			@endif
</div>
@endsection