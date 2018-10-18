@extends('administracion.useradmin')

@section('navbar')
<a class="navbar-brand" href="#"><strong>ADMIN USUARIOS</strong></a>
@endsection

@section('content')
@if (Session::has('success'))
	<br>
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif 
@if (Session::has('error'))
	<br>
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div>
@endif 
<br>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a class="btn btn-primary pull-right" href="{{ route('user.create') }}" role="button"><i class="fas fa-plus"></i></a>
					<h4><i class="fas fa-users"></i> LISTADO DE USUARIOS </h4>				
				</div>
				<div class="panel-body text-muted">
					<div class="table-responsive">
						<table class="table" id="tableUsers">
							<thead>				
								<tr>
									<th>ID</th>
									<th>Usuario</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Correo</th>
									<th>Rol</th>					
									<th></th>
									<th></th>
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
													<span class="label label-primary">{{ $role }}</span>
												@else
													<span class="label label-primary"> <br> {{ $role }}</span>						
												@endif					
											@endforeach
										</td>
										<td>
											@if(Auth::user() != $usuario)
												<a class="btn btn-warning" href="{{ route('user.edit', $usuario) }}"><i class="far fa-edit"></i></a>	
											@endif
										</td>
										<td>
											@if(Auth::user() != $usuario)
												<form method="POST" action="{{ route('user.destroy', ['user' => $usuario]) }}">
													@if($usuario->expedientes->count() > 0)
														<fieldset disabled>
													@endif
														{{ method_field('DELETE') }}
														@csrf	
														<button type="submit"class="btn btn-danger"><i class="far fa-trash-alt" disabled></i></button>
													@if($usuario->expedientes->count() > 0)
														</fieldset>
													@endif
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
			</div>
		</div>
	</div>	
	
	
<script>
$(document).ready(function() {
    $('#tableUsers').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: '<"top"f>t<"bottom"p><"clear">',
        
    } );
} );
</script>
@endsection