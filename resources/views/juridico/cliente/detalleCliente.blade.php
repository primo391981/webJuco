					<h3>Cliente #{{$cliente->id}} - 
					@if($cliente->persona_type === "App\Persona")
						{{$cliente->persona->nombre}} {{$cliente->persona->apellido}}
					@else
						{{$cliente->persona->nombreFantasia}}
					@endif
					</h3>
					<hr>
					@if($cliente->persona_type === "App\Persona")
						<p><strong>TIPO :</strong> Persona Física</p> 
						<p><strong>TIPO DOCUMENTO :</strong> {{$cliente->persona->tipoDoc->nombre}}</p> 
						<p><strong>DOCUMENTO :</strong> {{$cliente->persona->documento}}</p> 
						<p><strong>TELÉFONO :</strong> {{$cliente->persona->telefono}}</p> 
						<p><strong>EMAIL :</strong> {{$cliente->persona->email}}</p> 
						<p><strong>DOMICILIO :</strong> {{$cliente->persona->domicilio}}</p> 
						<p><strong>ESTADO CIVIL :</strong> {{$cliente->persona->eCivil->nombre}}</p> 
					@else
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
					
