@extends('juridico.juridico')

@section('seccion', " - PASO DE EXPEDIENTE")

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('cliente.create') }}" class="btn btn-success" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Nuevo expediente</a></div>				  
</div>
@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif 
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-12">
					<a class="btn btn-warning pull-right" href="{{route('expediente.show',$expediente)}}" role="button"><i class="fas fa-undo-alt"></i></a>
					<h4><i class="fas fa-book"></i> DETALLE DE EXPEDIENTE</h4>	
					</div>
				</div>
			</div>
			<div class="panel-body">
				@include('juridico.expediente.detalleExpediente')
				<br>
				<hr>
				<div class="col-xs-12">
						<h4>Paso: {{$paso->tipo->nombre}}</h4>
							<div class="row">
							<label for="comentarios" class="control-label col-sm-3">FECHA DE INGRESO</label>
								<div class="col-sm-9">
									{{$paso->created_at}}
								</div>
							</div>
							<div class="row">
							<label for="comentarios" class="control-label col-sm-3">COMENTARIOS</label>
								<div class="col-sm-9">
									{!!$paso->comentario!!}
								</div>
							</div>
							<div class="row">
							<label for="archivos" class="control-label col-sm-3">ARCHIVOS</label>
							<div class="col-sm-9">
							@foreach($paso->archivos as $archivo)
								
								<a href="{{route('paso.download',$archivo)}}">{{$archivo->nombre_archivo}}</a><br>
							
							@endforeach
							</div>
							</div>
							<div class="row">
							<label for="comentarios" class="control-label col-sm-3">PASO REGISTRADO POR</label>
								<div class="col-sm-9">
									{{$expediente->usuario->name}} ({{$expediente->usuario->nombre}} {{$expediente->usuario->apellido}})
								</div>
							</div>
						
				</div>
				<div class="row">
				
					<div class="col-sm-9">
						@if(Auth::user()->hasRole('juridicoAdmin') || Auth::user()->permisosEscritura->contains($expediente))
							@if($paso->fecha_fin == null && $paso->tipo->id != 1)
								<a class="btn btn-success btn-xs" href="{{route('paso.edit',$paso)}}">Editar paso <i class="fas fa-edit"></i></a>
							@endif
						@endif
						<a type="button" class="btn btn-warning btn-xs" href="{{route('expediente.show',$paso->expediente)}}">volver <i class="fas fa-undo-alt"></i></a>
					</div>
				
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#tableExp').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: '<"top"f>t<"bottom"Bpi><"clear">',
        buttons: [
           { extend: 'print', text: 'IMPRIMIR' },
		   { extend: 'pdf', text: 'PDF' },		   
		   { extend: 'excel', text: 'EXCEL' },
		   { extend: 'copy', text: 'COPIAR TABLA' }
        ]
    } );
	
	
} );
</script>
@endsection