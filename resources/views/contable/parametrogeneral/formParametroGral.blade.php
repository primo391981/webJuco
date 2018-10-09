@csrf
		@if($esEditar==false)
		<div class="form-group row">
			<label for="tipodoc" class="control-label col-sm-3">NOMBRE *</label>
			<div class="col-sm-9">
				<select name="nombre" class="form-control" id="nombre" onchange="myFunction()" autofocus>
					@foreach($unicos as $u)
						<option value="{{$u->nombre}}">{{$u->nombre}} - {{$u->descripcion}}</option> 
					@endforeach
				</select>
			</div>			
		</div>
		@endif
		<div class="form-group row">
			<label for="descripcion" class="control-label col-sm-3">DESCRIPCION *</label>

			<div class="col-sm-9">
				<input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ isset($param) ? $param->descripcion : old('descripcion') }}" required  >

				@if ($errors->has('descripcion'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('descripcion') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="fecha_inicio" class="control-label col-sm-3">FECHA DE INICIO *</label>

			<div class="col-sm-9">
				<input id="fecha_inicio" type="date" class="form-control{{ $errors->has('fecha_inicio') ? ' is-invalid' : '' }}" name="fecha_inicio" value="{{ isset($param) ? $param->fecha_inicio : old('fecha_inicio') }}" required   {{ $readonly }}>

				@if ($errors->has('fecha_inicio'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('fecha_inicio') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="fecha_fin" class="control-label col-sm-3">FECHA DE FIN</label>

			<div class="col-sm-9">
				<input id="fecha_fin" type="date" class="form-control{{ $errors->has('fecha_fin') ? ' is-invalid' : '' }}" name="fecha_fin" value="{{ isset($param) ? $param->fecha_fin : old('fecha_fin') }}"  >

				@if ($errors->has('fecha_fin'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('fecha_fin') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="valor" class="control-label col-sm-3">VALOR *</label>

			<div class="col-sm-9">
				<input id="valor" type="number" step=".001" class="form-control{{ $errors->has('valor') ? ' is-invalid' : '' }}" name="valor" value="{{ isset($param) ? $param->valor : old('valor') }}" required  >

				@if ($errors->has('descripcion'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('valor') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="valor" class="control-label col-sm-3">MINIMO *</label>

			<div class="col-sm-9">
				<input id="minimo" type="number" step=".001" class="form-control{{ $errors->has('valor') ? ' is-invalid' : '' }}" name="minimo" value="{{ isset($param) ? $param->minimo : old('minimo') }}"  required  {{ $esEditar==false ? 'readonly' : '' }}>

				@if ($errors->has('minimo'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('minimo') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		<div class="form-group row">
			<label for="valor" class="control-label col-sm-3">MAXIMO *</label>

			<div class="col-sm-9">
				<input id="maximo" type="number" step=".001" class="form-control{{ $errors->has('maximo') ? ' is-invalid' : '' }}" name="maximo" value="{{ isset($param) ? $param->maximo : old('maximo') }}"  required  {{ $esEditar==false ? 'readonly' : '' }}>

				@if ($errors->has('maximo'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('maximo') }}</strong>
					</span>
				@endif
			</div>
		</div>
		
		