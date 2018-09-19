@extends('contable.contable')

@section('seccion', " - MARCA RELOJ")

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
			<a class="btn btn-warning pull-right" href="{{ route('reloj.listaEmpleados') }}" role="button" data-toggle="tooltip" title="Listado marcas reloj"><i class="fas fa-list-ul"></i></a>
			<h4><i class="far fa-clock"></i> INFORMACIÓN MARCAS RELOJ </h4>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12"><p><i class="far fa-calendar-alt"></i> {{$mes}}/{{$anio}}</p></div>
					<div class="col-xs-12"><p><i class="fas fa-building"></i> {{$empleado->empresa->nombreFantasia}}</p></div>
					<div class="col-xs-12"><p><i class="fas fa-user"></i> {{$empleado->persona->tipoDoc->nombre}} {{$empleado->persona->documento}} - {{$empleado->persona->nombre}} {{$empleado->persona->apellido}}</p></p></div>
				</div>
				<hr>
				
				<div class="table-responsive">
				<table id="tableMarcas" class="table table-condensed table-hover">
				<thead>
					<tr>						
						<th class="text-center">#I</th>
						<th>DÍA</th>
						<th>HORAS</th>
						<th>HORAS EXTRAS</th>
						@if($empleado->espera==true)
						<th>HORAS ESPERA</th>
						@endif
						@if($empleado->nocturnidad==true)
						<th>HORAS NOCTURNIDAD</th>
						@endif
						@if($empleado->pernocte==true)
						<th>HORAS PERNOCTE</th>
						@endif
					</tr>
				</thead>
				<tbody>
					
					@foreach ($total as $t)					
						<tr class="{{$t[3]}}">
								@php $tieneMedia=false; @endphp
								@foreach($t[2] as $reg)										
									@if($reg->idTipoHora==6)
										<td class="success"> SI </td>
										@php $tieneMedia=true; @endphp
									@endif
								@endforeach
								@if($tieneMedia==false)
									<td class="success"> - </td>
								@endif
								
								<td>{{$t[0]}} - {{$t[1]}}</td>
							
							
								@foreach($tiposHoras as $th)
									@php $dibujo=false; @endphp
									@foreach($t[2] as $reg)										
											@if($th->id==$reg->idTipoHora)
												@if($th->id!=1 && $th->id!=6)
													<td class="warning">{{$reg->cantHoras}}</td>
												@endif
												@if($th->id==1)
													<td>{{$reg->cantHoras}}</td>
												@endif
												@php $dibujo=true; @endphp
												@break;
											@endif
									@endforeach
									@if($dibujo==false)
										@switch($th->id)
											@case(2)
												<td>-</td>
												@break
											@case(3)
												@if($empleado->espera==true)
												<td>-</td>
												@endif
												@break
											@case(4)
												@if($empleado->nocturnidad==true)
												<td>-</td>
												@endif
												@break
											@case(5)
												@if($empleado->pernocte==true)
												<td>-</td>
												@endif
												@break	
										@endswitch		
									@endif	
								@endforeach			
						</tr>
					@endforeach
				</tbody>
			</table>
			</div><!--cierra div table responsive-->
				
			</div><!--CIERRE DIV PANELBODY-->
			<div class="panel-footer">
				<a class="btn btn-warning btn-block" href="{{ route('reloj.listaEmpleados') }}" role="button" data-toggle="tooltip" title="Listado marcas reloj"><i class="fas fa-list-ul"></i> Listado empleados marcas reloj</a>
			</div><!--CIERRE DIV PANELFOOTER-->
			
		</div><!--CIERRE DIV PANEL-->
	</div>
</div>
<script>
$(document).ready(function() {
    $('#tableMarcas').DataTable( {     
		paging: false,
		"order": [],
		"language": {
		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
		},
		dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-6'><'col-sm-6'>>",
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

