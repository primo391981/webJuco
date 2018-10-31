@extends('layouts.layout_intranet')

@section('navbar')
<a class="navbar-brand" href="#"><strong>CMS @yield('seccion')</strong></a>
@endsection

@section('menu-lateral')
<li>
    <a href="#"><i class="fas fa-sitemap"></i> Items menú <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('menuitem.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
			 <li><a href="{{ route('menuitem.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
			 <li><a href="{{ route('menuitem.index.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
        </ul>
</li>
<li>
    <a href="#"><i class="fas fa-th-large"></i> Contenedores <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('contenedor.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
			 <li><a href="{{ route('contenedor.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
			 <li><a href="{{ route('contenedor.index.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
        </ul>
</li>
<li>
    <a href="#"><i class="fas fa-th"></i> Contenidos <i class="fas fa-caret-down"></i></a>
		<ul class="nav nav-second-level">
			 <li><a href="{{ route('contenido.index') }}"><i class="fas fa-list-ul"></i> Activos</a></li>
			 <li><a href="{{ route('contenido.create') }}"><i class="fas fa-plus"></i> Agregar nuevo</a></li>
			 <li><a href="{{ route('contenido.index.inactivos') }}"><i class="fas fa-list-ul"></i> Inactivos</a></li>
        </ul>
</li>
		
@endsection

@section('content')
<br>
<div class="row">
	<div class="col-xs-12 text-center">
		<h3>Bienvenido a la administración del sitio web (CMS) </h3>
		<hr>
	</div>
</div>	
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-info">
			  <div class="panel-heading text-center"><h1><i class="fas fa-sitemap"></i> Items menú</h1></div>
			  <div class="panel-body text-info">
				<p>Los items menú son los componentes que conforman el menú de opciones principal del sitio web.<br>Cada item menú cuenta con un título y una descripción, donde el título es el que se ve refleja en el menu principal.<br><br>
				Cada item menú representa a uno o varios <i class="fas fa-th-large"></i> contenedores, logrando un menú de opciones de varios niveles.<br><br>
				</p>
				<br>
				<p style="font-weight: bold;">Funcionalidades</p>
				<p><i class="fas fa-list-ul"></i> Listado de items menú Activos</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-edit"></i> Modificar datos de un item menú ya creado.</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-trash-alt"></i> Eliminar item menú ya creado.</p>
				<p><i class="fas fa-plus"></i> Agregar nuevo item menú</p>
				<p><i class="fas fa-list-ul"></i> Listado de item menús Inactivos</p>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-info">
			  <div class="panel-heading text-center"><h1><i class="fas fa-th-large"></i> Contenedores</h1></div>
			  <div class="panel-body text-info">
				<p>Esta sección cuenta con varios tipos de contenedores (7) los cuales se encargan de la  estructura y visual de los datos que se observan en el sitio web.
				Dichos datos son ingresados mediante la sección <i class="fas fa-th"></i> contenidos.<br><br>
				Cada contenedor cuenta con diferente información, como son título, tipo, item menú, color de fondo, ancho de pantalla e imagen de fondo.</p>
				<br>
				<p style="font-weight: bold;">Funcionalidades</p>
				<p><i class="fas fa-list-ul"></i> Listado de contenedores Activos</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-edit"></i> Modificar datos de un contenedor ya creado.</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-trash-alt"></i> Eliminar contenedor ya creado.</p>
				<p><i class="fas fa-plus"></i> Agregar nuevo contenedor</p>
				<p><i class="fas fa-list-ul"></i> Listado de contenedores Inactivos</p>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4">
		<div class="panel panel-info">
			  <div class="panel-heading text-center"><h1><i class="fas fa-th"></i> Contenidos</h1></div>
			  <div class="panel-body text-info">
				<p>Los contenidos es la sección donde se carga la información y datos que deseea que estén a la vista del público en el sitio web.<br>
				Para cada contenido debe ingresar título, subtítulo, texto, archivo, nombre del archivo, una imagen y un texto alterativo para dicha imagen.<br>
				Según el <i class="fas fa-th-large"></i> contenedor que seleccione es la forma que se visulaiza la información agregada en el contenido.
				</p>
				<br>
				<p style="font-weight: bold;">Funcionalidades</p>
				<p><i class="fas fa-list-ul"></i> Listado de contenidos Activos</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-edit"></i> Modificar datos de un contenido ya creado.</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-trash-alt"></i> Eliminar contenido ya creado.</p>
				<p><i class="fas fa-plus"></i> Agregar nuevo contenido</p>
				<p><i class="fas fa-list-ul"></i> Listado de contenidos Inactivos</p>
			</div>
		</div>
	</div>
</div>

@endsection

