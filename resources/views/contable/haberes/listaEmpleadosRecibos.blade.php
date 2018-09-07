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

<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="#" role="button"><i class="fas fa-plus"></i></a>
				<h4><i class="fas fa-building"></i> LISTADO DE EMPRESAS ACTIVAS </h4>				
			</div>
			<div class="panel-body">
				
				@foreach($empleadosRecibo as $empRecibo)
				<p>{{$empRecibo}}</p>
				
				@endforeach
			
			</div>
			<div class="panel-footer">
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->
@endsection

