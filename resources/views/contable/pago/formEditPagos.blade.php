@csrf
	@if(isset($cargo))
			<input type="hidden" name="id" value="{{$pago->id}}">
	@endif
	<!-- Datos del Empresa -->
	<div class="form-group row">
		<label for="nombreFantasia" class="control-label col-sm-3">NOMBRE FANTASIA</label>
		<div class="col-sm-9">			
			<input id="nombreFantasia" type="text" class="form-control" name="nombreFantasia" value="{{ isset($empresa) ? $empresa->nombreFantasia : old('nombreFantasia') }}" required readonly>
		</div>	
	</div>
	<div class="form-group row">
		<label for="rut" class="control-label col-sm-3">RUT</label>
		<div class="col-sm-9">
			<input id="rut" type="text" class="form-control" name="rut" value="{{ isset($empresa) ? $empresa->rut : old('rut') }}" required readonly>
		</div>	
	</div>
	<div class="form-group row">
		<label for="razonSocial" class="control-label col-sm-3">RAZÓN SOCIAL</label>
		<div class="col-sm-9">
			<input id="razonSocial" type="text" class="form-control" name="razonSocial" value="{{ isset($empresa) ? $empresa->razonSocial : old('razonSocial') }}" readonly>
		</div>	
	</div>

	<!-- Datos del Empleado -->
	<div class="form-group row">
		<label for="nombreEmpleado" class="control-label col-sm-3">NOMBRE EMPLEADO</label>
		<div class="col-sm-9">
			<input id="nombreEmpleado" type="text" class="form-control" name="nombreEmpleado" value="{{ isset($persona) ? $persona->nombre." ".$persona->apellido : old('nombreEmpleado') }}" required readonly>						
		</div>	
	</div>
	<input id="tipoDocId" type="hidden" class="form-control" name="tipoDocId" value="{{ isset($persona) ? $persona->tipoDocumento : old('tipoDocId') }}">
	<div class="form-group row">
		<label for="tipoDoc" class="control-label col-sm-3">TIPO DOCUMENTO</label>
		<div class="col-sm-9">
			<input id="tipoDoc" type="text" class="form-control" name="tipoDoc" value="{{ isset($persona) ? $persona->tipoDoc->nombre : old('tipoDoc') }}" disabled>
		</div>	
	</div>
	<div class="form-group row">
		<label for="numeroDoc" class="control-label col-sm-3">NÚMERO</label>
		<div class="col-sm-9">
			<input id="numeroDoc" type="text" class="form-control" name="numeroDoc" value="{{ isset($persona) ? $persona->documento : old('nombreEmpleado') }}" required readonly>
		</div>	
	</div>
	
	<!-- Datos del Viático -->
	<input id="tipoPago" type="hidden" class="form-control" name="tipoPago" value="{{ isset($pago) ? $pago->idTipoPago : old('tipoPago') }}">
	<div class="form-group row">
		<label for="fecha" class="control-label col-sm-3">FECHA</label>
		<div class="col-sm-6">
			<input type="date" name="fecha" id="fecha" class="form-control {{ $errors->has('fecha') ? ' is-invalid' : '' }}" value="{{ isset($pago) ? $pago->fecha : old('fecha') }}" required >
			@if ($errors->has('fecha'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('fecha') }}</strong>
				</span>
			@endif
		</div>	
	</div>
	<div class="form-group row">
		<label for="monto" class="control-label col-sm-3">MONTO </label>
		<div class="col-sm-6">
			<input type="number" name="monto" id="monto" class="form-control {{ $errors->has('monto') ? ' is-invalid' : '' }}" value="{{ isset($pago) ? $pago->monto : old('monto') }}" min="1" required>
			@if ($errors->has('monto'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('monto') }}</strong>
				</span>
			@endif
		</div>	
	</div>
	<div class="form-group row">
		<label for="descripcion" class="control-label col-sm-3">DESCRIPCIÓN</label>

		<div class="col-sm-9">
			<input id="descripcion" type="text" class="form-control {{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ isset($pago) ? $pago->descripcion : old('descripcion') }}" autofocus>

			@if ($errors->has('descripcion'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('descripcion') }}</strong>
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