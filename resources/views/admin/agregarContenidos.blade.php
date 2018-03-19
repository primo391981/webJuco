
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
                   <H1>Agregar Contenido</H1>
                </div>
				<div class="row">	
					<div  class="col-sm-12" style="overflow-x: auto;">
						<form  method="POST" action="{{ url('contenidos/agregar') }}">
							{{ csrf_field() }}
							<table class="table">
								<tr>
									<td>
										<label>Título</label>
									</td>
									<td>
										<input type="text" name="titulo" value="" id="titulo">
									</td>
								</tr>
								<tr>
									<td>
										<button type="submit">Agregar Contenido</button>
								</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
@endsection

