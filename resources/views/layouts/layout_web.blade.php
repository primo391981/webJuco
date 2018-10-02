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
  
    <title></title>
  </head>
  <body>
  
	<nav class="navbar navbar-expand-md navbar-light bg-faded fixed-top">
	  <a class="navbar-brand" href="#">FC&GF</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			@foreach($menuitems as $menuitem) 
				@if($menuitem->contenedores->count() < 2)
					<li class="nav-item">
						<a class="nav-link" href="#{{ $menuitem->contenedores->sortBy('orden_menu')->first()->id }}">{{ $menuitem->titulo }}</a>
					</li>
				@else
					 <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#dos" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						{{ $menuitem->titulo }}
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						@foreach($menuitem->contenedores as $contenedor)	
							<a class="dropdown-item" href="#{{ $contenedor->id }}">{{ $contenedor->titulo }}</a>
						@endforeach
						</div>
					</li>
				@endif
			@endforeach
		  
			<li class="nav-item">
				<a class="nav-link" href="#contacto">Contacto</a>
			</li>
		    @guest
				<li><a class="nav-link" href="#"  data-toggle="modal" data-target="#logueousuario">Login</a></li>
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
    
	<div class="jumbotron text-center d-block d-sm-none">
		<h2 style="color:white;" >Bienvenido a nuestro estudio</h2>
		<h1 style="font-family:'Slabo', serif; color:white;">FEOLA CASELLA & GONZALEZ FEOLA</h1> 
		<h2 style="color:white;">En defensa de sus derechos desde 1990</h2>
		<h3 style="color:white;">La Paloma - Rocha - Uruguay</h3>		
	</div>
	<div class="embed-responsive embed-responsive-16by9 d-none d-sm-block" style="margin-top:56px;">
		<video autoplay loop ><source src="img/orilla2.mp4" type="video/mp4"></video>					
			<div class="text-center"style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);width:100%;">
				<h2 style="color:white;text-shadow: 0 0 3px black;" ><strong>Bienvenido a nuestro estudio</strong></h2>
				<h1 style="font-family:'Slabo', serif; color:white;text-shadow: 0 0 3px black; font-size:50px;"><strong>FEOLA CASELLA & GONZALEZ FEOLA</strong></h1> 
				<h2 style="color:white;text-shadow: 0 0 3px black;"><strong>En defensa de sus derechos desde 1990</strong></h2>
				<h3 style="color:white;text-shadow: 0 0 3px black;"><strong>La Paloma - Rocha - Uruguay</strong></h3>				
			</div>	
	</div>	
	@yield('content')
	
	<!-- Modal logueo usuario -->
<div class="modal fade text-light" id="logueousuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user"></i> Acceso a usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	      <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-3 col-form-label">Usuario</label>
                            <div class="col-sm-9">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
							    @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="control-label col-sm-3 col-form-label">Contraseña</label>

                            <div class="col-sm-9">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                <div class="col-sm-9 checkbox offset-sm-3">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Guardar contraseña
                                    </label>
                                </div>
                            
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-light"><i class="fas fa-check"></i> Aceptar</button>

                                <a class="btn btn-link text-light"  data-toggle="modal" data-target="#recuperarpass" <!--href="{{ route('password.request') }}-->">
                                    Olvidaste tu contraseña?
                                </a>
                            </div>
                        </div>
                    </form>
                
    
			</div>
		
      
    </div>
  </div>
</div>

<!-- Modal recuoerar pass -->
<div class="modal fade " id="recuperarpass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user"></i> Logueo usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			@if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                       <!--<strong>{{ $errors->first('email') }}</strong>-->
									   <p>hola como andas</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
	  
	  
	  </div>
    </div>
  </div>
</div>




	
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
	<!--para obtener el foco en el modal logueo-->
	<script>$('#logueousuario').on('shown.bs.modal', function () {$('#name').focus();})</script>
	<!--<script>$('#recuperarpass').on('hidden.bs.modal', function() {return false;})</script>-->
	<script>$('#recuperarpass').on('hidden.bs.modal', function() { this.modal('show');});</script>
	
 </body>
</html>