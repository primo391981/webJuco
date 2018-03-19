
<!-- La plantilla utilizada por esta vista esta en admin/layouts/ y se llama app.blade.php -->
@extends('admin.layouts.app')

@section('titulo-seccion', 'Contenidos')

@section('active', 'active')
                
@section('content')
                <div class="row">
						<div class="col-sm-12 pull-right">
							<h1>Agregar</h1>
						</div>
					</div>
					<div class="row">	
						<div  class="col-sm-12" style="overflow-x: auto;">
							<table class="table">
							<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Título</th>
									<th scope="col">Tipo</th>
									<th scope="col">Órden Menú</th>
									<th scope="col">id Padre</th>
									<th scope="col">Acciones</th>
								</tr>
							</thead>
							<tbody>
							@foreach($contenedores as $contenedor)
							
							<tr>
								<td>{{$contenedor->id}}</td>
								<td>{{$contenedor->titulo}}</td>
								<td>{{$contenedor->tipo}}</td>
								<td>{{$contenedor->orden_menu}}</td>
								<td>{{$contenedor->id_padre}}</td>
								<td>modificar elimnar</td>
							</tr>
							@endforeach
							</tbody>
							</table>
						</div>
					</div>
@endsection

