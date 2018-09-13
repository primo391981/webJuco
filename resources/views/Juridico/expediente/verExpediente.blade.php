@extends('juridico.juridico')

@section('content')
@if (Session::has('success'))
	<br>
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif 
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{route('expediente.index')}}" role="button"><i class="fas fa-list-ul"></i></a>
				<h4><i class="fas fa-book"></i> DETALLE DE EXPEDIENTE</h4>				
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12 col-md-7">
						@include('juridico.expediente.detalleExpediente')
						<hr class="hidden-lg hidden-md">
					</div>
					<div class="col-xs-12 col-md-5">
						@include('juridico.expediente.recordatoriosExpediente')
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-12 col-md-4">
						<h4>SIGUIENTES PASOS</h4>
						<hr class="hidden-xs hidden-sm">
						@if(Auth::user()->hasRole('juridicoAdmin') || Auth::user()->permisosEscritura->contains($expediente))
							<p>Flujo Principal</p>
							@if(count($transiciones) > 0)
								@foreach($transiciones->sortBY('tipo_transicion') as $transicion)
									@if($transicion->tipo_transicion == 0)
										<p><a type="button" class="btn btn-success btn-xs" href="{{ route('paso.create',[$expediente,$transicion])}}"><i class="fas fa-angle-double-right"></i> {{$transicion->siguiente->nombre}}</a></p>
										<br>
									@else
										<p>Flujo Paralelo</p>
										<p><a type="button" class="btn btn-warning btn-xs" href="{{ route('paso.create',[$expediente,$transicion])}}"><i class="fas fa-angle-double-right"></i> {{$transicion->siguiente->nombre}}</a></p>
									@endif
								@endforeach
							@else
								<div class="alert alert-info">El expediente fue archivado.</div>
							@endif
						@else
							<div class="alert alert-danger">No cuenta con permisos para acceder a esta información.</div>
						@endif
					</div>
					<div class="col-xs-12 col-md-4">
						<div class="row">
						<div class="col-xs-12">
							@if(Auth::user()->hasRole('juridicoAdmin'))
								<button class="btn btn-info pull-right" data-toggle="modal" data-target="#modalPermisos"> <i class="fas fa-plus"></i></button>
							@endif
							<h4>USUARIOS ASIGNADOS</h4>
							<hr class="hidden-xs hidden-sm">
						</div>
						</div>
						<p><strong><u>Propietario</u>: </strong><i class="fas fa-user"></i> {{$expediente->usuario->name}} ({{$expediente->usuario->nombre}} {{$expediente->usuario->apellido}})</p>
						<p><strong><u>Escritura</u></strong></p>
						@foreach($expediente->permisosExpedientes->where('pivot.id_tipo',1) as $usuario)
							<div class="row">
								<div class="col-xs-10">
									<p>- {{$usuario->name}} ({{$usuario->nombre}} {{$usuario->apellido}})</p>
								</div>
								<div class="col-xs-2">
								@if(Auth::user()->hasRole('juridicoAdmin'))
									<form method="POST" action="{{ route('expediente.delPermiso',$expediente) }}">
										@csrf
										<input type="hidden" name="usuario" value="{{ $usuario->id }}">
										<button type="submit" class="btn btn-danger btn-xs">
											<i class="fas fa-times"></i>
										</button>
									</form>
								@endif
								</div>
							</div>
						@endforeach
						<p><strong><u>Solo lectura</u></strong></p>
						@foreach($expediente->permisosExpedientes->where('pivot.id_tipo',2) as $usuario)
							<div class="row">
								<div class="col-xs-10">
									<p>- {{$usuario->name}} ({{$usuario->nombre}} {{$usuario->apellido}})</p>
								</div>
								<div class="col-xs-2">
								@if(Auth::user()->hasRole('juridicoAdmin'))
									<form method="POST" action="{{ route('expediente.delPermiso',$expediente) }}">
										@csrf
										<input type="hidden" name="usuario" value="{{ $usuario->id }}">
										<button type="submit" class="btn btn-danger btn-xs">
											<i class="fas fa-times"></i>
										</button>
									</form>
								@endif
								</div>
							</div>
						@endforeach
					</div>
				<div class="col-xs-12 col-md-4">
					<div class="row">
						<div class="col-xs-12">
							@if(Auth::user()->hasRole('juridicoAdmin') || Auth::user()->permisosEscritura->contains($expediente))
								<button class="btn btn-warning pull-right" data-toggle="modal" data-target="#modalArchivos"> <i class="fas fa-plus"></i></button>
							@endif
							<h4>ARCHIVOS</h4>
							<hr class="hidden-xs hidden-sm">
						</div>
					</div>
							@if($expediente->archivos->count()>0)
								<p><strong><u>Expediente</u></strong></p>
								@foreach($expediente->archivos as $archivo)
									
									
									<div class="row">
										<div class="col-xs-10">
											<p><a href="{{route('paso.download',$archivo)}}">{{$archivo->nombre_archivo}}</a></p>
										</div>
										<div class="col-xs-2">
										@if(Auth::user()->hasRole('juridicoAdmin') || Auth::user()->permisosEscritura->contains($expediente))
											<form method="POST" action="{{route('archivo.destroy',$archivo)}}">
												@csrf
												@method('DELETE')
												<input type="hidden" name="archivo" value="{{ $archivo->id }}">
												<button type="submit" class="btn btn-danger btn-xs">
													<i class="fas fa-times"></i>
												</button>
											</form>
										@endif
										</div>
									</div>
								@endforeach	
							@endif
							<p><strong><u>Pasos</u></strong></p>
							@foreach($expediente->pasos as $paso)
								@if($paso->archivos->count()>0)
									
									<div class="row">
										<p>- {{ $paso->tipo->nombre}} > </p>
										@foreach($paso->archivos as $archivo)
											<div class="col-xs-12">
												<p><a href="{{route('paso.download',$archivo)}}">{{$archivo->nombre_archivo}}</a></p>
											</div>
										@endforeach	
									</div>
								@endif
							@endforeach

				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Pasos Expediente-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-success" style="background:#dff0d8;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pasos expediente</h4>
      </div>
      <div class="modal-body">
	  
		  <div class="container-fluid">
			<div class="row example-centered">
				<div class="col-md-12 example-title">
					<h2>Exp. {{$expediente->iue}}</h2>
				</div>
				<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
					<ul class="timeline timeline-centered">
						@foreach($expediente->pasos as $paso)
						<li class="timeline-item">
							<div class="timeline-info">
								<span>{{$paso->created_at}}</span>
							</div>
							<div class="timeline-marker"></div>
							<div class="timeline-content">
								<h3 class="timeline-title"><a href="{{route('paso.show',$paso->id)}}">{{$paso->tipo->nombre}}</a></h3>
								{{$paso->usuario->name}}
										({{$paso->usuario->nombre}} {{$paso->usuario->apellido}})
								
								
								<p> </p>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN Modal Pasos Expediente-->

<!-- Modal Recordatorio -->
<div class="modal fade" id="modalRecordatorios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-success" style="background:#dff0d8;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Expediente {{$expediente->iue}}</h4>
			</div>
			<div class="modal-body">
				@include('juridico.expediente.formRecordatorio')
			</div>
		</div>
	</div>
</div>

<!-- FIN Modal Recordatorio -->

<!-- Modal Permisos de usuario -->
<div class="modal fade" id="modalPermisos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-success" style="background:#dff0d8;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Permisos de Usuario</h4>
			</div>
			<div class="modal-body">
				@include('juridico.expediente.formPermiso')
			</div>

		</div>
	</div>
</div>

<!-- FIN Modal Permisos de usuario -->

<!-- Modal Archivos Expediente-->
<div class="modal fade" id="modalArchivos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-success" style="background:#dff0d8;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Archivos de Expediente</h4>
			</div>
			<div class="modal-body">
				@include('juridico.expediente.formArchivo')
			</div>

		</div>
	</div>
</div>

<!-- FIN Modal Permisos de usuario -->

@endsection