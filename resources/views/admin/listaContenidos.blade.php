
<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->
@extends('admin.layouts.app')

@section('menu')
                <div>
                    CMS - Menú de opciones
                </div>
				<div>
                    <a href="{{ route('contenedores') }}">Contenedores</a>
                </div>
                <div>
				    <a href="{{ route('contenidos') }}">Contenidos</a>
                </div>
@endsection

@section('content')
                <div class="row">
                    Contenidos
                </div>
				<div class="row">
                    <div class="col-sm-12 pull-right">
						<a href="{{ route('contenidos/agregar') }}">Agregar</a>
					</div>
                </div>
				<div class="row">	
					<div  class="col-sm-12" style="overflow-x: auto;">
						<table class="table">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Título</th>
								<th scope="col">Texto</th>
								<th scope="col">Ruta Archivo</th>
								<th scope="col">Imagen</th>
								<th scope="col">Texto Imagen</th>
								<th scope="col">Tipo</th>
								<th scope="col">Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach($contenidos as $contenido)						
							<tr>
								<td>{{$contenido->id}}</td>
								<td>{{$contenido->titulo}}</td>
								<td>{{$contenido->texto}}</td>
								<td>{{$contenido->filepath}}</td>
								<td>{{$contenido->imagen}}</td>
								<td>{{$contenido->alt_imagen}}</td>
								<td>{{$contenido->tipo}}</td>
								<td>modificar elimnar</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
				</div>
@endsection

