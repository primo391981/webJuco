@extends('layouts.layout_intranet')

@section('navbar')
<a class="navbar-brand" href="#"><strong>ADMIN USUARIOS</strong></a>
@endsection
@section('menu-lateral')
<li><a href="{{ route('user.list') }}"><i class="fas fa-list-ul"></i> Listado</a></li>
<li><a href="{{ route('user.create') }}"><i class="fas fa-user-plus"></i> Agregar nuevo</a></li>
@endsection

@section('content')
<br>
	@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
	@endif 
	
	<div class="row">
		<div class="col-xs-12 visible-xs visible-sm visible-md">
			<a href="{{ route('user.create') }}" class="btn btn-info" role="button" style="margin-bottom:2%;"><i class="fas fa-user-plus"></i> Agregar nuevo</a>			
			@if ($estado == "eliminados")
				<a href="{{ route('user.list') }}" class="btn btn-info" role="button" style="margin-bottom:2%;"><i class="fas fa-users"></i> Usuarios activos</a>
			@else
				<a href="{{ route('user.list', ['estado' => 'eliminados']) }}" class="btn btn-info" role="button" style="margin-bottom:2%;"><i class="fas fa-user-times"></i> Usuarios eliminados</a>
			@endif				
		</div>
	</div>
	
	
	<!--<div class="row">
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
	</div>-->
<div class="row">
<div class="col-xs-12">
	@if ($usuarios->count() == 0)
		<div class="alert alert-warning">No hay usuarios para mostrar</div>
	@else
		
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-8"><h4>Listado de usuarios</h4></div>
						<div class="col-lg-2 hidden-xs hidden-sm hidden-md"><a href="{{ route('user.create') }}" class="btn btn-info pull-right" role="button"><i class="fas fa-user-plus"></i> Agregar nuevo</a></div>
						@if ($estado == "eliminados")
							<div class="col-lg-2 hidden-xs hidden-sm hidden-md"><a href="{{ route('user.list') }}" class="btn btn-info" role="button"><i class="fas fa-users"></i> Activos</a></div>
						@else
							<!--control de que si no existen usuarios eliminados tendria que estar bloqueado-->
							<div class="col-lg-2 hidden-xs hidden-sm hidden-md"><a href="{{ route('user.list', ['estado' => 'eliminados']) }}" class="btn btn-info" role="button"><i class="fas fa-user-times"></i> Eliminados</a></div>
						@endif
						</div>	
				</div>
				<div class="panel-body text-info">
					<div class="col-xs-12 table-responsive">
						<table class="table">
							<thead>				
								<tr>
									<th>ID</th>
									<th>Usuario</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Correo</th>
									<th>Rol</th>					
									<th>Acciones</th>
								</tr>				
							</thead>
							<tbody>
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
														<span class="label label-info">{{ $role }}</span>
													@else
														<span class="label label-info"> <br> {{ $role }}</span>						
													@endif					
												@endforeach
											</td>
											<td>
												@if (!$usuario->trashed())
													<form method="GET" action="{{ route('user.edit', ['user' => $usuario]) }}">
													<button type="submit" class="btn btn-link"><i class="far fa-edit"></i></button>
													</form>			 
												@endif
												@if (Auth::id() != $usuario->id)
													@if ($usuario->trashed())
														<form method="POST" action="{{ route('user.restore', ['user_id' => $usuario->id]) }}">
														@csrf	
														<button type="submit" class="btn btn-link"><i class="fas fa-recycle"></i>
													@else
														<form method="POST" action="{{ route('user.destroy', ['user' => $usuario]) }}">
														{{ method_field('DELETE') }}
														@csrf								
														<button type="submit" class="btn btn-link"><i class="far fa-trash-alt"></i> 
													@endif
														</button>
														</form>	
												@endif
											</td>
										</tr>
								@endforeach						
							</tbody>
						</table>			
					</div>
					<!--cierre table responsive-->
				</div>
				<div class="panel-footer"><a href="{{ route('contenido.index') }}" class="btn btn-info btn-block" role="button"><i class="fas fa-list-ul"></i> Listado contenidos</a></div>
			</div>
	@endif
</div>
</div>	
@endsection