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
				  <div class="panel-heading">
					<div class="row">
						<div class="col-sm-9"><h4>DETALLE EMPRESA</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('empresa.index') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-list-ul"></i> Listado empresas</a></div>	
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					
					<h1>{{$empresa->nombreFantasia}}</h1>
					<hr>
					<div class="row">
						<div class="col-sm-6">
								<h3><strong><em>RUT :</em></strong> {{$empresa->rut}}</h3>
								<h3><strong><em>NÚMERO BPS :</em></strong> {{$empresa->numBps}}</h3>
								<h3><strong><em>NÚMERO BSE :</em></strong> {{$empresa->numBse}}</h3>	
								<h3><strong><em>NÚMERO MTSS :</em></strong> {{$empresa->numMtss}}</h3>	
								<h3><strong><em>GRUPO :</em></strong> {{$empresa->grupo}}</h3>	
								<h3><strong><em>SUBGRUPO :</em></strong> {{$empresa->subGrupo}}</h3>	
						</div>
						<div class="col-sm-6">
								<h3><strong><em>RAZÓN SOCIAL :</em></strong> {{$empresa->razonSocial}}</h3>
								<h3><strong><em>CONTACTO :</em></strong> {{$empresa->nomContacto}}</h3>
								<h3><strong><em>TELÉFONO :</em></strong> {{$empresa->telefono}}</h3>
								<h3><strong><em>CORREO ELECTRÓNICO :</em></strong> {{$empresa->email}}</h3>
								<h3><strong><em>DOMICILIO :</em></strong> {{$empresa->domicilio}}</h3>
						</div>
					</div>
					
				  </div>
		<div class="panel-footer"><a href="{{ route('empresa.index') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado empresas</a></div>
		</div>
	</div>
</div>


@endsection

