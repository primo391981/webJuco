@extends('contable.contable')

@section('seccion', " - Empresas")

@section('content')

<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="#" class="btn btn-info" role="button" style="margin-bottom:5%;"><i class="fas fa-plus"></i> Agregar nueva</a></div>				  
</div>
<div class="row text-info">
	<div class="col-xs-12">
		<div class="panel panel-info">
				  <div class="panel-heading text-center">
					<div class="row">
						<div class="col-sm-9"><h4>Listado empresas</h4></div>
						<div class="col-sm-3 hidden-xs"><a href="#" class="btn btn-info pull-right" role="button"><i class="fas fa-plus"></i> Agregar nueva</a></div>				  
					</div>
				  </div>
				  <div class="panel-body text-info">					
					<div class="table-responsive">
						<table id="tableempresas" class="table"> <!--table-hover-->
							
							<thead>
							<tr>
								<th class="scope">ID</th>
								<th>Razón Social</th>
								<th>RUT</th>
								
							</tr>
						</thead>
						<tbody>
						@foreach($empresas as $empresa)						
							<tr>
								<td>{{$empresa->id}}</td>
								<td>{{$empresa->razonSocial}}</td>
								<td>{{$empresa->rut}}</td>
								
							</tr>
						@endforeach
						</tbody>
						
						</table>
					</div>
					
				  </div>
				  <div class="panel-footer"><a href="#" class="btn btn-info btn-block" role="button"><i class="fas fa-plus"></i> Agregar nueva</a></div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
    $('#tablecontenidos').DataTable();
} );
</script>
@endsection

