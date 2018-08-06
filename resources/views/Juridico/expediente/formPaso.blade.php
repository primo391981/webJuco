	@csrf
						<div class="form-group row">
							<label for="documentos" class="control-label col-sm-3">DOCUMENTO</label>

							<div class="col-sm-9">
								<input id="documentos" type="file" class="form-control{{ $errors->has('documentos') ? ' is-invalid' : '' }}" name="fecha_creacion" value="{{ isset($exp) ? $exp->documentos : old('documentos') }}" autofocus required multiple>

								@if ($errors->has('documentos'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('documentos') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group row">
							<label for="comentarios" class="control-label col-sm-3">COMENTARIOS</label>

							<div class="col-sm-9">
								<textarea id="summernote" class="summernote" name="comentarios" autofocus placeholder="comentarios"></textarea>

								@if ($errors->has('documentos'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('documentos') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						
		
						<div class="form-group row">
								<br>
								<div class="col-xs-12 text-center">
									<button type="submit" class="btn btn-success btn-lg"><i class="fas fa-check"></i> Confirmar</button>
								</div>
						</div>
					