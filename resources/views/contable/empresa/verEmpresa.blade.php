@extends('contable.contable')

@section('seccion', " - DETALLE")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('empresa.index') }}" class="btn btn-warning" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado empresas</a></div>				  
</div>
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				  <div class="panel-heading text-center">
					<div class="row">
						<div class="col-sm-9"><h4>DETALLE EMPRESA</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('empresa.index') }}" class="btn btn-warning" role="button"><i class="fas fa-list-ul"></i> Listado empresas</a></div>	
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					
					<h1>{{$empresa->nombreFantasia}}</h1>
					<hr></hr>
					<h3><strong><em>RUT :</em></strong> {{$empresa->rut}}  <strong><em>RAZON SOCIAL :</em></strong> {{$empresa->razonSocial}}</h3>
					
					
					
					
					
					
				  </div>
		<div class="panel-footer"><a href="{{ route('empresa.index') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado empresas</a></div>
		</div>
	</div>
</div>


@endsection

