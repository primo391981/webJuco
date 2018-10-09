
		@csrf
		<!-- ID y nombre de usaurio no se modifican -->
		
		<div class="form-group row">
			<label for="name" class="col-sm-3 control-label">USUARIO</label>

			<div class="col-sm-9">
				<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{isset($usuario) ? $usuario->name : old('name') }}" {{ isset($usuario) ? "readonly" : "required" }} autofocus>
			</div>
		</div>
			@if ($errors->has('name'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
		
		<div class="form-group row">
			<label for="nombre" class="control-label col-sm-3">NOMBRE</label>

			<div class="col-sm-9">
				<input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{isset($usuario) ? $usuario->nombre : old('nombre') }}" required autofocus>

				@if ($errors->has('nombre'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('nombre') }}</strong>
					</span>
				@endif
			</div>
		</div>
	
		<div class="form-group row">
			<label for="apellido" class="control-label col-sm-3">APELLIDO</label>

			<div class="col-sm-9">
				<input id="apellido" type="text" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{isset($usuario) ? $usuario->apellido : old('apellido') }}" required autofocus>

				@if ($errors->has('apellido'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('apellido') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="email" class="control-label col-sm-3">EMAIL</label>

			<div class="col-sm-9">
				<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{isset($usuario) ? $usuario->email : old('email') }} " required autofocus>

				@if ($errors->has('email'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="email" class="control-label col-sm-3">PASSWORD:</label>

			<div class="col-sm-9">
				<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" {{ !isset($usuario) ? 'required' : '' }}>

				@if ($errors->has('password'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="email" class="control-label col-sm-3">REPITA PASSWORD:</label>

			<div class="col-sm-9">
				<input id="passwordRepeat" type="password" class="form-control{{ $errors->has('passwordRepeat') ? ' is-invalid' : '' }}" name="passwordRepeat" {{ !isset($usuario) ? 'required' : '' }}>

				@if ($errors->has('passwordRepeat'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('passwordRepeat') }}</strong>
					</span>
				@endif
			</div>
		</div>
		<hr>
		<div class="form-group row">
			<label for="roles" class="control-label col-sm-3">ROLES</label>
			<div class="col-md-9">							
				<div class="col-xs-12">
					<div class="col-xs-6 pull-left"> {{$roles[1]->nombre}} </div> 
					<div class="col-xs-6"><input type="checkbox" name="checkCMS" class="js-switch-cmsadmin" {{ isset($usuario) ? ($usuario->hasRole($roles[1]->nombre) ? 'checked' : '') : '' }} /></div>
					<div class="col-xs-12"><hr></div>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-6 pull-left"> {{$roles[2]->nombre}} </div> 
					<div class="col-xs-6"><input type="checkbox" name="checkJuridico" class="js-switch-juridicoadmin" {{ isset($usuario) ? ($usuario->hasRole($roles[2]->nombre) ? 'checked' : '') : '' }} /></div>
					<div class="col-xs-12"><hr></div>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-6 pull-left"> {{$roles[3]->nombre}} </div> 
					<div class="col-xs-6"><input type="checkbox" name="checkContable" class="js-switch-contableadmin" {{ isset($usuario) ? ($usuario->hasRole($roles[3]->nombre) ? 'checked' : '') : '' }} /></div>
					<div class="col-xs-12"><hr></div>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-6 pull-left"> {{$roles[4]->nombre}} </div> 
					<div class="col-xs-6"><input type="checkbox" name="checkInvitado" class="js-switch-invitado" {{ isset($usuario) ? ($usuario->hasRole($roles[4]->nombre) ? 'checked' : '') : '' }} /></div>
				</div>
			</div>
		</div>
