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
				<h4><i class="fas fa-clipboard-list"></i> LISTADO DE REPORTES </h4>				
			</div>
			<div class="panel-body">
			
			 <!-- CADA REPORTE ES UN FORM quese dirige mediante post al controllador
			 
				GASTO TOTAL DE HABER SEGUN EL ANIO SLECCIONADO EN LA EMPRESA
				1- fprm con texto, anio, tipo de haber, empresa y boton al metodo en empresaController
			 -->
			 
							
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->


@endsection

