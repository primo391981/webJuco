			<hr> 
						<p><strong>ENTIDAD DE PAGO:</strong></p>
						<div class="form-group row">
							<label for="pagoNombre" class="control-label col-sm-3">NOMBRE ENTIDAD *</label>
							<div class="col-sm-9">
								<input id="pagoNombre" type="text" class="form-control" name="pagoNombre" value="{{isset($persona) ? $persona->pagoNombre : old('pagoNombre') }}" required>
								@if ($errors->has('pagoNombre'))
									<span style="color:red;">{{ $errors->first('pagoNombre') }}</span>
								@endif
							</div>	
						</div>
						<div class="form-group row">
							<label for="pagoNumero" class="control-label col-sm-3">NUMERO *</label>
							<div class="col-sm-9">
								<input id="pagoNumero" type="number" class="form-control" name="pagoNumero" value="{{isset($persona) ? $persona->pagoNumero : old('pagoNumero') }}" min="0" required>
								@if ($errors->has('pagoNumero'))
									<span style="color:red;">{{ $errors->first('pagoNumero') }}</span>
								@endif
							</div>	
						</div>
						<hr> 
						<p><strong>PERSONAS A CARGO:</strong></p>
						<div class="form-group row">
							<label for="cantHijos" class="control-label col-sm-3">HIJOS MENORES *</label>
							<div class="col-sm-9">
								<input id="cantHijos" type="number" class="form-control" name="cantHijos" value="{{isset($persona) ? $persona->cantHijos : old('cantHijos') }}" min="0" required>
								@if ($errors->has('cantHijos'))
									<span style="color:red;">{{ $errors->first('cantHijos') }}</span>
								@endif
							</div>	
						</div>
						<div class="form-group row">
							<label for="conDiscapacidad" class="control-label col-sm-3">CON DISCAPACIDAD *</label>
							<div class="col-sm-9">
								<input id="conDiscapacidad" type="number" class="form-control" name="conDiscapacidad" value="{{isset($persona) ? $persona->conDiscapacidad : old('conDiscapacidad') }}" min="0" required>
								@if ($errors->has('conDiscapacidad'))
									<span style="color:red;">{{ $errors->first('conDiscapacidad') }}</span>
								@endif
							</div>	
						</div>