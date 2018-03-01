
@extends('layouts.app')

@section('content')
<div class="jumbotron text-center">
	<h2>Bienvenido a nuestro estudio</h2>
	<h1 style="color:white; font-family: 'Slabo', serif;">FEOLA CASELLA & GONZALEZ FEOLA</h1> 
	<h2>En defensa de sus derechos desde 1990</h2>
	<h3>La Paloma - Rocha - Uruguay</h3>		
</div>

<div id="nuestrafirma" class="container-fluid contpadding">
	<div class="row">			
		<div class="col-xs-12 col-sm-4 col-sm-offset-2">
			<h1 class="titulo">TituloFirma</h1>
			<p>TextoFirma</p>
		</div>	
		<div class="col-xs-12 col-sm-4">
			<img src="img/reloj.jpg" class="img-responsive pull-right" alt="ESTUDIO FEOLA CASELLA & GONZALEZ FEOLA"/>
		</div>					
	</div>  
</div>
{{-- Se recorre la colección de contenedores enviada desde el controlador --}}

@foreach($contenedores as $contenedor)
	
	{{-- se "imprimen" los tags de inicio de la estructura del tipo de contenedor --}}
	{!! $contenedor->tipoContenedor->inicio_estructura !!}
	
	{{-- se recorre la lista de contenidos de cada contenedor --}}
	@foreach($contenedor->contenidos as $contenido)

		{{-- se imprime el título, texto e imagen (por ahora) de cada contenido ya formateado de acuerdo al tipo contenedor --}}
		{!! $contenido->titulo !!}
		{!! $contenido->texto !!}
		{!! $contenido->imagen !!}
	
	@endforeach
	
	{{-- se "imprimen" los tags de fin de la estructura del tipo de contenedor --}}
	{!! $contenedor->tipoContenedor->fin_estructura !!}
@endforeach

<div id="misionvision" class="container-fluid contpadding imgfondo darken">
	<div class="row">			
		<div class="col-xs-12 col-sm-4 col-sm-offset-2">
			<h1 class="titulo slideanim">Misión</h1>
			<p style="color:white;" class="slideanim">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>
		</div>	
		<div class="col-xs-12 col-sm-4">
			<h1 class="titulo slideanim">Visión</h1>
			<p style="color:white;" class="slideanim">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>
		</div>					
	</div>  
</div>

<div id="serviciosjuridicos" class="container-fluid text-center contpadding">
	<h1 class="titulo slideanim">Servicios jurídicos</h1>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-3">
			<i class="fas fa-users fa-5x slideanim"></i>
			<h3 class="slideanim">CIVIL</h3>
			<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.</p>
		</div>
		
		<div class="col-xs-12 col-sm-3">
			<i class="fas fa-gavel fa-5x slideanim"></i>
			<h3 class="slideanim">PENAL</h3>
			<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.</p>
		</div>
	
		<div class="col-xs-12 col-sm-3">
			<i class="fas fa-home fa-5x slideanim"></i>
			<h3 class="slideanim">FAMILIA</h3>
			<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.</p>
		</div>
		
		<div class="col-xs-12 col-sm-3">
			<i class="fas fa-university fa-5x slideanim"></i>
			<h3 class="slideanim">LABORAL</h3>
			<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.</p>
		</div>
	</div>	
</div>

<div id="asesoramientointegrado" class="container-fluid cont-gris text-center contpadding">
	<div class="row">		
		<div class="col-xs-12 col-md-6 col-md-offset-3">
			<h1 id="asesoramiento" class="slideanim">Asesoramiento empresarial integrado</h1>
			<h3 class="slideanim">JURÍDICO - CONTABLE</h3>
			<p class="slideanim">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>
		</div>
	</div>  
</div>

<div id="prof" class="container-fluid text-center contpadding">
	<h1 id="profesionales">Profesionales</h1>
	<br>
	<div class="row text-center">
		<div class="col-xs-12 col-sm-4 col-sm-offset-2">			
				<img src="img/abogado.png" class="img-responsive center-block slideanim" alt="Dr. Cecilia González Feola"/>
				<h3 class="slideanim"><strong>Dra. Cecilia González Feola</strong></h3>
				<p>- blablabla</p>
				<p>- blablabla</p>
				<p>- blablabla</p>			
		</div>
		<div class="col-xs-12 col-sm-4">			
				<img src="img/abogado.png" class="img-responsive center-block slideanim" alt="Dr. Cecilia González Feola"/>
				<h3 class="slideanim"><strong>Dra. Cecilia González Feola</strong></h3>
				<p>- blablabla</p>
				<p>- blablabla</p>
				<p>- blablabla</p>			
		</div>		
	</div>  
</div>

<div id="derechos" class="container-fluid cont-gris contpadding">
	<div class="row">		
		<div class="col-xs-12 col-sm-6 text-center">
			<h1 class="titulo ">CONOZCA SUS DERECHOS</h1>
			<h2 class="">Leyes y Normativas</h2>			
		</div>
		<div class="col-xs-12 col-sm-6">
			<p class="pull-right ">- LO PONDREMOS BIEN CONTRA LA DERECHA o desde el principio del div</p>
			<p class="pull-right ">- LO PONDREMOS BIEN CONTRA LA DERECHA o desde el principio del div</p>
			<p class="pull-right ">- LO PONDREMOS BIEN CONTRA LA DERECHA o desde el principio del div</p>
			<p class="pull-right ">- LO PONDREMOS BIEN CONTRA LA DERECHA o desde el principio del div</p>
			<p>- LO PONDREMOS BIEN CONTRA LA DERECHA o desde el principio del div</p>					
		</div>		
	</div>  
</div>
@endsection








