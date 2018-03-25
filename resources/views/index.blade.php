@extends('layouts.layout_web')

@section('content')

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

@endsection








