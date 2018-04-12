@extends('layouts.layout_intranet')

@section('navbar')
<a class="navbar-brand" href="#"><strong>ADMIN USUARIOS</strong></a>
@endsection
@section('menu-lateral')
<li><a href="{{ route('user.list') }}"><i class="fas fa-list-ul"></i> Listado</a></li>
@endsection

                
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
			@if ($usuario->id == Auth::id() )
				<div class="col-md-6">
					<label for="rol_usuario" class="col-md-4 col-form-label text-md-center">superadmin</label>
				</div>
			@else
			<div class="col-md-2">
				<div class="list-group" id="listaRoles">
				<select multiple name="roles[]"> 
				@foreach ($roles as $role)
					@if ( $role->id != 1 )
						<option value="{{ $role->id }}">{{ $role->nombre }}</option>
					@endif
					
					{{--<a href="#" class="list-group-item">admincontable <input type="checkbox" class="pull-right"></a>--}}
				@endforeach
				</select>
				</div>
			</div>
								
			<div class="col-md-2">
				<div class="list-group" id="rolesAsignados">
				<select multiple name="roles_user[]">
				@foreach ($usuario->roles as $rol_user)					
					<option  class="pull-right" value="{{ $rol_user->id }}">{{ $rol_user->nombre }}</option>
					
					{{--<a href="#" class="list-group-item">admincms <input type="checkbox" class="pull-right"></a>--}}
				@endforeach	
				</select>
				</div>
			</div>
			@endif
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