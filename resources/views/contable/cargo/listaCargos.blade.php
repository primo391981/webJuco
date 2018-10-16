@extends('contable.contable')

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
				<a class="btn btn-success pull-right" href="{{ route('cargo.create') }}" role="button"><i class="fas fa-plus"></i></a>
				<h4><i class="fas fa-briefcase"></i> LISTADO DE CARGOS ACTIVOS </h4>				
			</div>
			<div class="panel-body">
				<div class="table-responsive">
						<table id="tableCargos" class="table">
							
							<thead>
							<tr>
								<th>NOMBRE</th>
								<th>DESCRIPCION</th>
								<th>TIPO REMUNERACION</th>
								<th>SALARIO MINIMO VIGENTE 
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#smn"><i class="fas fa-plus"></i></button>
								</th>
								<th></th>
								<th></th>
								
							</tr>
						</thead>
						<tbody>
						@foreach($cargos as $cargo)						
							<tr>
								<td>{{$cargo->nombre}}</td>
								<td>{{$cargo->descripcion}}</td>
								<td>{{$cargo->remuneracion->nombre}}</td>
								<td>
									@foreach($cargo->salarios as $salario)
										@if ($loop->last)
											{{$salario->fechaDesde}} - {{$salario->monto}} 
										@endif
									@endforeach
								</td>
								<td>
									<form method="GET" action="{{ route('cargo.edit', $cargo) }}">																
										<button type="submit"class="btn btn-warning"><i class="far fa-edit"></i></button>												
									</form>
								</td>				
								<td>
									<form method="POST" action="{{ route('cargo.destroy',$cargo) }}">
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

<!-- Modal SALARIO MINIMO NACIONAL -->
<div class="modal fade" id="smn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-warning">
      <div class="modal-header" style="background:#fcf8e3;">
        <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		<h5>INGRESO NUEVO SALARIO MINIMO</h5>
      </div>
      <div class="modal-body">
		<form class="form-horizontal" action="{{route('cargo.altaSalarioMinimo')}}" method="post">
		@csrf
			<div class="form-group">
				<label class="control-label col-sm-3">CARGO </label>
				<div class="col-sm-9">
				  <select class="form-control" id="selectCargo" name="selectCargo">
					@foreach($cargos as $cargo)
						<option value="{{$cargo->id}}">{{$cargo->nombre}} - {{$cargo->remuneracion->nombre}}</option>
					@endforeach					
				  </select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">MONTO </label>
				<div class="col-sm-9">
					<input class="form-control" type="number" id="monto" name="monto" min="0" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">FECHA INICIO </label>
				<div class="col-sm-9">
					<input class="form-control" type="date" id="fechaInicio" name="fechaInicio" required>
				</div>
			</div>

			 
      </div>
      <div class="modal-footer">
			<div class="row">
			<div class="col-xs-6">
					<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar</button>
			</div>
			<div class="col-xs-6">
				<button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
			</form>
			</div>
			</div>
      </div>
    </div>
  </div>
</div>




<script>
$(document).ready(function() {
    $('#tableCargos').DataTable( {        
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