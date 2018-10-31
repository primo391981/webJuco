@extends('layouts.layout_web')

@section('content')

{{-- Se recorre la colección de contenedores enviada desde el controlador --}}
@foreach($menuitems as $menuitem)
	@foreach($menuitem->contenedores->sortBy('orden_menu') as $contenedor)
		
		{{-- se "imprimen" los tags de inicio de la estructura del tipo de contenedor --}}
		<div class="seccion">
			{!! $contenedor->inicio_estructura !!}
			
			{{-- se recorre la lista de contenidos de cada contenedor --}}
			@foreach($contenedor->contenidos as $contenido)

				{{-- se imprime el título, texto e imagen (por ahora) de cada contenido ya formateado de acuerdo al tipo contenedor --}}
				{!! $contenido->estructura !!}
			
			@endforeach
			
			{{-- se "imprimen" los tags de fin de la estructura del tipo de contenedor --}}
			{!! $contenedor->tipoContenedor->fin_estructura !!}
		</div>
	@endforeach
@endforeach
<!-- Section: contact -->
   
	<div class="container paddingtop" id="contacto">
			<div class="container">
				 @if (Session::has('success'))
					<div class="alert alert-success">
						{{Session::get('success')}}
					</div>
				@endif 
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<h1>Contacto</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<form method="POST" action="{{ route('contacto') }}"  id="contactform">
							@csrf
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
					</div>
					<div class="col-lg-4">
						<div class="widget-contact">
							<h5>Feola Casella & González Feola</h5>
							<address>Avenida del Navío esquina del Sol<br>
							  La Paloma, Rocha CP27001<br>
							  <abbr title="Teléfono">Tel:</abbr> (598) 4479 6893<br>
							  <a href="mailto:estudiogonzalezfeola@gmail.com">estudiogonzalezfeola@gmail.com</a>
							</address>							  
						</div>	
						<div>
							<a href="https://twitter.com/CasellaFeola" target="_blank"><i class="fab fa-twitter"></i> @CasellaFeola</a><br>
							<a href="https://www.instagram.com/feolacassella_gonzalezfeola/" target="_blank"><i class="fab fa-instagram"></i> feolacassella_gonzalezfeola</a><br>
							<a href="https://www.facebook.com/pages/Estudio-Jur%C3%ADdico-Feola-Casella-y-Gonzalez-Feola/487059981711223" target="_blank"><i class="fab fa-facebook-f"></i> Estudio Gonzalez Feola</a><br>
							<a href="https://www.youtube.com/channel/UCr7fALYyp8iW5-Bp5pdM6Lw?view_as=subscriber" target="_blank"><i class="fab fa-youtube"></i> Estudio Gonzalez Feola</a><br>
						</div>
					</div>
				</div>	
			</div>
	</div>
	<footer id="footer" role="contentinfo">
		<div class="container">
			<div class="">
				<div class="col-md-12 text-center">
					<p>&copy; Proyecto JUCO. Todos los derechos reservados <br>Grupo de Proyecto - Universidad de la Empresa</p>
					
				</div>
			</div>
		</div>
	</footer>


@endsection








