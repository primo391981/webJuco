@csrf
				<div class="form-group row">
					<label for="rut" class="col-md-3 col-form-label text-right">RUT *</label>
					<div class="col-md-9">
					<input id="rut" type="number" class="form-control" name="rut" value="{{ isset($empresa) ? $empresa->rut : old('rut') }}" placeholder="RUT - Registro Único Tributario *" autofocus required>
					@if ($errors->has('rut'))
					<span style="color:red;">{{ $errors->first('rut') }}</span>
					@endif
					</div>
				</div>
				<div class="form-group row">
					<label for="razonSocial" class="col-md-3 col-form-label text-right">RAZON SOCIAL *</label>
					<div class="col-md-9">
						<input id="razonSocial" type="text" class="form-control" name="razonSocial" value="{{ isset($empresa) ? $empresa->razonSocial : old('razonSocial') }}" placeholder="Razón social *" required>
						@if ($errors->has('razonSocial'))
							<span style="color:red;">{{ $errors->first('razonSocial') }}</span>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">NOMBRE FANTASIA *</label>
					<div class="col-md-9">
						<input id="nombreFantasia" type="text" class="form-control" name="nombreFantasia" value="{{ isset($empresa) ? $empresa->nombreFantasia : old('nombreFantasia') }}" placeholder="Nombre fantasía *" required >
						@if ($errors->has('nombreFantasia'))
						<span style="color:red;">{{ $errors->first('nombreFantasia') }}</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">NÚMERO MTSS *</label>
					<div class="col-md-9">
						<input id="numMtss" type="number" class="form-control" name="numMtss" value="{{ isset($empresa) ? $empresa->numMtss : old('numMtss') }}" placeholder="Número MTSS - Ministerio de Trabajo y Seguridad Social *" required>

						@if ($errors->has('numMtss'))
						<span style="color:red;">{{ $errors->first('numMtss') }}</span>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">NÚMERO GRUPO *</label>
					<div class="col-md-9">
						<input id="grupo" type="number" class="form-control" name="grupo" value="{{ isset($empresa) ? $empresa->grupo : old('grupo') }}" placeholder="Número GRUPO - Ministerio de Trabajo y Seguridad Social *" required>
						@if ($errors->has('grupo'))
						<span style="color:red;">{{ $errors->first('grupo') }}</span>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">NÚMERO SUBGRUPO *</label>
					<div class="col-md-9">
						<input id="subGrupo" type="number" class="form-control" name="subGrupo" value="{{ isset($empresa) ? $empresa->subGrupo : old('subGrupo') }}" placeholder="Número SUBGRUPO - Ministerio de Trabajo y Seguridad Social *" required>

						@if ($errors->has('subGrupo'))
						<span style="color:red;">{{ $errors->first('subGrupo') }}</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">NÚMERO BPS *</label>
					<div class="col-md-9">
						<input id="numBps" type="number" class="form-control" name="numBps" value="{{ isset($empresa) ? $empresa->numBps : old('numBps') }}" placeholder="Número BPS - Banco de Previsión Social *" required>
						@if ($errors->has('numBps'))
						<span style="color:red;">{{ $errors->first('numBps') }}</span>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">NÚMERO BSE *</label>
					<div class="col-md-9">
						<input id="numBse" type="number" class="form-control" name="numBse" value="{{ isset($empresa) ? $empresa->numBse : old('numBse') }}"  placeholder="Número BSE - Banco de Seguros del Estado *" required>
						@if ($errors->has('numBse'))
						<span style="color:red;">{{ $errors->first('numBse') }}</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">NOMBRE DE CONTACTO</label>
					<div class="col-md-9">
						<input id="nomContacto" type="text" class="form-control" name="nomContacto" value="{{ isset($empresa) ? $empresa->nomContacto : old('nomContacto') }}" placeholder="Nombre del contacto">
						@if ($errors->has('nomContacto'))
						<span style="color:red;">{{ $errors->first('nomContacto') }}</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">EMAIL</label>

					<div class="col-md-9">
						<input id="email" type="text" class="form-control" name="email" value="{{ isset($empresa) ? $empresa->email : old('email') }}" placeholder="Email - Correo electrónico">
						@if ($errors->has('email'))
						<span style="color:red;">{{ $errors->first('email') }}</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">TELEFONO</label>
					<div class="col-md-9">
						<input id="telefono" type="text" class="form-control" name="telefono" value="{{ isset($empresa) ? $empresa->telefono : old('telefono') }}"placeholder="Teléfono - Celular de contacto">
						@if ($errors->has('telefono'))
						<span style="color:red;">{{ $errors->first('telefono') }}</span>
						@endif
					</div>
				</div>

