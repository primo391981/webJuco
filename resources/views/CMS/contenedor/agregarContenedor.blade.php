<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->
@extends('cms.layouts.layout_cms')

@section('titulo-seccion', 'Agregar Contenedor')

@section('active', 'active')

@section('content')
                
	<form method="POST" action="{{ route('contenedor.store') }}">
		
	@include('cms.contenedor.formContenedor', ['textoBoton' => 'crear contenedor'])
		
	</form>				
@endsection

