@extends('contable.contable')

@section('seccion', " - EDITAR")

@section('content')
<br>
@if (Session::has('success'))
	<div class="alert alert-success">
		{{Session::get('success')}}
	</div>
@endif 
@if (Session::has('error'))
	<div class="alert alert-danger">
		{{Session::get('error')}}
	</div>
@endif
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<h4>@if ($pago->idTipoPago == 1)
						<i class="fas fa-book"></i> EDITAR VIATICO
					@else
						<i class="fas fa-credit-card"></i> EDITAR ADELANTO
					@endif
				</h4>				
			</div>
			<div class="panel-body">
				<form method="POST" action="{{ route('pago.update', ['pago' => $pago]) }}" class="form-horizontal" enctype="multipart/form-data">
				{{ method_field('PUT') }}
				@include('contable.pago.formEditPagos')
				
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar</button>
				</form>
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->
@endsection
