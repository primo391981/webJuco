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
						<th>DÍA</th>
						<th>HORAS COMUNES</th>
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
					<input id="idEmpleado" name="idEmpleado" type="hidden" value="{{$idEmpleado}}"/>
					<input id="fecha" name="fecha" type="hidden" value="{{$fecha}}"/>
					
					@foreach ($total as $t)					
					<tr class="{{$t[2]}}">
						<td>{{$t[0]}} - {{$t[1]}}</td>							
							@foreach($tiposHoras as $th)
								@php $dibujo=false; @endphp
								@foreach($t[3] as $reg)										
										@if($th->id==$reg->idTipoHora)
											@if($th->id!=1)
												<td  bgcolor="#bababa">{{$reg->cantHoras}}</td>
											@else
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
           { extend: 'print', text: 'IMPRIMIR',customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            '<img src="img/reloj.jpg" style="position:absolute; top:0; left:0;" />'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                } },
		   { extend: 'pdf', text: 'PDF' },		   
		   { extend: 'excel', text: 'EXCEL' },
		   { extend: 'copy', text: 'COPIAR' }
        ],
		
		
    } );
} );
</script>
@endsection

