@csrf
	@if(isset($cargo))
			<input type="hidden" name="id" value="{{$pago->id}}">
	@endif
	<!-- Datos del Empresa -->
	<div class="form-group row">
		<label for="nombreFantasia" class="control-label col-sm-3">NOMBRE FANTASIA *</label>
		<div class="col-sm-9">			
			@if (isset($pago))
				<input id="nombreFantasia" type="text" class="form-control" name="nombreFantasia" value="{{ $empresas[0]->nombreFantasia }}" required readonly>
			@else
			{
				<select id="nombreFantasia" class="form-control" name="nombreFantasia" onChange=""  required autofocus>
				<option value="">-- Seleccione empresa --</option>
				@foreach($empresas as $emp)
					<option value="{{$emp->nombreFantasia}}">{{$emp->nombreFantasia}}</option>
				@endforeach
				</select>
			}
			@endif	
		</div>	
	</div>
	<div class="form-group row">
		<label for="rut" class="control-label col-sm-3">RUT</label>
		<div class="col-sm-9">
			<input id="rut" type="text" class="form-control" name="rut" value="{{ isset($pago) ? $empresas[0]->rut : old('rut') }}" required readonly>
		</div>	
	</div>
	<div class="form-group row">
		<label for="razonSocial" class="control-label col-sm-3">RAZÓN SOCIAL</label>
		<div class="col-sm-9">
			<input id="razonSocial" type="text" class="form-control" name="razonSocial" value="{{ isset($pago) ? $empresas[0]->razonSocial : old('razonSocial') }}" disabled>
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
	<input id="tipoPago" type="hidden" class="form-control" name="tipoPago" value="1">
	<div class="form-group row">
		<label for="fecha" class="control-label col-sm-3">FECHA</label>
		<div class="col-sm-6">
			<input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}" required >
		</div>	
	</div>
	<div class="form-group row">
		<label for="monto" class="control-label col-sm-3">MONTO </label>
		<div class="col-sm-6">
			<input type="number" name="monto" id="monto" class="form-control" value="{{ old('monto') }}" min="1" required>
		</div>	
	</div>
	<div class="form-group row">
		<label for="descripcion" class="control-label col-sm-3">DESCRIPCIÓN</label>

		<div class="col-sm-9">
			<input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ isset($param) ? $param->descripcion : old('descripcion') }}" autofocus>

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