
@extends('admin.layouts.app')

@section('content')


            <div class="container">
                <div>
                    Sistema de Administración de Contenidos
                </div>

                <div>
				    @foreach($contenedores as $contenedor)
						{{ $contenedor->titulo }}<br>
					@endforeach
                </div>
            </div>

@endsection