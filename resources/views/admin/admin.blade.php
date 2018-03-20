
@extends('admin.layouts.app')

@section('menu-lateral')
						<div>
							Administración
						</div>
						
						<nav class="hidden-xs-down bg-faded sidebar">
						  <ul class="nav nav-pills flex-column">
							<li class="nav-item">
							  <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
							</li>
							
						  </ul>
						</nav>
@endsection

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