
<!-- La plantilla utilizada por esta vista esta en administracion/layouts/ y se llama layouts_administracion.blade.php -->
@extends('administracion.layouts.layout_administracion')

@section('titulo-seccion', 'Modificar Usuario')

@section('active', 'active')
                
@section('content')
	
	<form method="POST" action="{{ route('edit_usuario', ['id' => $usuario->id]) }}">
		@csrf
		<!-- ID y nombre de usaurio no se modifican -->
		<div class="form-group row">
			<label for="id" class="col-md-4 col-form-label text-md-right">ID:</label>

			<div class="col-md-6">
				<label for="id_usuario" class="col-md-4 col-form-label text-md-center">{{$usuario->id}}</label>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="id" class="col-md-4 col-form-label text-md-right">Usuario:</label>

			<div class="col-md-6">
				<label for="id_usuario" class="col-md-4 col-form-label text-md-center">{{$usuario->name}}</label>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre:</label>

			<div class="col-md-6">
				<input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{old('name', $usuario->nombre)}}" required autofocus>

				@if ($errors->has('nombre'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('nombre') }}</strong>
					</span>
				@endif
			</div>
		</div>
	
		<div class="form-group row">
			<label for="apellido" class="col-md-4 col-form-label text-md-right">Apellido:</label>

			<div class="col-md-6">
				<input id="apellido" type="text" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{$usuario->apellido}}" required autofocus>

				@if ($errors->has('apellido'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('apellido') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="email" class="col-md-4 col-form-label text-md-right">Correo Electrónico:</label>

			<div class="col-md-6">
				<input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$usuario->email}}" required autofocus>

				@if ($errors->has('email'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="roles" class="col-md-4 col-form-label text-md-right">Rol de usuario</label>
			
			<div class="col-md-2">
				<div class="list-group" id="list1">
					<a href="#" class="list-group-item active">Roles <input title="toggle all" type="checkbox" class="all pull-right"></a>
					<a href="#" class="list-group-item">admin <input type="checkbox" class="pull-right"></a>
					<a href="#" class="list-group-item">adminjuridico <input type="checkbox" class="pull-right"></a>
					<a href="#" class="list-group-item">admincontable <input type="checkbox" class="pull-right"></a>
				</div>
			</div>
			
			<div class="col-md-2 v-center">
				<button title="Send to list 2" class="btn btn-default center-block add"><i class="glyphicon glyphicon-chevron-right"></i></button>
				<button title="Send to list 1" class="btn btn-default center-block remove"><i class="glyphicon glyphicon-chevron-left"></i></button>
			</div>
			
			<div class="col-md-2">
				<div class="list-group" id="list2">
					<a href="#" class="list-group-item active">Roles Asignados <input title="toggle all" type="checkbox" class="all pull-right"></a>
					<a href="#" class="list-group-item">admincms <input type="checkbox" class="pull-right"></a>
					
					
					
				</div>
			</div>
		</div>
		
		<div class="form-group row mb-0">
            <div class="col-md-4 offset-md-2">
				<button type="submit" class="btn btn-primary btn-md btn-block">
					Modificar
				</button>
			</div>
			<div class="col-md-4 offset-md-2">
				<a class="btn btn-primary btn-md btn-block" href="{{ route('usuarios') }}">Cancelar</a>
			</div>
		</div>
		
	</form>		
@endsection