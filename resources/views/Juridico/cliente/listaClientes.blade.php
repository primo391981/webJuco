@extends('juridico.juridico')
@section('content')
@if (Session::has('success'))
	<br>
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
@endif 
@if (Session::has('error'))
	<br>
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div>
@endif 
<br>
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-success text-success">
			<div class="panel-heading">
				<div class="btn-group pull-right">
				  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
				  <i class="fas fa-plus"></i></button>
				  <ul class="dropdown-menu" role="menu">
					<li><a name="juridico" href="{{ route('cliente.create.juridica')}}"><i class="far fa-building"></i> Persona Jurídica</a></li>
					<li><a name="fisico" href="{{ route('cliente.create.fisica')}}"><i class="fas fa-user"></i> Persona Física</a></li>
				  </ul>
				</div>
				<h4>LISTADO CLIENTES ACTIVOS </h4>				
			</div>
			<div class="panel-body">
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
										<i class="fas fa-user"></i> Física 
									@else
										<i class="far fa-building"></i> Jurídica
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
										{{$cliente->persona->nombre}}
										{{$cliente->persona->apellido}} 
									@else
										{{$cliente->persona->razonSocial}}
									@endif
									
								</td>
								
								
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
			
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->
<script>
$(document).ready(function() {
    $('#tableCli').DataTable( {        
		"pagingType": "numbers",
		"pageLength": 10,
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: "<'row'<'col-sm-6'><'col-sm-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-6'B><'col-sm-6'p>>",
        buttons: [
           { extend: 'print', text: 'IMPRIMIR' },
		   { extend: 'pdf', text: 'PDF' },		   
		   { extend: 'excel', text: 'EXCEL' },
		   { extend: 'copy', text: 'COPIAR' }
        ],
		
    } );
} );
</script>
@endsection