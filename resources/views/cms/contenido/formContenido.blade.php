@csrf

		<div class="form-group row">
			<label for="titulo" class="control-label col-sm-3">Titulo:</label>
			<div class="col-sm-9">
				<input id="titulo" type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" value="{{ isset($contenido) ? $contenido->titulo : old('titulo') }}" required autofocus>
				@if ($errors->has('titulo'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('titulo') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="subtitulo" class="control-label col-sm-3">Subtitulo:</label>

			<div class="col-sm-9">
				<input id="subtitulo" type="text" class="form-control{{ $errors->has('subtitulo') ? ' is-invalid' : '' }}" name="subtitulo" value="{{ isset($contenido) ? $contenido->subtitulo : old('subtitulo') }}" required autofocus>

				@if ($errors->has('subtitulo'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('subtitulo') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group row">
			<label for="texto" class="control-label col-sm-3">Texto:</label>
			<div class="col-sm-9">
							
				<textarea id="summernote" class="form-control" rows="10" name="texto">{!! isset($contenido)? $contenido->texto : old('texto') !!}</textarea>
				
				@if ($errors->has('texto'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('texto') }}</strong>
					</span>
				@endif
			</div>
		</div>

		 <div class="form-group row">
			<label for="archivo" class="control-label col-sm-3">Archivo:</label>

			<div class="col-sm-9">
				<a href="{{ isset($contenido) ? asset($contenido->archivo) : old('archivo') }}">{{ isset($contenido) ? $contenido->nombre_archivo : ""}}</a>
				
				<input id="archivo" type="file" class="form-control{{ $errors->has('archivo') ? ' is-invalid' : '' }}" name="archivo" value="{{ isset($contenido) ? $contenido->archivo : old('archivo') }}">
				
				@if ($errors->has('archivo'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('archivo') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="nombre_archivo" class="control-label col-sm-3">Nombre de archivo:</label>

			<div class="col-sm-9">
				<input id="nombre_archivo" type="text" class="form-control{{ $errors->has('nombre_archivo') ? ' is-invalid' : '' }}" name="nombre_archivo" value="{{ isset($contenido) ? $contenido->nombre_archivo : old('nombre_archivo') }}">

				@if ($errors->has('nombre_archivo'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('nombre_archivo') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="imagen" class="control-label col-sm-3">Imagen:</label>
			
			<div class="col-sm-9">
				<img src="{{ isset($contenido) ? asset($contenido->imagen) : ""}}" height="50px">
				<input id="imagen" type="file" class="form-control{{ $errors->has('imagen') ? ' is-invalid' : '' }}" name="imagen" value="{{ isset($contenido) ? $contenido->imagen : old('imagen') }}">
				
				@if ($errors->has('imagen'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('imagen') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="alt_imagen" class="control-label col-sm-3">Texto alternativo:</label>

			<div class="col-sm-9">
				<input id="alt_imagen" type="text" class="form-control{{ $errors->has('alt_imagen') ? ' is-invalid' : '' }}" name="alt_imagen" value="{{ isset($contenido) ? $contenido->alt_imagen : old('alt_imagen') }}">

				@if ($errors->has('alt_imagen'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('alt_imagen') }}</strong>
					</span>
				@endif
			</div>
		</div>
		<div class="form-group row">
			<br>
			<div class="col-xs-12 text-center">
				<button type="submit" class="btn btn-info btn-block"><i class="fas fa-check"></i>&nbsp&nbsp{{ $textoBoton }}</button>
			</div>
		</div>
