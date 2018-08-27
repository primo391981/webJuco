@extends('contable.contable')

@section('seccion', " - ACTIVOS")

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
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{ route('persona.create') }}" role="button"><i class="fas fa-user-plus"></i></a>
				<h4><i class="fas fa-users"></i> LISTADO DE EMPLEADOS ACTIVOS </h4>				
			</div>
			<div class="panel-body">
			
				<div class="table-responsive">
				<table id="tableEmpleados" class="table" style="width:100%" >
					<thead>
							<tr>
								<th>DOCUMENTO</th>
								<th>NOMBRE</th>
								<th>APELLIDO</th>
								<th>EMPRESA</th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($personas as $per)
							<tr>								
								<td>{{$per->tipoDoc->nombre}} - {{$per->documento}}</td>
								<td>{{$per->nombre}}</td>
								<td>{{$per->apellido}}</td>
								@if (count($per->empresas)>0)
									<td>
									@foreach($per->empresas as $emp)
										{{$emp->nombreFantasia}}
									@endforeach
									</td>
								@else
									<td></td>
								@endif
								<td>
									<form method="GET" action="{{route('persona.show', $per->id)}}">																
										<button type="submit"class="btn btn-info"><i class="fas fa-info-circle"></i></button>												
									</form>
								</td>	
								<td>
									<form method="GET" action="{{ route('persona.edit', $per->id) }}">																
										<button type="submit"class="btn btn-warning"><i class="far fa-edit"></i></button>												
									</form>
								</td>				
								<td>
									<form method="POST" action="{{ route('persona.destroy',$per->id) }}">
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
    $('#tableEmpleados').DataTable( {        
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		dom: "<'row'<'col-sm-6'><'col-sm-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-6'B><'col-sm-6'>>",
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

