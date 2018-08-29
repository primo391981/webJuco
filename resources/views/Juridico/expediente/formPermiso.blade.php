<div class="container-fluid">
					<div class="col-md-12 example-title">
						<h3>Nuevo permiso</h3>	
					</div>
					<div>
						<form method="POST" action="{{ route('expediente.addPermiso', $expediente) }}" class="form-horizontal">
						  @csrf
						  <div class="form-group">
							<label for="user" class="col-sm-4 control-label">Usuario</label>
							<div class="col-sm-8">
								<select name="usuario" required>
									@foreach($usuarios as $usuario)
										<option value="{{ $usuario->id }}">{{ $usuario->name}} ({{ $usuario->nombre}} {{ $usuario->apellido }})</option>
									@endforeach
								</select>
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="tipoPermiso" class="col-sm-4 control-label">Tipo permiso</label>
							<div class="col-sm-8">
							  <select name="tipoPermiso">
									<option value="1">Escritura</option>
									<option value="2">Lectura</option>
							  </select>
							</div>
						  </div>
						  <div class="form-group">
							<div class="col-sm-12 text-center">
							  <button type="submit" class="btn btn-primary">guardar</button>
							</div>
						  </div>
						</form>
					</div>
				</div>