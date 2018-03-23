<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->
@extends('cms.layouts.layout_cms')

@section('titulo-seccion', 'Agregar Contenedor')

@section('active', 'active')

@section('content')
                
	<form method="POST" action="{{ route('add_contenedor') }}">
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
			<label for="texto" class="col-md-4 col-form-label text-md-right">Tipo</label>

			<div class="col-md-6">
				<select name="tipo" id="tipo">
					@foreach($tipos_contenedor as $tipo)
						<option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>  
					@endforeach
				
				</select>
			</div>			
		</div>
		
		<div class="form-group row">
			<label for="orden_menu" class="col-md-4 col-form-label text-md-right">Orden en Menú</label>

			<div class="col-md-6">
				<input id="orden_menu" type="text" class="form-control{{ $errors->has('orden_menu') ? ' is-invalid' : '' }}" name="orden_menu" value="{{ old('orden_menu') }}" required autofocus>

				@if ($errors->has('orden_menu'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('orden_menu') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="id_padre" class="col-md-4 col-form-label text-md-right">ID Padre</label>

			<div class="col-md-6">
				<input id="id_padre" type="text" class="form-control{{ $errors->has('id_padre') ? ' is-invalid' : '' }}" name="id_padre" value="{{ old('id_padre') }}" required autofocus>

				@if ($errors->has('id_padre'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('id_padre') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		
		<div class="form-group row mb-0">
			<div class="col-md-6 offset-md-4">
				<button type="submit" class="btn btn-primary">
					Guardar
				</button>
			</div>
		</div>
	</form>				
@endsection

