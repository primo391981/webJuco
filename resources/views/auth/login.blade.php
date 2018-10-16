@extends('layouts.app')

@section('content')

<div class="row text-center">
	<a href="{{ route('home') }}"><img class="img-fluid"  src="{{ asset('img/logo_balanza.jpg') }}"/></a>
</div>
	
	<form method="POST" action="{{ route('login') }}" class="form-avoid-double-submit">
	@csrf
	
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Usuario:</label>
    <div class="col-sm-10">
     <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
	 @if ($errors->has('name'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Contraseña:</label>
    <div class="col-sm-10"> 
      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
	  @if ($errors->has('password'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
	@endif
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
	  
	    <label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme en este equipo</label>
      </div>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary btn-avoid-double-submit"><i class="spinner fa fa-spinner fa-spin"></i> Ingresar</button>
		<a class="btn btn-link" href="{{ route('password.request') }}"> Olvidó su contraseña? </a>
	</div>
  </div>
</form>



@endsection