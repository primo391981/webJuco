<div class="box box-success" id="detalle">
					<div class="box-header">
						<h3>Cliente #{{$cliente->id}} - 
							@if($cliente->persona_type === "App\Persona")
								{{$persona->nombre}} {{$persona->apellido}}
							@else
								{{$cliente->persona->nombreFantasia}}
							@endif
						</h3>
					</div>
					<div class="box-body">
						
							@if($cliente->persona_type === "App\Persona")
								<hr>
								<p><strong>TIPO :</strong> Persona Física</p> 
								<p><strong>TIPO DOCUMENTO :</strong> {{$cliente->tipoDoc->nombre}}</p> 
								<p><strong>DOCUMENTO :</strong> {{$persona->documento}}</p> 
								<p><strong>TELÉFONO :</strong> {{$persona->telefono}}</p> 
								<p><strong>EMAIL :</strong> {{$persona->email}}</p> 
								<p><strong>DOMICILIO :</strong> {{$persona->domicilio}}</p> 
								<p><strong>ESTADO CIVIL :</strong> {{$persona->eCivil->nombre}}</p> 
								<p><strong>CANTIDAD DE HIJOS :</strong> {{$persona->cantHijos}}</p>
							@else
								<hr>
								<p><strong>TIPO :</strong> Persona Jurídica</p> 
								<p><strong>RUT :</strong> {{$cliente->persona->rut}}</p>
								<p><strong>NÚMERO BPS :</strong> {{$cliente->persona->numBps}}</p>
								<p><strong>NÚMERO BSE :</strong> {{$cliente->persona->numBse}}</p>	
								<p><strong>NÚMERO MTSS :</strong> {{$cliente->persona->numMtss}}</p>	
								<p><strong>GRUPO :</strong> {{$cliente->persona->grupo}}</p>	
								<p><strong>SUBGRUPO :</strong> {{$cliente->persona->subGrupo}}</p>	
								<p><strong>RAZÓN SOCIAL :</strong> {{$cliente->persona->razonSocial}}</p>
								<p><strong>CONTACTO :</strong> {{$cliente->persona->nomContacto}}</p>
								<p><strong>TELÉFONO :</strong> {{$cliente->persona->telefono}}</p>
								<p><strong>EMAIL :</strong> {{$cliente->persona->email}}</p>
								<p><strong>DOMICILIO :</strong> {{$cliente->persona->domicilio}}</p>		
							@endif
						
				
				</div>
</div>