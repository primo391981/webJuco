@csrf

		<div class="form-group row">
			<label for="nombre" class="control-label col-sm-3">NOMBRE</label>
			<div class="col-sm-9">
				<input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ isset($param) ? $param->nombre : old('nombre') }}" required autofocus>
				@if ($errors->has('nombre'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('nombre') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="descripcion" class="control-label col-sm-3">DESCRIPCIÓN</label>

			<div class="col-sm-9">
				<input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ isset($param) ? $param->descripcion : old('descripcion') }}" required autofocus>

				@if ($errors->has('descripcion'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('descripcion') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="fecha_inicio" class="control-label col-sm-3">FECHA INICIO</label>

			<div class="col-sm-9">
				<input id="fecha_inicio" type="date" class="form-control{{ $errors->has('fecha_inicio') ? ' is-invalid' : '' }}" name="fecha_inicio" value="{{ isset($param) ? $param->fecha_inicio : old('fecha_inicio') }}" required autofocus>

				@if ($errors->has('fecha_inicio'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('fecha_inicio') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="fecha_fin" class="control-label col-sm-3">FECHA FIN</label>

			<div class="col-sm-9">
				<input id="fecha_fin" type="date" class="form-control{{ $errors->has('fecha_fin') ? ' is-invalid' : '' }}" name="fecha_fin" value="{{ isset($param) ? $param->fecha_fin : old('fecha_fin') }}" autofocus>

				@if ($errors->has('fecha_fin'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('fecha_fin') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="valor" class="control-label col-sm-3">VALOR</label>

			<div class="col-sm-9">
				<input id="valor" type="number" step=".001" class="form-control{{ $errors->has('valor') ? ' is-invalid' : '' }}" name="valor" value="{{ isset($param) ? $param->valor : old('valor') }}" required autofocus>

				@if ($errors->has('descripcion'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('valor') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		

		<div class="form-group row">
		<br>
		<div class="col-xs-12 text-center">
			<button type="button" class="btn btn-warning btn-lg" id="btnSubmit"><i class="fas fa-check"></i>&nbsp;&nbsp;{{ $textoBoton }}</button>
		</div>
</div>