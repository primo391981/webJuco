@extends('juridico.juridico')

@section('seccion', " - Listado")

@section('content')

<br>

@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif 
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-warning">
				  <div class="panel-heading text-center">
					<div class="row">
						<div class="col-sm-9"><h4>Listado clientes Inactivos</h4></div>
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					<div class="table-responsive">
						<table id="tableEmpresas" class="table">
							
							<thead>
							<tr>
								<th class="scope">ID</th>
								<th>tipo</th>
								<th>Identificador</th>
								<th>Nombre</th>
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
										<button type="submit"class="btn btn-danger"><i class="fas fa-recycle"></i></button>												
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
						
						</table>
					</div>
					
				  </div>
		</div>
	</div>
</div>
<script>
$(window).resize(function() {
    if( $(this).width() > 1024 ) {
        $(document).ready(function() {
    $('#tableEmpresas').DataTable();
} );
    }
});


</script>
@endsection