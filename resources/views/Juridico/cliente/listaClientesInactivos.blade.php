@extends('juridico.juridico')

@section('seccion', " - INACTIVOS")

@section('content')

<br>

@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif 
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('cliente.create') }}" class="btn btn-success" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nuevo cliente</a></div>				  
</div>
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel">
				  <div class="panel-heading">
					<div class="row">
						<div class="col-sm-9"><h4>LISTADO CLIENTES INACTIVOS</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('cliente.create') }}" class="btn btn-success pull-right" role="button"><i class="fas fa-plus"></i> Agregar nuevo cliente</a></div>
					</div>
				  </div>
				  <div class="panel-body text-success">					
					<div class="table-responsive">
						<table id="tableCli" class="table">
							
							<thead>
							<tr>
								<th class="scope">ID</th>
								<th>TIPO</th>
								<th>IDENTIFICADOR</th>
								<th>NOMBRE</th>
								<th></th>
								<th></th>
								
							</tr>
						</thead>
						<tbody>
						@foreach($clientes as $cliente)						
							<tr>
								<td>{{$cliente->id}}</td>
								<td>
									@if($cliente->persona_type=="App\Persona")
										Física 
									@else
										Jurídica
									@endif
								</td>
								<td>
									@if($cliente->persona_type=="App\Persona")
										{{ $cliente->persona->tipoDoc->nombre }}
										{{ $cliente->persona->documento}}
									@else
										RUT
										{{ $cliente->persona->rut}}
									@endif
								</td>
								<td>
									@if($cliente->persona_type=="App\Persona")
										{{$cliente->persona->apellido}} 
										{{$cliente->persona->nombre}}
									@else
										{{$cliente->persona->razonSocial}}
									@endif
									
								</td>
								<td></td>
								<td>
									<form method="POST" action="{{ route('cliente.activar') }}">
										@csrf	
										<input type="hidden" name="cliente_id" value="{{$cliente->id}}">
										<button type="submit"class="btn btn-primary"><i class="fas fa-recycle"></i></button>												
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
						
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('cliente.create') }}" class="btn btn-success btn-block" role="button"><i class="fas fa-plus"></i> Agregar nuevo cliente</a></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
    $('#tableCli').DataTable( {        
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