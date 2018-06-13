@extends('layouts.layout_intranet')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
		<div class="panel panel-info">
			<div class="panel-heading">
			<div class="row">
					<div class="col-sm-9"><h4>Buscar expediente</h4></div>
			</div>	
			</div>	
			
			<div class="panel-body text-info">
					<form method="POST" action="{{ route('searchExpediente') }}">
					@csrf
						<label for="iue">IUE: </label>
						<input type="text" name="iue">
						<input type="submit" value="buscar">
					</form>
			</div>
		</div>
	</div>
	
	
</div>
@endsection
