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
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="juzgado" class="control-label col-sm-3">JUZGADO *</label>
							<div class="col-sm-9">
								<div class="well well-sm">{{isset($exp) ? $exp->juzgado : $expediente->origen }}</div>
								<input id="juzgado" type="hidden" name="juzgado" value="{{isset($exp) ? $exp->juzgado : $expediente->origen }}">
							</div>	
						 </div>
						 <div class="form-group row">
							<label for="caratula" class="control-label col-sm-3">CARATULA *</label>
							<div class="col-sm-9">
								<div class="well well-sm">{{isset($exp) ? $exp->iue : $expediente->caratula }}</div>
								<input id="caratula" type="hidden" name="caratula" value="{{isset($exp) ? $exp->iue : $expediente->caratula }}">
							</div>	
						 </div>
						 
						 <div class="form-group row">
								<label for="clientes" class="control-label col-sm-3">CLIENTES (seleccione todos)</label>
								<div class="col-sm-9">
									 <select class="js-example-responsive" name="clientes[]" multiple="multiple" style="width: 100%" required>
										@foreach($clientes as $key => $cliente)
											<option value="{{ $cliente->id }}" {{ old('clientes', isset($exp) ? $exp->clientes : '' ) == $key + 1 ? 'selected' : '' }}>{{ $cliente->persona->tipodoc->nombre }} {{ $cliente->persona->documento }} - {{ $cliente->persona->apellido }}, {{ $cliente->persona->nombre }} </option>  
										@endforeach
									</select>
								</div>			
						</div>
						
						<div class="form-group row">
							<label for="fecha_inicio" class="control-label col-sm-3">FECHA CREACION</label>

							<div class="col-sm-9">
								<input id="fecha_inicio" type="date" class="form-control{{ $errors->has('fecha_creacion') ? ' is-invalid' : '' }}" name="fecha_inicio" value="{{ isset($exp) ? $exp->fecha_inicio : old('fecha_inicio') }}" autofocus required>

								@if ($errors->has('fecha_inicio'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('fecha_inicio') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						
						<div class="form-group row">
								<br>
								<div class="col-xs-12 text-center">
									<button type="submit" class="btn btn-success btn-lg"><i class="fas fa-check"></i> Siguiente</button>
								</div>
						</div>
					