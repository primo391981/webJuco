@csrf
		@if(isset($cargo))
			<input type="hidden" name="id" value="{{$cargo->id}}">
		@endif
		<div class="form-group row">
			<label for="nombre" class="control-label col-sm-3">NOMBRE </label>
			<div class="col-sm-9">
				<input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ isset($cargo) ? $cargo->nombre : old('nombre') }}" required autofocus>
				@if ($errors->has('nombre'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('nombre') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="descripcion" class="control-label col-sm-3">DESCRIPCION </label>

			<div class="col-sm-9">
				<input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ isset($cargo) ? $cargo->descripcion : old('descripcion') }}" required autofocus>

				@if ($errors->has('descripcion'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('descripcion') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="id_remuneracion" class="control-label col-sm-3">TIPO DE REMUNERACION </label>

			<div class="col-sm-9">
			<select name="id_remuneracion" class="form-control" id="id_remuneracion">
				@foreach($remuneraciones as $key => $remuneracion)
					<option value="{{ $remuneracion->id }}" {{ old('id_remuneracion', isset($cargo) ? $cargo->id_remuneracion : '' ) == $key + 1 ? 'selected' : '' }}>{{ $remuneracion->nombre }}</option>  
				@endforeach
			</select>
			</div>	
			
			
		</div>
		
		<div class="row">
			<div class="col-xs-12">
			<hr>
			<h4>Salario mínimo del cargo</h4>
			</div>
		</div>
		<div class="form-group">
				<label class="control-label col-sm-3">MONTO </label>
				<div class="col-sm-9">
				@if(isset($cargo))
					@foreach($cargo->salarios as $salario)
						@if ($loop->last)
						<input class="form-control" type="number" id="monto" name="monto" value="{{ isset($salario) ? $salario->monto : old('monto') }}" min="0" required> 
						@endif
					@endforeach			
				@else
					<input class="form-control" type="number" id="monto" name="monto" min="0" required>
				@endif
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">FECHA INICIO </label>
				<div class="col-sm-9">
				@if(isset($cargo))
					@foreach($cargo->salarios as $salario)
						@if ($loop->last)
					<input class="form-control" type="date" id="fechaInicio" name="fechaInicio" value="{{ isset($salario) ? $salario->fechaDesde : old('fechaDesde') }}" required>	
						@endif
					@endforeach
				@else
					<input class="form-control" type="date" id="fechaInicio" name="fechaInicio" required>	
				@endif
				</div>
			</div>
		
		

		