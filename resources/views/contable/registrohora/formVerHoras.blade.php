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
			<div class="panel-heading"><h4><i class="far fa-clock"></i> INFORMACIÓN MARCAS RELOJ </h4></div>
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
						@if($empleado->cargo->remuneracion->id==1)
							@if($empleado->tipoHorario==2)
							<th class="text-center">#T</th>
							@endif
						@else 
							<th class="text-center">#T</th>
						@endif
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
					<form action="{{route('reloj.guardarMarcasEdit')}}" method="post">
					@csrf
					<input id="idEmpleado" name="idEmpleado" type="hidden" value="{{$empleado->id}}"/>
					<input id="fecha" name="fecha" type="hidden" value="{{$fecha}}"/>
					
					@foreach ($total as $t)					
						@if($empleado->cargo->remuneracion->id==1 && $empleado->tipoHorario==1)							
								<tr class="{{$t[3]}}">
								
								@php $dibujoIntermedio=false; @endphp
								@foreach($t[2] as $reg)										
									@if($reg->idTipoHora==6)
										<td class="text-center success">SI</td>
										@php $dibujoIntermedio=true; @endphp
									@endif
								@endforeach
								
								@if($dibujoIntermedio==false)
									<td></td>
								@endif
								
								<td>{{$t[0]}} - {{$t[1]}}</td>							
								
								@foreach($tiposHoras as $th)
									@php $dibujo=false; @endphp
									@foreach($t[2] as $reg)										
											@if($th->id==$reg->idTipoHora)
												@if($th->id!=1 && $th->id!=6)
													<td  bgcolor="#bababa">{{$reg->cantHoras}}</td>
												@else
													@if($th->id!=6)
													<td>{{$reg->cantHoras}}</td>
													@endif
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

