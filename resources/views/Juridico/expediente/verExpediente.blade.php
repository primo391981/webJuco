@extends('juridico.juridico')

@section('seccion', " - EXPEDIENTE")

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
				<div class="col-md-7">
					@include('juridico.expediente.detalleExpediente')
				</div>
				<div class="col-md-5">
					@include('juridico.expediente.recordatoriosExpediente')
				</div>
				<div class="col-md-4">
					@if(count($transiciones) > 0)
					<div class="box box-success">
						<div class="box-header">
							<h4>Siguientes pasos</h4>
						</div>
						<div class="box-body">
							<div class="col-xs-12 text-center">
							@foreach($transiciones as $transicion)
								<a type="button" class="btn btn-success btn-xs" href="{{ route('paso.create',[$expediente,$transicion->siguiente])}}"><i class="fas fa-angle-double-right"></i> {{$transicion->siguiente->nombre}}</a>
							@endforeach
							</div>
						</div>
					</div>
					@endif
				</div>
				<div class="col-md-3">
					<div class="box box-success">
						<div class="box-header">
							<h4>Usuarios asignados</h4>
						</div>
						<div class="box-body">
							<div class="col-xs-12">
								<h4>Propietario</h4>
								<i class="fas fa-user"></i> {{$expediente->usuario->name}} ({{$expediente->usuario->nombre}} {{$expediente->usuario->apellido}} asdasdasdasdasd)
							</div>
							<div class="col-xs-12">
								<h4>Escritura</h4>
								@foreach($expediente->permisosExpedientes->where('pivot.id_tipo',1) as $usuario)
									<i class="fas fa-user"></i> {{$usuario->name}} ({{$usuario->nombre}} {{$usuario->apellido}})
								@endforeach
							</div>
							<div class="col-xs-12">
								<h4>Solo Lectura</h4>
								@foreach($expediente->permisosExpedientes->where('pivot.id_tipo',2) as $usuario)
									<i class="fas fa-user"></i> {{$usuario->name}} ({{$usuario->nombre}} {{$usuario->apellido}})
								@endforeach
							</div>
						</div>
						<div class="box-footer text-center">
							<button class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalPermisos"> <i class="fas fa-plus"></i> permiso</button>
						</div>
					</div>

				</div>
				<div class="col-md-5">
					<div class="box box-success">
						<div class="box-body">
							<h4>Archivos</h4>

						</div>
						<div class="box-footer text-center">
							<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modalPermisos"> <i class="fas fa-plus"></i> archivo</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Pasos Expediente-->
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
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Expediente {{$expediente->iue}}</h4>
			</div>
			<div class="modal-body">
				@include('juridico.expediente.formRecordatorio')
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!-- FIN Modal Recordatorio -->

<!-- Modal Permisos de usuario -->
<div class="modal fade" id="modalPermisos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Permisos de Usuario</h4>
			</div>
			<div class="modal-body">
				@include('juridico.expediente.formPermiso')
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!-- FIN Modal Permisos de usuario -->


<script>
$(document).ready(function() {
	
	//igualar altura de boxes superiores
	$('#boxRecordatorios').height($('#detalle').height());
	var altura = $('#boxRecordatorios').height() - 120;
	$('#bodyRecordatorios').height(altura);
	
	//select en formulario de permisos
	
	
	
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