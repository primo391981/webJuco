<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin') }}">
                    Juco - {{ $subtitulo }}
                </a>
                
            </div>
        </nav>

        <main class="py-4">
		<div class="container-fluid">
            <div class="row">
				<div class="col-md-2">
					@section('menu-lateral')
						<div>
							CMS - Menú de opciones
						</div>
						
						<nav class="hidden-xs-down bg-faded sidebar">
						
						  <ul class="nav nav-pills flex-column">
							<li class="nav-item">
							  <a class="nav-link" href="{{ route('contenedores') }}">Contenedores <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="{{ route('contenidos') }}">Contenidos</a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="{{ route('menuitems') }}">Items Menú</a>
							</li>
							<li class="nav-item">
							 <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
							</li>
							
						  </ul>
						</nav>
					@show
				</div>
				<div class="col-md-10">
					<div class="row">
						@yield('titulo-seccion')
					</div>
				
					@yield('content')
					
					
				
				
				</div>
			</div>
		</div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
