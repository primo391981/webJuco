@extends('layouts.layout_intranet')

<!-- SI TIENE MAS DE UN ROL UTILIZA ESTA VIEW -->
@section('menu-lateral')
@if(Auth::user()->hasRole('cmsAdmin'))<li><a href="{{ route('cms') }}"><i class="fas fa-edit"></i> Edición web</a></li>@endif
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
			  <div class="col-xs-12 col-sm-6 col-md-4 text-center">
				<div class="panel panel-info">
				  <div class="panel-heading"><h4><i class="fas fa-edit"></i> EDICIÓN WEB</h4></div>
				  <div class="panel-body">lalallalalalalla<br>lalallalalalalla<br>lalallalalalalla<br></div>
				  <div class="panel-footer"><a href="{{ route('cms') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-sign-in-alt"></i> Ingresar</a></div>
				</div>
			  </div>
			@endif
			@if(Auth::user()->hasRole('juridicoAdmin'))
			  <div class="col-xs-12 col-sm-6 col-md-4 text-center">
				<div class="panel panel-success">
				  <div class="panel-heading"><h4><i class="fas fa-balance-scale"></i> JURÍDICO</h4></div>
				  <div class="panel-body">lalallalalalalla</div>
				  <div class="panel-footer"><a href="{{ route('juridico') }}" class="btn btn-success btn-block" role="button"><i class="fas fa-sign-in-alt"></i> Ingresar</a></div>
				</div>
			  </div>
			@endif
			@if(Auth::user()->hasRole('contableAdmin'))
			  <div class="col-xs-12 col-sm-6 col-md-4 text-center">
				<div class="panel panel-warning">
				  <div class="panel-heading"><h4><i class="fas fa-university"></i> CONTABLE</h4></div>
				  <div class="panel-body">lalallalalalalla</div>
				  <div class="panel-footer"><a href="{{ route('contable') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-sign-in-alt"></i> Ingresar</a></div>
				</div>
			  </div>
			@endif
</div>
@endsection