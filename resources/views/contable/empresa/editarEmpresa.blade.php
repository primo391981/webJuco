@extends('contable.contable') <!--layotu: carpeta contable/blade contable-->

@section('seccion', " - EDITAR")

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('empresa.index') }}" class="btn btn-warning" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado empresas</a></div>				  
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-9"><h4>EDITAR EMPRESA</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('empresa.index') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-list-ul"></i> Listado empresas</a></div>
				</div>
			</div>
			
			<div class="panel-body text-warning">
					<form method="POST" action="{{ route('empresa.update',$empresa->id) }}" class="form-horizontal">		
						 {{ method_field('PUT') }}
						 {{ csrf_field() }}
						 <div class="form-group row">
							<label for="rut" class="control-label col-sm-3">RUT</label>
							<div class="col-sm-9">
								<input id="rut" type="number" class="form-control" name="rut" value="{{$empresa->rut}}" required min="0" autofocus>
								@if ($errors->has('rut'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('rut') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						<div class="form-group row">
							<label for="razonSocial" class="control-label col-sm-3">RAZÓN SOCIAL</label>
							<div class="col-sm-9">
								<input id="razonSocial" type="text" class="form-control" name="razonSocial" value="{{$empresa->razonSocial}}">
								@if ($errors->has('razonSocial'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('razonSocial') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="nombreFantasia" class="control-label col-sm-3">NOMBRE FANTASIA</label>
							<div class="col-sm-9">
								<input id="nombreFantasia" type="text" class="form-control" name="nombreFantasia" value="{{$empresa->nombreFantasia}}">
								@if ($errors->has('nombreFantasia'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('nombreFantasia') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						  <div class="form-group row">
							<label for="domicilio" class="control-label col-sm-3">DOMICILIO</label>
							<div class="col-sm-9">
								<input id="domicilio" type="text" class="form-control" name="domicilio" value="{{$empresa->domicilio}}">
								@if ($errors->has('domicilio'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('domicilio') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						  <div class="form-group row">
							<label for="numBps" class="control-label col-sm-3">NÚMERO BPS</label>
							<div class="col-sm-9">
								<input id="numBps" type="number" class="form-control" name="numBps" value="{{$empresa->numBps}}" min="0">
								@if ($errors->has('numBps'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('numBps') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="numBse" class="control-label col-sm-3">NÚMERO BSE</label>
							<div class="col-sm-9">
								<input id="numBse" type="number" class="form-control" name="numBse" value="{{$empresa->numBse}}" min="0">
								@if ($errors->has('numBse'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('numBse') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="numMtss" class="control-label col-sm-3">NÚMERO MTSS</label>
							<div class="col-sm-9">
								<input id="numMtss" type="number" class="form-control" name="numMtss" value="{{$empresa->numMtss}}" min="0">
								@if ($errors->has('numMtss'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('numMtss') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="grupo" class="control-label col-sm-3">GRUPO</label>
							<div class="col-sm-9">
								<input id="grupo" type="number" class="form-control" name="grupo" value="{{$empresa->grupo}}" min="0">
								@if ($errors->has('grupo'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('grupo') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="subGrupo" class="control-label col-sm-3">SUB GRUPO</label>
							<div class="col-sm-9">
								<input id="subGrupo" type="number" class="form-control" name="subGrupo" value="{{$empresa->subGrupo}}" min="0">
								@if ($errors->has('subGrupo'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('subGrupo') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="email" class="control-label col-sm-3">CORREO ELECTRÓNICO</label>
							<div class="col-sm-9">
								<input id="email" type="email" class="form-control" name="email" value="{{$empresa->email}}">
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
								<input id="telefono" type="text" class="form-control" name="telefono" value="{{$empresa->telefono}}">
								@if ($errors->has('telefono'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('telefono') }}</strong>
									</span>
								@endif
							</div>	
						 </div>
						  <div class="form-group row">
							<label for="nomContacto" class="control-label col-sm-3">NOMBRE DE CONTACTO</label>
							<div class="col-sm-9">
								<input id="nomContacto" type="text" class="form-control" name="nomContacto" value="{{$empresa->nomContacto}}">
								@if ($errors->has('nomContacto'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('nomContacto') }}</strong>
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
			
			<div class="panel-footer"><a href="{{ route('empresa.index') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado empresas</a></div>
		</div>
	</div>
	
</div>
			
@endsection
