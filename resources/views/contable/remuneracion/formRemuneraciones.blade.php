@csrf

		<div class="form-group row">
			<label for="nombre" class="control-label col-sm-3">Nombre:</label>
			<div class="col-sm-9">
				<input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ isset($remuneracion) ? $remuneracion->nombre : old('nombre') }}" required autofocus>
				@if ($errors->has('nombre'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('nombre') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="descripcion" class="control-label col-sm-3">Descripción:</label>

			<div class="col-sm-9">
				<input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ isset($remuneracion) ? $remuneracion->descripcion : old('descripcion') }}" required autofocus>

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
			<button type="submit" class="btn btn-warning btn-lg"><i class="fas fa-check"></i>&nbsp&nbsp{{ $textoBoton }}</button>
		</div>
</div>