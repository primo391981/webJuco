@extends('layouts.app')

@section('content')
<div class="row text-center">
	<a href="{{ route('home') }}"><img class="img-fluid"  src="{{ asset('img/logo_balanza.jpg') }}"/></a>
</div>
@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif
<form method="POST" action="{{ route('password.email') }}">
@csrf

                        <div class="form-group">
                            <label for="email" class="col-sm-2 col-form-label text-right">Email: </label>
                            <div class="col-sm-10">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
							
                        <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    Recuperar contraseña
                                </button>
                            </div>
                        </div>
                    </form>
@endsection
