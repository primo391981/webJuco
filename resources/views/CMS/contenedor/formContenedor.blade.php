@csrf
<div class="form-group">
    		<label for="titulo" class="control-label col-sm-3">Titulo:</label>
			<div class="col-sm-9">
			<input id="titulo" type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" value="{{ isset($contenedor) ? $contenedor->titulo : old('titulo') }}" required autofocus>
			@if ($errors->has('titulo'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('titulo') }}</strong>
				</span>
			@endif
			</div>	
 </div>
 <div class="form-group row">
		<label for="texto" class="control-label col-sm-3">Tipo:</label>
		<div class="col-sm-9">
			<select name="tipo" class="form-control" id="tipo">
				@foreach($tipos_contenedor as $key => $tipo)
					<option value="{{ $tipo->id }}" {{ old('tipo', isset($contenedor) ? $contenedor->tipo : '' ) == $key + 1 ? 'selected' : '' }}>{{ $tipo->nombre }}</option>  
				@endforeach
			</select>
		</div>			
</div>

<div class="form-group row">
		<label for="id_itemmenu" class="control-label col-sm-3">Item de Menú:</label>
		<div class="col-sm-9">
			<select name="id_itemmenu" class="form-control" id="id_itemmenu">
				<option value="0">ninguno</option>
				@foreach($menuitems as $key => $menuitem)
					<option value="{{ $menuitem->id }}" {{ old('id_itemmenu', isset($contenedor) ? $contenedor->id_itemmenu : '' ) == $key + 1 ? 'selected' : '' }}>{{ $menuitem->titulo }}</option>  
				@endforeach
			</select>
		</div>		
		
</div>
<div class="form-group row">
		<label for="color" class="control-label col-sm-3">Color de fondo:</label>
		<div class="col-sm-9">
			<select name="color" id="color" class="form-control">
				<option value="1" {{ old('color',  isset($contenedor) ? $contenedor->color : '') == 1 ? 'selected' : '' }}>blanco</option>
				<option value="2" {{ old('color',  isset($contenedor) ? $contenedor->color : '') == 2 ? 'selected' : '' }}>gris</option>
			</select>
		</div>			
</div>
<div class="form-group row">
		<label for="ancho_pantalla" class="control-label col-sm-3">Ancho de pantalla:</label>
		<div class="col-sm-9 checkbox">
			<label>
				<input type="checkbox" aria-label="Ancho de pantalla completo" id="ancho_pantalla"  name="ancho_pantalla" {{ old('ancho_pantalla',  isset($contenedor) ? $contenedor->ancho_pantalla : '') == 2 ? 'checked' : '' }}>
				Completo
			</label>
			<!--<br>
			<label>
				<input type="checkbox" aria-label="Ancho de pantalla completo" id="ancho_pantalla"  name="ancho_pantalla" {{ old('ancho_pantalla',  isset($contenedor) ? $contenedor->ancho_pantalla : '') == 2 ? 'checked' : '' }}>
				Completo
			</label>col-sm-9 col-sm-offset-3-->
		</div>
</div>
<div class="form-group row">
		<label for="img_fondo" class="control-label col-sm-3">Imagen de fondo</label>
		<div class="col-sm-9 checkbox">
		 <label> 
		  <input type="checkbox" aria-label="Ancho de pantalla completo" id="img_fondo"  name="img_fondo" {{ old('img_fondo',  isset($contenedor) ? $contenedor->img_fondo : '') == 1 ? 'checked' : '' }}>
		  Imagen de fondo
		</label>
		</div>
</div>
<div class="form-group row">
		<br>
		<div class="col-xs-12 text-center">
			<button type="submit" class="btn btn-info btn-lg"><i class="fas fa-check"></i>&nbsp&nbsp{{ $textoBoton }}</button>
		</div>
</div>
	