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
					@yield('menu-lateral')
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