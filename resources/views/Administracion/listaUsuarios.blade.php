
<!-- La plantilla utilizada por esta vista esta en administracion/layouts/ y se llama layouts_administracion.blade.php -->
@extends('administracion.layouts.layout_administracion')

@section('titulo-seccion', $subtitulo)

@section('active', 'active')
                
@section('content')

	@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
	@endif 
	<div class="row">
		<div class="col-sm-12 pull-right">
			<table class="table">
				<tr>
					<td>
						<a href="{{ route('user.create') }}">Agregar</a>
					</td>
					<td>
					@if ($estado == "eliminados")
						<a class="nav-link" href="{{ route('user.list') }}">Usuarios Activos</a>
					@else
						<a class="nav-link" href="{{ route('user.list', ['estado' => 'eliminados']) }}">Usuarios Eliminados</a>
					@endif
					</td>
				</tr>
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
			@if ($usuarios->count() == 0)
				<tr> <td colspan="7"> <div class="alert alert-info">No hay usuarios para mostrar</div> </td> </tr>				
			@else	
			@foreach($usuarios as $usuario)
				@if ($usuario->trashed())
					<tr class="table-active">
				@else
					<tr>
				@endif
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
						<td>
							@if (!$usuario->trashed())
								<form method="GET" action="{{ route('user.edit', ['user' => $usuario]) }}">
									<button type="submit" class="btn btn-primary btn-md btn-block">
										Modificar
									</button>
								</form>				 
							@endif
							
							@if (Auth::id() != $usuario->id)
							<form method="POST" action="{{ route('user.destroy', ['user' => $usuario]) }}"> 
								@csrf								
								<button type="submit" class="btn btn-primary btn-md btn-block">
									@if ($usuario->trashed())
										Recuperar
									@else
										Elimnar 
									@endif
								</button>
							</form>	
							@endif
						</td>
					</tr>
			@endforeach
			@endif
			</tbody>
			</table>
			
		</div>
	</div>
@endsection