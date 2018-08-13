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
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<label for="tipoexp" class="control-label col-sm-3">TIPO EXPEDIENTE</label>
							<div class="col-sm-9">
								{{$expediente->tipo->nombre}}
							</div>
						</div>
						<div class="row">
							<label for="iue" class="control-label col-sm-3">IUE</label>
							<div class="col-sm-9">
								{{$expediente->iue}}
							</div>
						</div>
						<div class="row">
							<label for="juzgado" class="control-label col-sm-3">JUZGADO</label>
							<div class="col-sm-9">
								{{$expediente->juzgado}}
							</div>
						</div>
						<div class="row">
							<label for="caratula" class="control-label col-sm-3">CARATULA</label>
							<div class="col-sm-9">
								{{$expediente->caratula}}
							</div>
						</div>
						<div class="row">
							<label for="clientes" class="control-label col-sm-3">CLIENTES</label>
							<div class="col-sm-9">
								@foreach($expediente->clientes as $cliente)
									{{ $cliente->persona->apellido}}, {{ $cliente->persona->nombre}} - {{ $cliente->persona->tipodoc->nombre}} {{ $cliente->persona->documento}}
								@endforeach
							</div>
						</div>
						<div class="row">
							<label for="fecha_inicio" class="control-label col-sm-3">FECHA CREACION</label>
							<div class="col-sm-9">
								{{$expediente->fecha_inicio}}
							</div>
						</div>
						<div class="row">
							<label for="fecha_inicio" class="control-label col-sm-3">PASO ACTUAL</label>
							<div class="col-sm-9">
								{{$expediente->actual->nombre}}
							</div>
						</div>
						<div class="row">
							<label for="fecha_inicio" class="control-label col-sm-3">INGRESADO POR</label>
							<div class="col-sm-9">
								{{$expediente->usuario->name}} ({{$expediente->usuario->nombre}} {{$expediente->usuario->apellido}})
							</div>
						</div>
					</div>			
				</div>
				<div class="row">
					<div class="col-sm-9">
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Transiciones de expediente <i class="fas fa-info"></i></button>
					</div>
				</div>
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
								<h3 class="timeline-title">{{$paso->tipo->nombre}}</h3>
								<p>{{$paso->comentario}}</p>
								<p>{{$paso->usuario->name}} ({{$paso->usuario->nombre}} {{$paso->usuario->apellido}})</p>
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