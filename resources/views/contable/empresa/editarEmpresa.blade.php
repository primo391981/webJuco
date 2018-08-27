@extends('contable.contable') <!--layotu: carpeta contable/blade contable-->
@section('seccion', " - EDITAR")
@section('content')


<br>
<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-warning text-warning">
			<div class="panel-heading">
				<a class="btn btn-success pull-right" href="{{ route('empresa.index') }}" role="button" data-toggle="tooltip" title="Listado de empresas"><i class="fas fa-list-ul"></i></a>
				<h4><i class="fas fa-building"></i> EDITAR EMPRESA </h4>				
			</div>
			<div class="panel-body">
			<form method="POST" action="{{ route('empresa.update',$empresa->id) }}" class="form-horizontal">		
						 {{ method_field('PUT') }}
						 {{ csrf_field() }}
						<div class="form-group row">
					<label for="rut" class="col-md-3 col-form-label text-right">RUT - Registro Único Tributario *</label>
					<div class="col-md-9">
					<input id="rut" type="number" class="form-control" name="rut" value="{{$empresa->rut}}" placeholder="RUT - Registro Único Tributario *" autofocus required>
					@if ($errors->has('rut'))
					<span style="color:red;">{{ $errors->first('rut') }}</span>
					@endif
					</div>
				</div>
				<div class="form-group row">
					<label for="razonSocial" class="col-md-3 col-form-label text-right">Razón Social *</label>
					<div class="col-md-9">
						<input id="razonSocial" type="text" class="form-control" name="razonSocial" value="{{$empresa->razonSocial}}" placeholder="Razón social *" required>
						@if ($errors->has('razonSocial'))
							<span style="color:red;">{{ $errors->first('razonSocial') }}</span>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">Nombre fantasía *</label>
					<div class="col-md-9">
						<input id="nombreFantasia" type="text" class="form-control" name="nombreFantasia" value="{{$empresa->nombreFantasia}}" placeholder="Nombre fantasía *" required >
						@if ($errors->has('nombreFantasia'))
						<span style="color:red;">{{ $errors->first('nombreFantasia') }}</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">Número MTSS *</label>
					<div class="col-md-9">
						<input id="numMtss" type="number" class="form-control" name="numMtss" value="{{$empresa->numMtss}}" placeholder="Número MTSS - Ministerio de Trabajo y Seguridad Social *" required>
						@if ($errors->has('numMtss'))
						<span style="color:red;">{{ $errors->first('numMtss') }}</span>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">Número GRUPO *</label>
					<div class="col-md-9">
						<input id="grupo" type="number" class="form-control" name="grupo" value="{{$empresa->grupo}}" placeholder="Número GRUPO - Ministerio de Trabajo y Seguridad Social *" required>
						@if ($errors->has('grupo'))
						<span style="color:red;">{{ $errors->first('grupo') }}</span>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">Número SUBGRUPO *</label>
					<div class="col-md-9">
						<input id="subGrupo" type="number" class="form-control" name="subGrupo" value="{{$empresa->subGrupo}}" placeholder="Número SUBGRUPO - Ministerio de Trabajo y Seguridad Social *" required>
						@if ($errors->has('subGrupo'))
						<span style="color:red;">{{ $errors->first('subGrupo') }}</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">Número BPS *</label>
					<div class="col-md-9">
						<input id="numBps" type="number" class="form-control" name="numBps" value="{{$empresa->numBps}}" placeholder="Número BPS - Banco de Previsión Social *" required>
						@if ($errors->has('numBps'))
						<span style="color:red;">{{ $errors->first('numBps') }}</span>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">Número BSE *</label>
					<div class="col-md-9">
						<input id="numBse" type="number" class="form-control" name="numBse" value="{{$empresa->numBse}}"  placeholder="Número BSE - Banco de Seguros del Estado *" required>
						@if ($errors->has('numBse'))
						<span style="color:red;">{{ $errors->first('numBse') }}</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">Nombre de contacto</label>
					<div class="col-md-9">
						<input id="nomContacto" type="text" class="form-control" name="nomContacto" value="{{$empresa->nomContacto}}" placeholder="Nombre del contacto">
						@if ($errors->has('nomContacto'))
						<span style="color:red;">{{ $errors->first('nomContacto') }}</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">Email - Correo electrónico</label>
					<div class="col-md-9">
						<input id="email" type="text" class="form-control" name="email" value="{{$empresa->email}}" placeholder="Email - Correo electrónico">
						@if ($errors->has('email'))
						<span style="color:red;">{{ $errors->first('email') }}</span>
						@endif
					</div>
				</div>
				
				<div class="form-group row">
					<label class="col-md-3 col-form-label text-right">Teléfono</label>
					<div class="col-md-9">
						<input id="telefono" type="text" class="form-control" name="telefono" value="{{$empresa->telefono}}"placeholder="Teléfono - Celular de contacto">
						@if ($errors->has('telefono'))
						<span style="color:red;">{{ $errors->first('telefono') }}</span>
						@endif
					</div>
				</div>
				
			</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-warning btn-block"><i class="fas fa-check"></i> Confirmar</button>
			</form>
			</div>
		</div><!--cierre panel-->
		
	</div><!--cierre col xs12-->
</div><!--cierre row-->
			
@endsection

