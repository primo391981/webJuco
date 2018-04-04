	@csrf
	
	<div class="form-group row">
		<label for="titulo" class="col-md-4 col-form-label text-md-right">Titulo</label>
			<div class="col-md-6">
			<input id="titulo" type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" value="{{ isset($contenedor) ? $contenedor->titulo : old('titulo') }}" required autofocus>

			@if ($errors->has('titulo'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('titulo') }}</strong>
				</span>
			@endif
		</div>
	</div>
	
	<div class="form-group row">
		<label for="texto" class="col-md-4 col-form-label text-md-right">Tipo</label>
		<div class="col-md-6">
			<select name="tipo" id="tipo">
				@foreach($tipos_contenedor as $key => $tipo)
					<option value="{{ $tipo->id }}" {{ old('tipo', isset($contenedor) ? $contenedor->tipo : '' ) == $key + 1 ? 'selected' : '' }}>{{ $tipo->nombre }}</option>  
				@endforeach
			</select>
		</div>			
	</div>
	
	<div class="form-group row">
		<label for="orden_menu" class="col-md-4 col-form-label text-md-right">Orden en Menú</label>
		<div class="col-md-6">
			<input id="orden_menu" type="text" class="form-control{{ $errors->has('orden_menu') ? ' is-invalid' : '' }}" name="orden_menu" value="{{ isset($contenedor) ? $contenedor->orden_menu : old('orden_menu') }}" required autofocus>

			@if ($errors->has('orden_menu'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('orden_menu') }}</strong>
				</span>
			@endif
		</div>
	</div>
		
	<div class="form-group row">
		<label for="id_itemmenu" class="col-md-4 col-form-label text-md-right">ID Padre</label>
		<div class="col-md-6">
			<input id="id_itemmenu" type="text" class="form-control{{ $errors->has('id_itemmenu') ? ' is-invalid' : '' }}" name="id_itemmenu" value="{{ isset($contenedor) ? $contenedor->id_itemmenu : old('id_itemmenu') }}" required autofocus>

			@if ($errors->has('id_itemmenu'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('id_itemmenu') }}</strong>
				</span>
			@endif
		</div>
	</div>
	
	<div class="form-group row">
		<label for="color" class="col-md-4 col-form-label text-md-right">Color de fondo</label>
		<div class="col-md-6">
			<select name="color" id="color">
				<option value="1" {{ old('color',  isset($contenedor) ? $contenedor->color : '') == 1 ? 'selected' : '' }}>blanco</option>
				<option value="2" {{ old('color',  isset($contenedor) ? $contenedor->color : '') == 2 ? 'selected' : '' }}>gris</option>
			</select>
		</div>			
	</div>
	
	<div class="form-group row">
		<label for="ancho_pantalla" class="col-md-4 col-form-label text-md-right">Ancho de pantalla</label>
		<div class="col-md-6">
		  <input type="checkbox" aria-label="Ancho de pantalla completo" id="ancho_pantalla"  name="ancho_pantalla" {{ old('ancho_pantalla',  isset($contenedor) ? $contenedor->ancho_pantalla : '') == 2 ? 'checked' : '' }}>
		  <label for="ancho_pantalla" class="col-md-1 col-form-label text-md-right">Completo</label>
		</div>
	</div>
	
	<div class="form-group row">
		<label for="img_fondo" class="col-md-4 col-form-label text-md-right">Imagen de fondo</label>
		<div class="col-md-6">
		  <input type="checkbox" aria-label="Ancho de pantalla completo" id="img_fondo"  name="img_fondo" {{ old('img_fondo',  isset($contenedor) ? $contenedor->img_fondo : '') == 1 ? 'checked' : '' }}>
		  <label for="img_fondo" class="col-md-3 col-form-label text-md-right">Imagen de fondo</label>
		</div>
	</div>
	
		
	<div class="form-group row mb-0">
		<div class="col-md-6 offset-md-4">
			<button type="submit" class="btn btn-primary">
				{{ $textoBoton }}
			</button>
		</div>
	</div>

