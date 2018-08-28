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
				<div class="row">
					<div class="col-sm-9">
						<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Transiciones <i class="fas fa-sitemap"></i></button>
						
						<button type="button" class="btn btn-info btn-md" >Actualizaciones <i class="fas fa-sync-alt"></i></button>
						
						<button type="button" class="btn btn-warning btn-md" >usuarios <i class="fas fa-user-plus"></i></button>
						
						<button type="button" class="btn btn-danger btn-md">notificaciones <i class="fas fa-bell"></i></button>
					</div>
				</div>
				<br>
				@if(count($transiciones) > 0)
				<div class="panel panel-default">
					<div class="panel-body">
						<h4>Siguientes pasos</h4>
						<div class="col-xs-12 text-center">
						@foreach($transiciones as $transicion)
							
								<a type="button" class="btn btn-success" href="{{ route('paso.create',[$expediente,$transicion->siguiente])}}"><i class="fas fa-angle-right"></i> {{$transicion->siguiente->nombre}}</a>
						@endforeach
						</div>
					</div>
				</div>
				@endif
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

<!-- Modal Notificaciones -->
<div class="modal fade" id="modalRecordatorios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Expediente {{$expediente->iue}}</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="col-md-12 example-title">
						<h3>Nuevo recordatorio</h3>	
					</div>
					<div>
						@foreach($expediente->recordatorios as $recordatorio)
						<div class="alert alert-info">
							<span>{{$recordatorio}}</span>
						</div>
						@endforeach
					</div>
					<div>
						<form method="POST" action="{{ route('recordatorio.store') }}" class="form-horizontal">
						  @csrf
						  <input type="hidden" name="id_expediente" value="{{$expediente->id}}">
						  <div class="form-group">
							<label for="fecha" class="col-sm-2 control-label">Fecha</label>
							<div class="col-sm-10">
							  <input type="date" class="form-control" name="fecha">
							</div>
						  </div>
						  <div class="form-group">
							<label for="cantDias" class="col-sm-2 control-label">Días</label>
							<div class="col-sm-10">
							  <input type="number" class="form-control" name="cantDias" placeholder="Cantidad de días previos al vencimiento">
							</div>
						  </div>
						  <div class="form-group">
							<label for="mensaje" class="col-sm-2 control-label">Mensaje</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" name="mensaje" placeholder="opcional">
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
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!-- FIN Modal Notificaciones -->


<script>
$(document).ready(function() {
	$('#boxRecordatorios').height($('#detalle').height());
	var altura = $('#boxRecordatorios').height() - 120;
	$('#bodyRecordatorios').height(altura);
	
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