	@csrf
						<div class="form-group row">
							<label for="fecha_inicio" class="control-label col-sm-3">FECHA INICIO</label>
							<div class="col-sm-9">
								<input id="fecha_inicio" type="date" class="form-control{{ $errors->has('fecha_inicio') ? ' is-invalid' : '' }}" name="fecha_inicio" autofocus required>
								@if ($errors->has('fecha_inicio'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('fecha_inicio') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<label for="fecha_fin" class="control-label col-sm-3">FECHA FIN</label>
							<div class="col-sm-9">
								<input id="fecha_fin" type="date" class="form-control{{ $errors->has('fecha_fin') ? ' is-invalid' : '' }}" name="fecha_fin" autofocus required>
								@if ($errors->has('fecha_fin'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('fecha_fin') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<div class="col-xs-12 text-center">
								<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Confirmar</button>
							</div>
						</div>
					