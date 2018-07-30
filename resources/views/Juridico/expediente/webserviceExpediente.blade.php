@extends('juridico.juridico')

@section('seccion', " - AGREGAR")

@section('content')
<br>
<div class="row">
	<!--solamente es visible en cel-->
	<div class="col-xs-12 visible-xs"><a href="{{ route('expediente.index') }}" class="btn btn-success" style="margin-bottom:5%;" role="button"><i class="fas fa-list-ul"></i> Listado clientes activos</a></div>				  
</div>

<div class="row text-info">
	<div class="col-xs-12 ">
		<div class="panel">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-9"><h4>AGREGAR NUEVO EXPEDIENTE</h4></div>
					<div class="col-sm-3 hidden-xs"><a href="{{ route('expediente.index') }}" class="btn btn-success" role="button"><i class="fas fa-list-ul"></i> Listado clientes activos</a></div>
				</div>
			</div>
			<div class="panel-body text-center">

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
						 					 
						<div class="form-group row">
								<br>
								<div class="col-xs-12 text-center">
									<button type="submit" class="btn btn-success btn-lg"><i class="fas fa-search"></i> Consultar</button>
								</div>
						</div>
					
				</form>
								
			</div>
			<div class="panel-footer"><a href="{{ route('expediente.index') }}" class="btn btn-success btn-block" role="button"><i class="fas fa-list-ul"></i> Listado expedientes </a></div>
		</div>
	</div>
	
</div>
			
@endsection


