@extends('juridico.juridico')

@section('seccion', " - AGREGAR")

@section('content')
@if (Session::has('error'))
		<div class="alert alert-danger">
			{!!Session::get('error')!!}
		</div>
@endif 
<br>
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-success text-success">
			<div class="panel-heading">
				<a href="{{ route('expediente.index') }}" class="btn btn-success pull-right" role="button"><i class="fas fa-list-ul"></i></a>
				<h4><i class="fas fa-book"></i> AGREGAR NUEVO EXPEDIENTE</h4>				
			</div>
			<div class="panel-body">
				<form method="GET" action="{{route('expediente.search')}}">
					@csrf
						<div class="form-group row">
							<label for="iue" class="control-label col-sm-3">IUE <br><small class="text-muted">(consulta en el Sistema del Poder Judicial)</small></label>
							<div class="col-sm-9">
								<input id="iue" type="text" class="form-control" name="iue" required autofocus placeholder="xxxx-xxxx/xxxx">
								@if ($errors->has('iue'))
									<span style="color:red;">{{ $errors->first('iue') }}</span>
								@endif
							</div>	
						 </div>
			</div>
			<div class="panel-footer">
			<button type="submit" class="btn btn-success btn-block"><i class="fas fa-search"></i> Consultar</button>
			</form>
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->
	
@endsection


