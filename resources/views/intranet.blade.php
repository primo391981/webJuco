
@extends('layouts.layout_intranet')

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
                    <h1>Administración Juco</h1>
                </div>

                <div>
				<!-- la funcion route de laravel blade envía el link a la ruta nombrada -->
					@if(Auth::user()->hasRole('superAdmin'))
						<a href="{{ route('users') }}" class="btn btn-primary btn-lg">Usuarios</a>
					@endif
				
				
                    @if(Auth::user()->hasRole('cmsAdmin'))
						<a href="{{ route('cms') }}" class="btn btn-primary btn-lg">CMS</a>
					@endif
					
					@if(Auth::user()->hasRole('juridicoAdmin'))
						<a href="" class="btn btn-primary btn-lg">Jurídico</a>
					@endif
				
					@if(Auth::user()->hasRole('contableAdmin'))
						<a href="" class="btn btn-primary btn-lg">Contable</a>
					@endif
                    
                </div>
            </div>

@endsection