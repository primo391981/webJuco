<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles, fonts scripts-->
    
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<link rel="stylesheet" href="{{ asset('css/general.css') }}"> 
  	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <div id="app">
	
        <nav class="navbar navbar-default navbar-fixed-top">
		  <div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span> 
			  </button>
			  <a class="navbar-brand" style="color:white; font-family: 'Slabo', serif;" href="#">FEOLA CASELLA & GONZALEZ FEOLA</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			  <ul class="nav navbar-nav navbar-right">
			  
				<li><a href="#nuestrafirma">NUESTRA FIRMA</a></li>
				<li><a href="#misionvision">MISIÓN</a></li>
				<li><a href="#misionvision">VISIÓN</a></li>
						
				<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">SERVICIOS
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="#serviciosjuridicos">JURIDICOS</a></li>
				  <li><a href="#asesoramientointegrado">JURIDICO - CONTABLE</a></li>
				  </ul>
			  </li>
				
				 <li><a href="#prof">PROFESIONALES</a></li>
				<li><a href="#derechos">SUS DERECHOS</a></li>
				<li><a href="#contacto">CONTACTO</a></li>
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
			</div>
		  </div>
		</nav>

        <main class="py-4">
		<!-- Contenido que se "rellena" al heredarse las vistas en blade -->
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
	
	<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

   // Make sure this.hash has a value before overriding default behavior
  if (this.hash !== "") {

    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 900, function(){

      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
      });
    } // End if
  });
})


$(window).scroll(function() {
  $(".slideanim").each(function(){
    var pos = $(this).offset().top;

    var winTop = $(window).scrollTop();
    if (pos < winTop + 600) {
      $(this).addClass("slide");
    }
  });
});


</script>

</body>
</html>
