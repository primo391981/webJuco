<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
	<script src="https://use.fontawesome.com/c5430d5935.js"></script>
	
	<style>
	
	</style>
</head>
<body>
	<nav class="navbar navbar-default navbar-static-top navbar-altura">
		<div class="container">
			<div class="navbar-header">
				<!-- Collapsed Hamburger -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- Branding Image -->
				<a class="navbar-brand" href="{{ route('home') }}">
					<div>
						<img src="{{ asset('img/reloj_logo.png') }}"/>
						<font class="texto-brand"> {{ config('app.name', 'Laravel') }}</font>
					</div>
				</a>
			</div>
			<div class="collapse navbar-collapse" id="app-navbar-collapse">
				<!-- Left Side Of Navbar -->
				<ul class="nav navbar-nav">
					&nbsp;
				</ul>
					<!-- Right Side Of Navbar -->
				<ul class="nav navbar-nav navbar-right">
					<!-- Authentication Links -->
					@if (!Auth::guest())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								{{ Auth::user()->name }} 
								@if(Auth::user()->rol > 0)
									<i class="fa fa-user-plus" aria-hidden="true"></i>
								@else
									<i class="fa fa-user" aria-hidden="true"></i>	
								@endif
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="{{ route('userlogout') }}"
									onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();">
										Salir
									</a>
									<form id="logout-form" action="{{ route('userlogout') }}" method="GET" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="relleno">
			@yield('content')
		</div>
	</div>
</div>
		
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>