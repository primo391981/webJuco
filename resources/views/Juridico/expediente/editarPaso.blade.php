@extends('juridico.juridico')

@section('seccion', " - Editar")

@section('content')
<br>

@if (Session::has('error'))
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div>
@endif 

@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('message')}}
		</div>
@endif 

<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-9"><h4>Detalle de expediente</h4></div>
					<div class="col-sm-3 hidden-xs">
						<a href="{{ route('expediente.create') }}" class="btn btn-success pull-right" role="button"><i class="fas fa-plus"></i> nuevo expediente</a>
					</div>				  
				</div>
			</div>
			<div class="panel-body">
				@include('juridico.expediente.detalleExpediente')
				<br>
				<div class="panel panel-default">
					<div class="panel-body">
						<h4>Editar paso: {{$paso->tipo->nombre}}</h4>
							@if(count($paso->archivos) > 0)
								<div class="form-horizontal">
								
									<label for="archivos" class="control-label col-sm-3">ARCHIVOS REGISTRADOS</label>
									<div class="col-sm-9">
										@foreach($paso->archivos as $archivo)
												<a href="{{route('paso.download',$archivo)}}">{{$archivo->nombre_archivo}}</a>
												<form method="POST" action="{{route('archivo.destroy',$archivo)}}" style="display: inline;">
													{{ method_field('DELETE') }}
													@csrf
													<button type="submit" class="btn btn-link"><i class="fas fa-times-circle"></i></button>
												</form><br>
										@endforeach
									</div>
								
								</div>
							@endif
										
									
									
						<form method="POST" action="{{ route('paso.update',$paso) }}" class="form-horizontal" enctype="multipart/form-data" id="formPaso"> 
							{{ method_field('PUT') }}
							<input type="hidden" name="paso" value="{{ $paso }}">
							@include('juridico.expediente.formPaso', ['textoBoton' => 'Confirmar', 'expediente' => $expediente->id, 'tipoPaso' => $paso->tipo->id]) 
						</form>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<a href="{{ route('expediente.index') }}" class="btn btn-success btn-block" role="button"><i class="fas fa-list-ul"></i> Listado expedientes</a>
			</div>
		</div>
	</div>
</div>
    
@endsection

