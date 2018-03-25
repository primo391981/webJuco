
<!-- La plantilla utilizada por esta vista esta en administracion/layouts/ y se llama layouts_administracion.blade.php -->
@extends('administracion.layouts.layout_administracion')

@section('titulo-seccion', 'Usuarios')

@section('active', 'active')
                
@section('content')
	<div class="row">
		<div class="col-sm-12 pull-right">
			<a href="">Agregar</a>
		</div>
	</div>
	<div class="row">
		<div  class="col-sm-12" style="overflow-x: auto;">
			<table class="table">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Usuario</th>
					<th scope="col">Nombre</th>
					<th scope="col">Apellido</th>
					<th scope="col">Correo</th>
					<th scope="col">Rol</th>					
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($usuarios as $usuario)
			
			<tr>
				<td>{{$usuario->id}}</td>
				<td>{{$usuario->name}}</td>
				<td>{{$usuario->nombre}}</td>
				<td>{{$usuario->apellido}}</td>
				<td>{{$usuario->email}}</td>
				<td>
					@foreach ($usuario->roles()->pluck('nombre') as $role)
						@if ($loop->first)
							<span class="label label-default">{{ $role }}</span>
						@else
							<span class="label label-default"> <br> {{ $role }}</span>						
						@endif					
                    @endforeach</td>
				<td>modificar elimnar</td>
			</tr>
			@endforeach
			</tbody>
			</table>
		</div>
	</div>
@endsection