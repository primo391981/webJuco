<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
	<script src="https://use.fontawesome.com/c5430d5935.js"></script>
	
	<style>
		.spinner{
			display:none;
		}
	</style>
</head>
<body>
	<!---
		<nav class="navbar navbar-default navbar-static-top navbar-altura">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ route('home') }}">
					<div>
						<img src="{{ asset('img/reloj_logo.png') }}"/>
						<font class="texto-brand"> {{ config('app.name', 'Laravel') }}</font>
					</div>
				</a>
			</div>
			<div class="collapse navbar-collapse" id="app-navbar-collapse">
				
				<ul class="nav navbar-nav">
					&nbsp;
				</ul>
					
				<ul class="nav navbar-nav navbar-right">
					
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
	
	
	
	-->
	<div class="container">
		
			@yield('content')
		
	</div>
</div>
		
<!-- Scripts -->
<script>
	$('.form-avoid-double-submit').on('submit', function(){        
		$('.btn-avoid-double-submit').attr('disabled', true);
		$('.spinner').show();
	});
</script>
</body>
</html>
