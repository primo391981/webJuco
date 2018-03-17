
@extends('admin.layouts.app')

@section('content')


            <div class="container">
                <div>
                    Administración Juco
                </div>

                <div>
				<!-- la funcion route de laravel blade envía el link a la ruta nombrada -->
					<a href="">Usuarios</a>
                    <a href="{{ route('cms') }}">CMS</a>
                    <a href="">Jurídico</a>
                    <a href="">Contable</a>
                    
                </div>
            </div>

@endsection