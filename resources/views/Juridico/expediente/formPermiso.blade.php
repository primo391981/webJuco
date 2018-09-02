<div class="row">
<div class="col-xs-12 text-center">
	<p><strong>NUEVO PERMISO</strong></p>
</div>
</div>
<div class="row">
<div class="col-xs-12">
						<form method="POST" action="{{ route('expediente.addPermiso', $expediente) }}" class="form-horizontal">
						  @csrf
						  <div class="form-group">
							<label for="user" class="col-sm-3 control-label">USUARIO</label>
							<div class="col-sm-9">
								<select name="usuario" class="form-control" required>
									@foreach($usuarios as $usuario)
										<option value="{{ $usuario->id }}">{{ $usuario->name}} ({{ $usuario->nombre}} {{ $usuario->apellido }})</option>
									@endforeach
								</select>
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="tipoPermiso" class="col-sm-3 control-label">TIPO PERMISO</label>
							<div class="col-sm-9">
							  <select class="form-control" name="tipoPermiso">
									<option value="1">Escritura</option>
									<option value="2">Lectura</option>
							  </select>
							</div>
						  </div>
						  <div class="form-group">
							<div class="col-xs-12 col-md-6" style="margin-bottom:5px;">
							  <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Confirmar</button>
							</div>
							<div class="col-xs-12 col-md-6">
							<button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
							</div>
						  </div>
						</form>
</div>
</div>					