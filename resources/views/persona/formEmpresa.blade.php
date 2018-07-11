@csrf
						 <div class="form-group row">
							<label for="rut" class="control-label col-sm-3">RUT</label>
							<div class="col-sm-9">
								<input id="rut" type="text" class="form-control" name="rut" value="{{isset($persona) ? $persona->rut : old('rut') }}"autofocus>
								@if ($errors->has('rut'))
									<span style="color:red;">{{ $errors->first('rut') }}</span>
								@endif
							</div>	
						 </div>
						<div class="form-group row">
							<label for="razonSocial" class="control-label col-sm-3">RAZÓN SOCIAL</label>
							<div class="col-sm-9">
								<input id="razonSocial" type="text" class="form-control" name="razonSocial" value="{{isset($persona) ? $persona->razonSocial : old('razonSocial') }}">
								@if ($errors->has('razonSocial'))
									<span style="color:red;">{{ $errors->first('razonSocial') }}</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="nombreFantasia" class="control-label col-sm-3">NOMBRE FANTASIA</label>
							<div class="col-sm-9">
								<input id="nombreFantasia" type="text" class="form-control" name="nombreFantasia" value="{{isset($persona) ? $persona->nombreFantasia : old('nombreFantasia')}}">
								@if ($errors->has('nombreFantasia'))
									<span style="color:red;">{{ $errors->first('nombreFantasia') }}</span>
								@endif
							</div>	
						 </div>
						  <div class="form-group row">
							<label for="domicilio" class="control-label col-sm-3">DOMICILIO</label>
							<div class="col-sm-9">
								<input id="domicilio" type="text" class="form-control" name="domicilio" value="{{isset($persona) ? $persona->domicilio : old('domicilio')}}">
								@if ($errors->has('domicilio'))
									<span style="color:red;">{{ $errors->first('domicilio') }}</span>
								@endif
							</div>	
						 </div>
						  <div class="form-group row">
							<label for="numBps" class="control-label col-sm-3">NÚMERO BPS</label>
							<div class="col-sm-9">
								<input id="numBps" type="number" class="form-control" name="numBps" value="{{isset($persona) ? $persona->numBps : old('numBps')}}">
								@if ($errors->has('numBps'))
									<span style="color:red;">{{ $errors->first('numBps') }}</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="numBse" class="control-label col-sm-3">NÚMERO BSE</label>
							<div class="col-sm-9">
								<input id="numBse" type="number" class="form-control" name="numBse" value="{{isset($persona) ? $persona->numBse : old('numBse')}}" >
								@if ($errors->has('numBse'))
									<span style="color:red;">{{ $errors->first('numBse') }}</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="numMtss" class="control-label col-sm-3">NÚMERO MTSS</label>
							<div class="col-sm-9">
								<input id="numMtss" type="number" class="form-control" name="numMtss" value="{{isset($persona) ? $persona->numMtss : old('numMtss')}}">
								@if ($errors->has('numMtss'))
									<span style="color:red;">{{ $errors->first('numMtss') }}</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="grupo" class="control-label col-sm-3">GRUPO</label>
							<div class="col-sm-9">
								<input id="grupo" type="number" class="form-control" name="grupo" value="{{isset($persona) ? $persona->grupo : old('grupo')}}">
								@if ($errors->has('grupo'))
									<span style="color:red;">{{ $errors->first('grupo') }}</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="subGrupo" class="control-label col-sm-3">SUB GRUPO</label>
							<div class="col-sm-9">
								<input id="subGrupo" type="number" class="form-control" name="subGrupo" value="{{isset($persona) ? $persona->subGrupo : old('subGrupo')}}">
								@if ($errors->has('subGrupo'))
									<span style="color:red;">{{ $errors->first('subGrupo') }}</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="email" class="control-label col-sm-3">CORREO ELECTRÓNICO</label>
							<div class="col-sm-9">
								<input id="email" type="text" class="form-control" name="email" value="{{isset($persona) ? $persona->subGrupo : old('subGrupo')}}">
								@if ($errors->has('email'))
									<span style="color:red;">{{ $errors->first('email') }}</span>
								@endif
							</div>	
						 </div>
						  <div class="form-group row">
							<label for="telefono" class="control-label col-sm-3">TELEFONO</label>
							<div class="col-sm-9">
								<input id="telefono" type="text" class="form-control" name="telefono" value="{{isset($persona) ? $persona->telefono : old('telefono')}}">
								@if ($errors->has('telefono'))
									<span style="color:red;">{{ $errors->first('telefono') }}</span>
								@endif
							</div>	
						 </div>
						  <div class="form-group row">
							<label for="nomContacto" class="control-label col-sm-3">NOMBRE DE CONTACTO</label>
							<div class="col-sm-9">
								<input id="nomContacto" type="text" class="form-control" name="nomContacto" value="{{isset($persona) ? $persona->nomContacto : old('nomContacto')}}">
								@if ($errors->has('nomContacto'))
									<span style="color:red;">{{ $errors->first('nomContacto') }}</span>
								@endif
							</div>	
						 </div>
						 
						 
						 
						<div class="form-group row">
								<br>
								<div class="col-xs-12 text-center">
									<button type="submit" class="btn btn-warning btn-lg"><i class="fas fa-check"></i> Confirmar</button>
								</div>
						</div>
					</form>