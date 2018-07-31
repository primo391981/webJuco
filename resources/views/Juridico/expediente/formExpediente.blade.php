	@csrf
						<div class="form-group row">
								<label for="tipoexp" class="control-label col-sm-3">TIPO EXPEDIENTE</label>
								<div class="col-sm-9">
									<select name="tipoexp" class="form-control" id="tipoexp">
										@foreach($tipoExpedientes as $key => $tipo)
											<option value="{{ $tipo->id }}" {{ old('tipoexp', isset($exp) ? $exp->tipo_id : '' ) == $key + 1 ? 'selected' : '' }}>{{ $tipo->nombre }}</option>  
										@endforeach
									</select>
								</div>			
						</div>
						<div class="form-group row">
							<label for="iue" class="control-label col-sm-3">IUE *</label>
							<div class="col-sm-9">
								<div class="well well-sm">{{isset($exp) ? $exp->iue : $expediente->expediente }}</div>
								<input id="IUE" type="hidden" name="IUE" value="{{isset($exp) ? $exp->iue : $expediente->expediente }}">
								@if ($errors->has('iue'))
									<span style="color:red;">{{ $errors->first('iue') }}</span>
								@endif
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="caratula" class="control-label col-sm-3">CARATULA *</label>
							<div class="col-sm-9">
								<div class="well well-sm">{{isset($exp) ? $exp->iue : $expediente->caratula }}</div>
								<input id="caratula" type="hidden" name="caratula" value="{{isset($exp) ? $exp->iue : $expediente->caratula }}">
								@if ($errors->has('caratula'))
									<span style="color:red;">{{ $errors->first('caratula') }}</span>
								@endif
							</div>	
						 </div>
						 
						 
						<div class="form-group row">
								<br>
								<div class="col-xs-12 text-center">
									<button type="submit" class="btn btn-warning btn-lg"><i class="fas fa-check"></i> Confirmar</button>
								</div>
						</div>
					