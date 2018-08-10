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
				<div class="panel panel-default">
					<div class="panel-body">
						<h4>Siguientes pasos</h4>
						@foreach($transiciones as $transicion)
							<div class="col-xs-12 text-center">
								<a type="button" class="btn btn-success btn-lg" href="{{ route('paso.create',[$expediente,$transicion->siguiente])}}"><i class="fas fa-check"></i> {{$transicion->siguiente->nombre}}</a>
							</div>
						@endforeach
					</div>
				</div>
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