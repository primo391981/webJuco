@extends('contable.contable')

@section('seccion', " - DETALLE")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('persona.index') }}" class="btn btn-warning" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado empleados</a></div>				  
</div>
<div class="row text-info">
	<div class="col-xs-12 col-md-offset-2 col-md-8">
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
					
								<h3><strong><em>DOCUMENTO :</em></strong> {{$persona->documento}}</h3>
								<h3><strong><em>TELÉFONO :</em></strong> {{$persona->telefono}}</h3>
								<h3><strong><em>CORREO ELECTRÓNICO :</em></strong> {{$persona->email}}</h3>
								<h3><strong><em>DOMICILIO :</em></strong> {{$persona->domicilio}}</h3>
								<h3><strong><em>ESTADO CIVIL :</em></strong> {{$persona->estadoCivil}}</h3>
								<h3><strong><em>CANTIDAD DE HIJOS :</em></strong> {{$persona->cantHijos}}</h3>
					</div>
					
				@if ($empleado)	
				<div class="panel-footer">				
					<form method="POST" action="{{ route('empleado.destroy',$empleado->id) }}">
					{{ method_field('DELETE') }}
					@csrf	
					<button type="submit"class="btn btn-danger btn-block"><i class="fas fa-sign-out-alt"></i> Desvincular de la empresa</button>	
					</form>
				</div>
				@else
				<div class="panel-footer">	
							<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#myModal"><i class="fas fa-handshake"></i> Asociar a empresa</button>
				</div>
				@endif
			
	</div>
</div>							
						
						
					


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--<div class="modal-header">
        <h3 class="modal-title text-warning" id="exampleModalLabel">SELECCIONE UNA EMPRESA</h3>
      </div>-->
      <div class="modal-body">
		<div class="table-responsive">
						<table class="table table-sm">
							
							<thead>
							<tr>
								<th>RAZON SOCIAL</th>
								<th>NOMBRE FANTASIA</th>
								<th></th>								
							</tr>
						</thead>
						<tbody>
						@foreach($empresas as $emp)						
							<tr>								
								<td>{{$emp->razonSocial}}</td>
								<td>{{$emp->nombreFantasia}}</td>
												
								<td>
									<form method="POST" action="{{route('empleado.altaAsociacion',[$emp->id,$persona->id]) }}">																
									@csrf
										<button type="submit"class="btn btn-warning"><i class="fas fa-check"></i> Confirmar</button>												
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
						
						</table>
					</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        
      </div>
    </div>
  </div>
</div>



@endsection

