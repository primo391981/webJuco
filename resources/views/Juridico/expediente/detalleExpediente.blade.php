<div class="box box-success" id="detalle">
					<div class="box-header">
						<h3>Exp. {{$expediente->iue}}</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<label for="tipoexp" class="control-label col-sm-3">TIPO</label>
							<div class="col-sm-9">
								{{$expediente->tipo->nombre}}
							</div>
						</div>
						<div class="row">
							<label for="iue" class="control-label col-sm-3">IUE</label>
							<div class="col-sm-9">
								{{$expediente->iue}}
							</div>
						</div>
						<div class="row">
							<label for="juzgado" class="control-label col-sm-3">JUZGADO</label>
							<div class="col-sm-9">
								{{$expediente->juzgado}}
							</div>
						</div>
						<div class="row">
							<label for="caratula" class="control-label col-sm-3">CARATULA</label>
							<div class="col-sm-9">
								{{$expediente->caratula}}
							</div>
						</div>
						<div class="row">
							<label for="clientes" class="control-label col-sm-3">CLIENTES</label>
							<div class="col-sm-9">
								@foreach($expediente->clientes as $cliente)
									@if($cliente->persona_type === "App\Persona")
										{{ $cliente->persona->apellido}}, {{ $cliente->persona->nombre}} - {{ $cliente->persona->tipodoc->nombre}} {{ $cliente->persona->documento}}
									@else
										{{ $cliente->persona->razonSocial }} - RUT {{ $cliente->persona->rut}}
									@endif
									@if (!$loop->last)
										, 
									@endif
								@endforeach
							</div>
						</div>
						<div class="row">
							<label for="fecha_inicio" class="control-label col-sm-3">FECHA</label>
							<div class="col-sm-9">
								{{$expediente->fecha_inicio}}
							</div>
						</div>
						<div class="row">
							<label for="fecha_inicio" class="control-label col-sm-3">PASO ACTUAL</label>
							<div class="col-sm-9">
								<a class="label label-default" href="{{route('paso.show',$expediente->pasos->last())}}">{{$expediente->pasos->last()->tipo->nombre}}</a>
							</div>
						</div>
						<div class="row">
							<label for="fecha_inicio" class="control-label col-sm-3">USUARIO</label>
							<div class="col-sm-9">
								{{$expediente->usuario->name}} ({{$expediente->usuario->nombre}} {{$expediente->usuario->apellido}})
							</div>
						</div>
					</div>
					<div class="box-footer text-center">
							
								<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Transiciones <i class="fas fa-sitemap"></i></button>
								
								<button type="button" class="btn btn-primary btn-xs" >Actualizaciones <i class="fas fa-sync-alt"></i></button>
								
							
						
					</div>
					
				</div>