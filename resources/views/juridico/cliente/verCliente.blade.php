@extends('juridico.juridico')

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('cliente.create') }}" class="btn btn-success" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i></a></div>				  
</div>
@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif 
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-success">
			
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{route('cliente.index')}}" role="button"><i class="fas fa-list-ul"></i></a>
				<h4>
					@if($cliente->persona_type == 'App\Empresa')
						<i class="far fa-building"></i>
					@else
						<i class="fas fa-user"></i>
					@endif
					DETALLE DE CLIENTE
				</h4>				
			</div>
			
			<div class="panel-body">
				<div class="col-md-6">
					@include('juridico.cliente.detalleCliente')
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-xs-12">
							@if(Auth::user()->hasRole('juridicoAdmin'))
								<button class="btn btn-warning pull-right" data-toggle="modal" data-target="#modalArchivos"> <i class="fas fa-plus"></i></button>
							@endif
							<h3>ARCHIVOS</h3>
							<hr class="hidden-xs hidden-sm">
						</div>
					</div>
				
					@if($cliente->archivos->count()>0)
						@foreach($cliente->archivos as $archivo)
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
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Archivos -->
<div class="modal fade" id="modalArchivos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-success" style="background:#dff0d8;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Archivos de Cliente</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="col-md-12 example-title">
						<h3>Nuevo Archivo</h3>	
					</div>
					<div>
						<form method="POST" action="{{ route('archivo.store') }}" class="form-horizontal" enctype="multipart/form-data">
						  @csrf
						  <input type="hidden" name="owner_id" value="{{ $cliente->id }}">
						  <input type="hidden" name="owner_type" value="App\Juridico\Cliente">
						  <div class="form-group">
							<label for="user" class="col-sm-4 control-label">Archivos</label>
							<div class="col-sm-8">
								<input id="documentos" type="file" class="form-control{{ $errors->has('documentos') ? ' is-invalid' : '' }}" name="documentos[]" autofocus multiple>

									@if ($errors->has('documentos'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('documentos') }}</strong>
										</span>
									@endif
							</div>
						  </div>
						  
						  <div class="form-group">
							<div class="col-sm-12 text-center">
							  <button type="submit" class="btn btn-primary">guardar</button>
							</div>
						  </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- FIN Modal Permisos de usuario -->

@endsection