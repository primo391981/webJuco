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
	
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
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
							  <a class="nav-link" href="{{ route('contenedor.index') }}">Contenedores <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="{{ route('contenido.index') }}">Contenidos</a>
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
     <script>
      $('#summernote').summernote({
        placeholder: 'Texto del contenido',
        tabsize: 2,
        height: 100,
		toolbar: [
			// [groupName, [list of button]]
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']]
		  ]
      });
    </script>
</body>
</html>
