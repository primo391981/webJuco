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
								<label for="clientes" class="control-label col-sm-3">CLIENTES (seleccione todos)</label>
								<div class="col-sm-9">
									 <select class="js-example-responsive" name="clientes[]" multiple="multiple" style="width: 100%">
										@foreach($clientes as $key => $cliente)
											<option value="{{ $cliente->id }}" {{ old('clientes', isset($exp) ? $exp->clientes : '' ) == $key + 1 ? 'selected' : '' }}>{{ $cliente->persona->tipodoc->nombre }} {{ $cliente->persona->documento }} - {{ $cliente->persona->apellido }}, {{ $cliente->persona->nombre }} </option>  
										@endforeach
									</select>
								</div>			
						</div>
						
						<div class="form-group row">
							<label for="fecha_creacion" class="control-label col-sm-3">FECHA CREACION</label>

							<div class="col-sm-9">
								<input id="fecha_creacion" type="date" class="form-control{{ $errors->has('fecha_creacion') ? ' is-invalid' : '' }}" name="fecha_creacion" value="{{ isset($exp) ? $exp->fecha_creacion : old('fecha_creacion') }}" autofocus>

								@if ($errors->has('fecha_creacion'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('fecha_creacion') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group row">
							<label for="archivo" class="control-label col-sm-3">DOCUMENTO {{ $tipoDocumento}}</label>

							<div class="col-sm-9">
								<input id="" type="file" class="form-control{{ $errors->has('archivo') ? ' is-invalid' : '' }}" name="archivo" autofocus>
								@if ($errors->has('archivo'))
									<span class="invalid-feedback">
										<strong>{{ $errors->first('archivo') }}</strong>
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
					