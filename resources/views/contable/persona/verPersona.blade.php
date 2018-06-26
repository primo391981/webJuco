@extends('contable.contable')

@section('seccion', " - DETALLE")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('persona.index') }}" class="btn btn-warning" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado empleados</a></div>				  
</div>
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				  <div class="panel-heading">
					<div class="row">
						<div class="col-sm-9"><h4>DETALLE EMPLEADO</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('persona.index') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-list-ul"></i> Listado empleados</a></div>	
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					
					<h1>{{$persona->nombre}} {{$persona->apellido}}</h1>
					<hr>
					<div class="row">
						<div class="col-sm-6">
								<h3><strong><em>DOCUMENTO :</em></strong> {{$persona->documento}}</h3>
								<h3><strong><em>TELÉFONO :</em></strong> {{$persona->telefono}}</h3>
								<h3><strong><em>CORREO ELECTRÓNICO :</em></strong> {{$persona->email}}</h3>
								<h3><strong><em>DOMICILIO :</em></strong> {{$persona->domicilio}}</h3>
								<h3><strong><em>ESTADO CIVIL :</em></strong> {{$persona->estadoCivil}}</h3>
								<h3><strong><em>CANTIDAD DE HIJOS :</em></strong> {{$persona->cantHijos}}</h3>
						</div>
						<div class="col-sm-6">
								
						</div>
					</div>
					
				  </div>
		<div class="panel-footer"><a href="{{ route('persona.index') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado empleados</a></div>
		</div>
	</div>
</div>


@endsection

