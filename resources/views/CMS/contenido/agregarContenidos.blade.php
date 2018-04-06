
<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->
@extends('cms.layouts.layout_cms')

@section('titulo-seccion', 'Agregar Contenido')

@section('active', 'active')

@section('content')
                
	<form method="POST" action="{{ route('contenido.store') }}">
		@include('cms.contenido.formContenido', ['textoBoton' => 'Crear contenido'])
	</form>
				
@endsection

