@extends('contable.contable') 
@section('seccion', " - DETALLE") 
 
@section('content') 
@if (Session::has('error')) 
<br>   
  <div class="alert alert-danger"> 
    {{Session::get('error')}} 
  </div> 
@endif 
<br> 
 <div class="row">
 <div class="col-xs-12 col-md-3"> 
    <div class="panel panel-warning"> 
      <div class="panel-heading"> 
        <h4>DETALLE EMPLEADO</h4>           
      </div> 
      <div class="panel-body text-warning">   
		<p>{{$persona->nombre}} {{$persona->apellido}}</p> 
        <hr>
		
			<p><strong>TIPO DOCUMENTO :</strong> {{$persona->tipoDoc->nombre}}</p> 
			<p><strong>DOCUMENTO :</strong> {{$persona->documento}}</p> 
			<p><strong>TELÉFONO :</strong> {{$persona->telefono}}</p> 
			<p><strong>EMAIL :</strong> {{$persona->email}}</p> 
			<p><strong>DOMICILIO :</strong> {{$persona->domicilio}}</p> 
			<p><strong>ESTADO CIVIL :</strong> {{$persona->eCivil->nombre}}</p> 
		    <p><strong>CANTIDAD DE HIJOS :</strong> {{$persona->cantHijos}}</p>
	
      </div> 
      <div class="panel-footer"> 
        <form method="GET" action="{{ route('persona.edit', $persona->id) }}">																
			<button type="submit"class="btn btn-warning btn-block"><i class="far fa-edit"></i> Modificar datos</button>												
		</form>
      </div> 
    </div> 
  </div>
  
  <div class="col-xs-12 col-md-9"> 
    <div class="panel panel-warning"> 
      <div class="panel-heading"> 
        <h4>EMPRESAS ASOCIADAS AL EMPLEADO</h4>           
      </div> 
      <div class="panel-body text-warning">
		@if (count($emprAsociadas) >0)
			<div class="row hidden-xs hidden-sm">
				<div class="col-xs-12">
					<div class="col-xs-12 col-md-4"><p><strong>DETALLE EMPRESA</strong></p></div>
					<div class="col-xs-12 col-md-4"><p><strong>DETALLE CONTRATO</strong></p></div>
					<div class="col-xs-12 col-md-4"><p><strong>DETALLE HORARIO</strong></p></div>
				</div>
			</div>
			@foreach($emprAsociadas as $empr) 
				<div class="row">
					<div class="col-xs-12">
						<div class="col-xs-12 col-md-4">
							<p class="hidden-md hidden-lg"><strong>DETALLE EMPRESA</strong></p>
							<p>{{$empr->razonSocial}}</p>
							<p>{{$empr->nombreFantasia}}</p>
							<p>{{$empr->nomContacto}}</p>
							<p>{{$empr->telefono}}</p>
						</div>
						<div class="col-xs-12 col-md-4">
							<p class="hidden-md hidden-lg"><strong>DETALLE CONTRATO</strong></p>
							<p>Cargo: {{$empr->pivot->idCargo}}</p>
							<p>Inicio: {{$empr->pivot->fechaDesde}}</p>
							<p>Fin: {{$empr->pivot->fechaHasta}}</p>
							<p>Monto: {{$empr->pivot->monto}}</p>
							
						</div>
						<div class="col-xs-12 col-md-4">
							<p class="hidden-md hidden-lg"><strong>DETALLE HORARIO</strong></p>
							
						</div>
					</div>
				</div>
				<hr>
			@endforeach
		@else
			<p>La persona NO esta asociada a ninguna empresa.</p>
		@endif
		           
      </div> 
      <div class="panel-footer"> 
		<form method="GET" action="{{ route('empleado.formCrear', $persona->id) }}">																
			<button type="submit"class="btn btn-warning btn-block"><i class="far fa-handshake"></i> Asociar empresa</button>												
		</form>
	  </div>      
    </div> 
  </div>    
</div> 
	 
@endsection 
 