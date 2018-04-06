
<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->
@extends('cms.layouts.layout_cms')

@section('titulo-seccion', $subtitulo)

@section('active', 'active')

@section('content')
                
	<form method="POST" action="{{ route('contenido.update', ['contenido' => $contenido]) }}">
		{{ method_field('PUT') }}
		@include('cms.contenido.formContenido', ['textoBoton' => 'guardar cambios'])
	</form>
				
@endsection

