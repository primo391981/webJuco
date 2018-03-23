
<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->
@extends('cms.layouts.layout_cms')

@section('titulo-seccion', 'Agregar Contenido')

@section('active', 'active')

@section('content')
                
	<form method="POST" action="{{ route('add_contenido') }}">
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
			<label for="filepath" class="col-md-4 col-form-label text-md-right">Archivo</label>

			<div class="col-md-6">
				<input id="filepath" type="file" class="form-control{{ $errors->has('filepath') ? ' is-invalid' : '' }}" name="filepath" value="{{ old('filepath') }}">

				@if ($errors->has('filepath'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('filepath') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="imagen" class="col-md-4 col-form-label text-md-right">Imagen</label>

			<div class="col-md-6">
				<input id="filepath" type="file" class="form-control{{ $errors->has('imagen') ? ' is-invalid' : '' }}" name="imagen" value="{{ old('imagen') }}">

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
		
		<!-- <div class="form-group row">
			<label for="tipo" class="col-md-4 col-form-label text-md-right">Tipo</label>

			<div class="col-md-6">
				<select name="tipo" id="tipo">
				{{-- @foreach($tipos as $key => $tipo)
						<option value="{{ $key }}">{{ $tipo }}</option>  
					@endforeach
				--}}
				</select>
			</div>
		</div>
		-->
		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<button type="submit" class="btn btn-primary">
					Guardar
				</button>
			</div>
		</div>
	</form>
				
@endsection

