@csrf
<div class="form-group">
    		<label for="titulo" class="control-label col-sm-3">Titulo:</label>
			<div class="col-sm-9">
			<input id="titulo" type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" value="{{ isset($menuitem) ? $menuitem->titulo : old('titulo') }}" required autofocus>
			@if ($errors->has('titulo'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('titulo') }}</strong>
				</span>
			@endif
			</div>	
</div>
<div class="form-group">
    		<label for="descripcion" class="control-label col-sm-3">Descripción:</label>
			<div class="col-sm-9">
			<input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ isset($menuitem) ? $menuitem->descripcion : old('titulo') }}" required autofocus>
			@if ($errors->has('titulo'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('titulo') }}</strong>
				</span>
			@endif
			</div>	
</div>

<div class="form-group row">
		<br>
		<div class="col-xs-12 text-center">
			<button type="submit" class="btn btn-info btn-lg"><i class="fas fa-check"></i>&nbsp&nbsp{{ $textoBoton }}</button>
		</div>
</div>
	