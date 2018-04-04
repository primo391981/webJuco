@csrf

		<div class="form-group row">
			<label for="titulo" class="col-md-4 col-form-label text-md-right">Titulo</label>

			<div class="col-md-6">
				<input id="titulo" type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" value="{{ old('titulo') }}" required autofocus>

				@if ($errors->has('titulo'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('titulo') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="subtitulo" class="col-md-4 col-form-label text-md-right">Subtitulo</label>

			<div class="col-md-6">
				<input id="subtitulo" type="text" class="form-control{{ $errors->has('subtitulo') ? ' is-invalid' : '' }}" name="subtitulo" value="{{ old('subtitulo') }}" required autofocus>

				@if ($errors->has('subtitulo'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('subtitulo') }}</strong>
					</span>
				@endif
			</div>
		</div>

		<div class="form-group row">
			<label for="texto" class="col-md-4 col-form-label text-md-right">Texto</label>

			<div class="col-md-6">
				<input id="texto" type="text" class="form-control{{ $errors->has('texto') ? ' is-invalid' : '' }}" name="texto" value="{{ old('texto') }}" required>

				@if ($errors->has('texto'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('texto') }}</strong>
					</span>
				@endif
			</div>
		</div>

		 <div class="form-group row">
			<label for="archivo" class="col-md-4 col-form-label text-md-right">Archivo</label>

			<div class="col-md-6">
				<input id="archivo" type="file" class="form-control{{ $errors->has('archivo') ? ' is-invalid' : '' }}" name="archivo" value="{{ old('archivo') }}">

				@if ($errors->has('archivo'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('archivo') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="nombre_archivo" class="col-md-4 col-form-label text-md-right">Nombre de archivo</label>

			<div class="col-md-6">
				<input id="nombre_archivo" type="text" class="form-control{{ $errors->has('nombre_archivo') ? ' is-invalid' : '' }}" name="nombre_archivo" value="{{ old('nombre_archivo') }}">

				@if ($errors->has('nombre_archivo'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('nombre_archivo') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="imagen" class="col-md-4 col-form-label text-md-right">Imagen</label>

			<div class="col-md-6">
				<input id="imagen" type="file" class="form-control{{ $errors->has('imagen') ? ' is-invalid' : '' }}" name="imagen" value="{{ old('imagen') }}">

				@if ($errors->has('imagen'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('imagen') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="alt_imagen" class="col-md-4 col-form-label text-md-right">Texto alternativo</label>

			<div class="col-md-6">
				<input id="alt_imagen" type="text" class="form-control{{ $errors->has('alt_imagen') ? ' is-invalid' : '' }}" name="alt_imagen" value="{{ old('alt_imagen') }}">

				@if ($errors->has('alt_imagen'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('alt_imagen') }}</strong>
					</span>
				@endif
			</div>
		</div>


		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<button type="submit" class="btn btn-primary">
				{{ $textoBoton }}
				</button>
			</div>
		</div>