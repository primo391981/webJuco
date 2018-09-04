<div class="container-fluid">
					<div class="col-md-12 example-title">
						<h3>Nuevo Archivo</h3>	
					</div>
					<div>
						<form method="POST" action="{{ route('archivo.store') }}" class="form-horizontal" enctype="multipart/form-data">
						  @csrf
						  <input type="hidden" name="expediente_id" value="{{ $expediente->id }}">
						  <div class="form-group">
							<label for="user" class="col-sm-4 control-label">Archivos</label>
							<div class="col-sm-8">
								<input id="documentos" type="file" class="form-control{{ $errors->has('documentos') ? ' is-invalid' : '' }}" name="documentos[]" autofocus multiple>

									@if ($errors->has('documentos'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('documentos') }}</strong>
										</span>
									@endif
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