<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->
@extends('cms.layouts.layout_cms')

@section('titulo-seccion', 'Editar Contenedor')

@section('active', 'active')

@section('content')
                
	<form method="POST" action="{{ route('contenedor.update', ['contenedor' => $contenedor]) }}">
	{{ method_field('PUT') }}
	@include('cms.contenedor.formContenedor', ['textoBoton' => 'editar contenedor'])
		
	</form>				
@endsection

