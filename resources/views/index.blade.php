@extends('layouts.layout_web')

@section('content')

{{-- Se recorre la colección de contenedores enviada desde el controlador --}}
@foreach($menuitems as $menuitem)
	@foreach($menuitem->contenedores->sortBy('orden_menu') as $contenedor)
		
		{{-- se "imprimen" los tags de inicio de la estructura del tipo de contenedor --}}
		{!! $contenedor->inicio_estructura !!}
		
		{{-- se recorre la lista de contenidos de cada contenedor --}}
		@foreach($contenedor->contenidos as $contenido)

			{{-- se imprime el título, texto e imagen (por ahora) de cada contenido ya formateado de acuerdo al tipo contenedor --}}
			{!! $contenido->estructura !!}
		
		@endforeach
		
		{{-- se "imprimen" los tags de fin de la estructura del tipo de contenedor --}}
		{!! $contenedor->tipoContenedor->fin_estructura !!}
	@endforeach
@endforeach
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<!-- Section: contact -->
    @if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
	@endif 
	<div class="container" id="contacto">
		<div class="heading-contact">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<h1>Contacto</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<div class="boxed-grey">

<!-- ****************************FORM********************************-->


							<form method="POST" action=""  id="contactform">
								 {{ csrf_field() }}
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">NOMBRE</label>
											<input type="text" class="form-control" id="name" name="name" placeholder="" required="required" />
										</div>
										<div class="form-group">
											<label for="email">EMAIL</label>
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
												</span>
												<input type="email" class="form-control" id="email" name="email" placeholder="" required="required" /></div>
										</div>
										<div class="form-group">
											<label for="subject">ASUNTO</label>
											<input type="text" class="form-control" id="subject" name="subject" placeholder="" required="required" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="message">MENSAJE</label>
											<textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
												placeholder=""></textarea>
										</div>
									</div>
									<div class="col-md-12">
										<button type="submit" class="btn btn-skin pull-right" id="btnContactUs">
											Enviar</button>                    
										</div>
									</div>
							</form>
		

<!-- ****************************/FORM********************************-->

						</div>
					</div>
		
		<div class="col-lg-4">
			<div class="widget-contact">
				<h5>Estudio Jurídico</h5>
				<address>Dirección</address>
				  <strong>Email</strong><br>
				  <a href="mailto:presidenciacrpm@mercosur.int">mail@estudio.com</a>
			</div>	
		</div>
    </div>	

		</div>
	</div>

	<!-- /Section: contact -->
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@endsection








