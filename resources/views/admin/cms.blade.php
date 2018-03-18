
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
                <div>
                    Mensaje de bienvenida
                </div>

                <div>
				   
                </div>
@endsection

