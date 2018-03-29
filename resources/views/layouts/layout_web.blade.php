<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
   <!--css / googlefonts / icons -->
	<link rel="stylesheet" href="css/general.css">
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>Hello, world!</title>
  </head>
  <body>
  
	<nav class="navbar navbar-expand-md navbar-light bg-faded fixed-top">
	  <a class="navbar-brand" href="#">Navbar</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			@foreach($menuitems as $menuitem)
				<li class="nav-item">
					<a class="nav-link" href="#{{ $menuitem->contenedores[0]->id }}">{{ $menuitem->titulo }}</a>
				</li>
			@endforeach
		  <li class="nav-item ">
			<a class="nav-link" href="#dos">Home <span class="sr-only">(current)</span></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#uno">link</a>
		  </li>
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#dos" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Dropdown
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			  <a class="dropdown-item" href="#">Action</a>
			  
			</div>
		  </li>	 
		 
		    @guest
				<li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
			   @else
				   <li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{ Auth::user()->name }} <span class="caret"></span>
										</a>
										<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
											<li>
												<a href="{{ route('admin') }}">Administración</a>
											</li>
											<li>
												<a class="dropdown-item" href="{{ route('logout') }}"
											   onclick="event.preventDefault();
															 document.getElementById('logout-form').submit();">
												Logout
											</a>

											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
											</li>
											
											
										</div>
					         
					</li>
			   @endguest
				
			  </ul>
		 
		 
		 
		</ul>
		
	  </div>
	</nav>
    
	<div class="jumbotron text-center">
		<h2 style="color:white;" >Bienvenido a nuestro estudio</h2>
		<h1 style="font-family:'Slabo', serif; color:white;">FEOLA CASELLA & GONZALEZ FEOLA</h1> 
		<h2 style="color:white;">En defensa de sus derechos desde 1990</h2>
		<h3 style="color:white;">La Paloma - Rocha - Uruguay</h3>		
	</div>
	
	@yield('content')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>