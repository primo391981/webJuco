@extends('juridico.juridico')

@section('seccion', " - Listado")

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('cliente.create') }}" class="btn btn-warning" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nuevo cliente</a></div>				  
</div>
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
						<div class="col-sm-9"><h4>Listado clientes Activos</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="{{ route('cliente.create') }}" class="btn btn-warning pull-right" role="button"><i class="fas fa-plus"></i> Agregar nuevo cliente</a></div>				  
					</div>
				  </div>
				  <div class="panel-body text-warning">					
					<div class="table-responsive">
						<table id="tableEmpresas" class="table">
							
							<thead>
							<tr>
								<th class="scope">ID</th>
								<th>nombre</th>
								<th>tipo</th>
								<th>tipo remuneración</th>
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
										{{$cliente->persona->apellido}} 
									@endif
									{{$cliente->persona->nombre}}
								</td>
								<td>
									@if($cliente->persona_type=="App\Persona")
										Física 
									@else
										Jurídica
									@endif
								</td>
								<td></td>
								<td>
									<form method="GET" action="{{ route('cliente.edit', $cliente) }}">																
										<button type="submit"class="btn btn-warning"><i class="far fa-edit"></i></button>												
									</form>
								</td>				
								<td>
									<form method="POST" action="{{ route('cliente.destroy',$cliente) }}">
										{{ method_field('DELETE') }}
										@csrf	
										<button type="submit"class="btn btn-danger"><i class="far fa-trash-alt"></i></button>												
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
						
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="{{ route('cliente.create') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-plus"></i> Agregar nuevo cliente</a></div>
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