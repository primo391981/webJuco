<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Acceso denegado</title>

    <!-- Bootstrap-->
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
</head>
<body>    
	<div style="margin-top:200px;" class="container text-center">
		<h1>No tiene permiso para acceder a este contenido.</h1> 
		<p>Si esto se debe a un error, contáctese con el administrador del sistema. Muchas gracias</p>
		<a class="btn btn-primary" href="{{route('home')}}">Sitio web</a> <a class="btn btn-default" href="{{ URL::previous() }}">Volver</a> 
    </div>
</body>
</html>
	
