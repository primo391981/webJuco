	@csrf
						<input type="hidden" name="expediente_id" value="{{ $expediente }}">
						
						
						@if(!isset($paso))
							<input type="hidden" name="tipoPaso_id" value="{{ $tipoPaso }}">
							<input type="hidden" name="transicion_id" value="{{ $transicion->id }}">
						@endif
						
						@if($tipoPaso != 12)
							
							<div class="form-group row">
								<label for="documentos" class="control-label col-sm-3">DOCUMENTOS</label>
								<div class="col-sm-9">
									
									<input id="documentos" type="file" class="form-control{{ $errors->has('documentos') ? ' is-invalid' : '' }}" name="documentos[]" autofocus multiple>

									@if ($errors->has('documentos'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('documentos') }}</strong>
										</span>
									@endif

								</div>
							</div>
						@else
							<div class="form-group row">
								<label for="resultado" class="control-label col-sm-3">RESULTADO</label>
								<div class="col-sm-9">
									<select id="resultado" class="form-control{{ $errors->has('documentos') ? ' is-invalid' : '' }}" name="resultado" autofocus>
										<option value="0">Perdido</option>
										<option value="1">Ganado</option>
									</select>
								</div>
							</div>
						@endif
						<div class="form-group row">
							<label for="comentarios" class="control-label col-sm-3">COMENTARIOS</label>

							<div class="col-sm-9">
								<textarea id="summernote" class="summernote" name="comentarios" autofocus placeholder="comentarios">{{isset($paso)? $paso->comentario:""}}</textarea>

								@if ($errors->has('comentarios'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('comentarios') }}</strong>
									</span>
								@endif
							</div>
						</div>
		
						<div class="form-group row">
								<div class="col-xs-12 text-center">
									<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Confirmar</button>
									<a class="btn btn-danger btn-xs" href="{{route('expediente.show',$expediente)}}"><i class="fas fa-times"></i> Cancelar</a>
								</div>
						</div>
					