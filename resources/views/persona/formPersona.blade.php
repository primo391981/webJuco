	@csrf
						<div class="form-group row">
								<label for="tipodoc" class="control-label col-sm-3">TIPO DOCUMENTO</label>
								<div class="col-sm-9">
									<select name="tipodoc" class="form-control" id="tipodoc">
										@foreach($tiposdoc as $key => $tipo)
											<option value="{{ $tipo->id }}" {{ old('tipo', isset($persona) ? $persona->tipoDocumento : '' ) == $key + 1 ? 'selected' : '' }}>{{ $tipo->nombre }}</option>  
										@endforeach
									</select>
								</div>			
						</div>
						<div class="form-group row">
							<label for="documento" class="control-label col-sm-3">DOCUMENTO *</label>
							<div class="col-sm-9">
								<input id="documento" type="text" class="form-control" name="documento" value="{{isset($persona) ? $persona->documento : old('documento') }}"autofocus>
								@if ($errors->has('documento'))
									<span style="color:red;">{{ $errors->first('documento') }}</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="nombre" class="control-label col-sm-3">NOMBRE *</label>
							<div class="col-sm-9">
								<input id="nombre" type="text" class="form-control" name="nombre" value="{{isset($persona) ? $persona->nombre : old('nombre') }}">
								@if ($errors->has('nombre'))
									<span style="color:red;">{{ $errors->first('nombre') }}</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="apellido" class="control-label col-sm-3">APELLIDO *</label>
							<div class="col-sm-9">
								<input id="apellido" type="text" class="form-control" name="apellido" value="{{isset($persona) ? $persona->apellido : old('apellido') }}">
								@if ($errors->has('apellido'))
									<span style="color:red;">{{ $errors->first('apellido') }}</span>
								@endif
							</div>	
						 </div>
						  <div class="form-group row">
							<label for="domicilio" class="control-label col-sm-3">DOMICILIO *</label>
							<div class="col-sm-9">
								<input id="domicilio" type="text" class="form-control" name="domicilio" value="{{isset($persona) ? $persona->domicilio : old('domicilio') }}">
								@if ($errors->has('domicilio'))
									<span style="color:red;">{{ $errors->first('domicilio') }}</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="email" class="control-label col-sm-3">CORREO ELECTRÓNICO</label>
							<div class="col-sm-9">
								<input id="email" type="text" class="form-control" name="email" value="{{isset($persona) ? $persona->email : old('email') }}">
								@if ($errors->has('email'))
									<span style="color:red;">{{ $errors->first('email') }}</span>
								@endif
							</div>	
						 </div>
						  <div class="form-group row">
							<label for="telefono" class="control-label col-sm-3">TELEFONO *</label>
							<div class="col-sm-9">
								<input id="telefono" type="text" class="form-control" name="telefono" value="{{isset($persona) ? $persona->telefono : old('telefono') }}">
								@if ($errors->has('telefono'))
									<span style="color:red;">{{ $errors->first('telefono') }}</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
								<label for="estadoCivil" class="control-label col-sm-3">ESTADO CIVIL *</label>
								<div class="col-sm-9">
									<select name="estadoCivil" class="form-control" id="estadoCivil">
										@foreach($estados as $key => $estado)
											<option value="{{ $estado->id }}" {{ old('estado', isset($persona) ? $persona->estadoCivil : '' ) == $key + 1 ? 'selected' : '' }}>{{ $estado->nombre }}</option>  
										@endforeach
									</select>
								</div>			
						</div>
						 
						<div class="form-group row">
							<label for="cantHijos" class="control-label col-sm-3">CANTIDAD DE HIJOS *</label>
							<div class="col-sm-9">
								<input id="cantHijos" type="number" class="form-control" name="cantHijos" value="{{isset($persona) ? $persona->cantHijos : old('cantHijos') }}" >
								@if ($errors->has('cantHijos'))
									<span style="color:red;">{{ $errors->first('cantHijos') }}</span>
								@endif
							</div>	
						</div>
						 
						<div class="form-group row">
								<br>
								<div class="col-xs-12 text-center">
									<button type="submit" class="btn btn-warning btn-lg"><i class="fas fa-check"></i> Confirmar</button>
								</div>
						</div>
					