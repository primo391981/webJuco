@extends('contable.contable') <!--layotu: carpeta contable/blade contable-->

@section('seccion', " - EDITAR")

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('persona.index') }}" class="btn btn-warning" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado empleados</a></div>				  
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-9"><h4>EDITAR EMPLEADO</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('persona.index') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-list-ul"></i> Listado empleados</a></div>
				</div>
			</div>
			
			<div class="panel-body text-warning">
					<form method="POST" action="{{ route('persona.update',$persona->id) }}" class="form-horizontal">		
						 {{ method_field('PUT') }}
						 {{ csrf_field() }}
						 <div class="form-group row">
							<label for="documento" class="control-label col-sm-3">DOCUMENTO</label>
							<div class="col-sm-9">
								<input id="documento" type="number" class="form-control" name="documento" value="{{$persona->documento}}" required autofocus>
								@if ($errors->has('documento'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('documento') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="nombre" class="control-label col-sm-3">NOMBRE</label>
							<div class="col-sm-9">
								<input id="nombre" type="text" class="form-control" name="nombre" value="{{$persona->nombre}}"required>
								@if ($errors->has('nombre'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('nombre') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="apellido" class="control-label col-sm-3">APELLIDO</label>
							<div class="col-sm-9">
								<input id="apellido" type="text" class="form-control" name="apellido" value="{{$persona->apellido}}"required>
								@if ($errors->has('apellido'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('apellido') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						  <div class="form-group row">
							<label for="domicilio" class="control-label col-sm-3">DOMICILIO</label>
							<div class="col-sm-9">
								<input id="domicilio" type="text" class="form-control" name="domicilio" value="{{$persona->domicilio}}"required>
								@if ($errors->has('domicilio'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('domicilio') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="email" class="control-label col-sm-3">CORREO ELECTRÓNICO</label>
							<div class="col-sm-9">
								<input id="email" type="email" class="form-control" name="email" value="{{$persona->email}}">
								@if ($errors->has('email'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						  <div class="form-group row">
							<label for="telefono" class="control-label col-sm-3">TELEFONO</label>
							<div class="col-sm-9">
								<input id="telefono" type="text" class="form-control" name="telefono" value="{{$persona->telefono}}"required>
								@if ($errors->has('telefono'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('telefono') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						  <div class="form-group row">
							<label for="estadoCivil" class="control-label col-sm-3">ESTADO CIVIL</label>
							<div class="col-sm-9">
								<input id="estadoCivil" type="text" class="form-control" name="estadoCivil" value="{{$persona->estadoCivil}}"required>
								@if ($errors->has('estadoCivil'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('estadoCivil') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="cantHijos" class="control-label col-sm-3">CANTIDAD DE HIJOS</label>
							<div class="col-sm-9">
								<input id="cantHijos" type="number" class="form-control" name="cantHijos" value="{{$persona->cantHijos}}" required>
								@if ($errors->has('cantHijos'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('cantHijos') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						 
						 
						 
						<div class="form-group row">
								<br>
								<div class="col-xs-12 text-center">
									<button type="submit" class="btn btn-warning btn-lg"><i class="fas fa-check"></i> Confirmar</button>
								</div>
						</div>
					</form>
			</div>
			
			<div class="panel-footer"><a href="{{ route('persona.index') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado empleados</a></div>
		</div>
	</div>
	
</div>
			
@endsection

