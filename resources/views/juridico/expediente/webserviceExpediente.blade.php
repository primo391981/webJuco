@extends('juridico.juridico')

@section('seccion', " - AGREGAR")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('expediente.index') }}" class="btn btn-success" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado expedientes</a></div>				  
</div>

@if (Session::has('error'))
		<div class="alert alert-danger">
			{!!Session::get('error')!!}
		</div>
@endif 



<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-success text-success">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{route('expediente.index')}}" role="button"><i class="fas fa-list-ul"></i></a>
				<h4><i class="fas fa-book"></i> AGREGAR NUEVO EXPEDIENTE </h4>				
			</div>
			<form method="GET" action="{{route('expediente.search')}}">
					@csrf
			<div class="panel-body">
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
				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-success btn-block"><i class="fas fa-search"></i> Consultar</button>				
					</div>
				</div>
			</div>
			</form>
			
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->			
@endsection


