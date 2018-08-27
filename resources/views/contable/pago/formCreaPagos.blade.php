@csrf
<!-- Datos del Empresa -->
<div class="form-group row">
	<label for="rut" class="control-label col-sm-3">NOMBRE FANTASIA *</label>
	<div class="col-sm-9">
		<select id="nombreFantasia" class="form-control" name="nombreFantasia" onChange="" required autofocus>
			<option value="">-- Seleccione empresa --</option>
		@foreach($empresas as $emp)
			<option value="{{$emp->nombreFantasia}}">{{$emp->nombreFantasia}}</option>
		@endforeach
		</select>							
	</div>	
</div>
<div class="form-group row">
	<label for="rut" class="control-label col-sm-3">RUT</label>
	<div class="col-sm-9">
		<input id="rut" type="text" class="form-control" name="rut" value="" required readonly>
	</div>	
</div>
<div class="form-group row">
	<label for="razonSocial" class="control-label col-sm-3">RAZÓN SOCIAL</label>
	<div class="col-sm-9">
		<input id="razonSocial" type="text" class="form-control" name="razonSocial" value="" disabled>
	</div>	
</div>

<!-- Datos del Empleado -->
<div class="form-group row">
	<label for="nombreEmpleado" class="control-label col-sm-3">NOMBRE EMPLEADO *</label>
	<div class="col-sm-9">
		<select id="nombreEmpleado" class="form-control" name="nombreEmpleado" onChange="" required disabled>
			<option value=""></option>
		</select>							
	</div>	
</div>
<input id="tipoDocId" type="hidden" class="form-control" name="tipoDocId" value="">
<div class="form-group row">
	<label for="tipoDoc" class="control-label col-sm-3">TIPO DOCUMENTO</label>
	<div class="col-sm-9">
		<input id="tipoDoc" type="text" class="form-control" name="tipoDoc" value="" disabled>
	</div>	
</div>
<div class="form-group row">
	<label for="numeroDoc" class="control-label col-sm-3">NÚMERO</label>
	<div class="col-sm-9">
		<input id="numeroDoc" type="text" class="form-control" name="numeroDoc" value="" required readonly>
	</div>	
</div>

<!-- Datos del Viático -->
<input id="tipoPago" type="hidden" class="form-control" name="tipoPago" value="{{ isset($tipoPago) ? $tipoPago : old('tipoPago') }}">
<div class="form-group row">
	<label for="mes" class="control-label col-sm-3">MES</label>	
	<div class="col-sm-6">
		<input type="month" class="form-control" id="mes" name="mes" value="{{ old('mes') }}" required>	
		@if ($errors->has('mes'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('mes') }}</strong>
			</span>
		@endif
	</div>	
</div>
@if ($tipoPago == 1)
	<div class="form-group row">
		<label for="cantDias" class="control-label col-sm-3">DÍAS </label>
		<div class="col-sm-6">
			<input type="number" name="cantDias" id="cantDias" class="form-control" value="{{ old('cantDias') }}" min="1" required>
		@if ($errors->has('cantDias'))
			<span class="invalid-feedback">
				<strong>{{ $errors->first('cantDias') }}</strong>
			</span>
		@endif
		</div>	
	</div>
@endif
<div class="form-group row">
	<label for="monto" class="control-label col-sm-3">MONTO </label>
	<div class="col-sm-6">
		<input type="number" name="monto" id="monto" class="form-control" value="{{ old('monto') }}" min="1" required>
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
		<input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ old('descripcion') }}" autofocus>
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