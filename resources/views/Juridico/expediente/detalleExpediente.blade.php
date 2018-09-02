<h4>IUE Expediente: {{$expediente->iue}}</h4>
<hr>
<p><strong>TIPO: </strong>{{$expediente->tipo->nombre}}</p>
<p><strong>JUZGADO: </strong>{{$expediente->juzgado}}</p>
<p><strong>CARATULA: </strong>{{$expediente->caratula}}</p>
<p><strong>CLIENTES: </strong>@foreach($expediente->clientes as $cliente)
									@if($cliente->persona_type === "App\Persona")
										{{ $cliente->persona->apellido}}, {{ $cliente->persona->nombre}} - {{ $cliente->persona->tipodoc->nombre}} {{ $cliente->persona->documento}}
									@else
										{{ $cliente->persona->razonSocial }} - RUT {{ $cliente->persona->rut}}
									@endif
									@if (!$loop->last)
										, 
									@endif
								@endforeach</p>
<p><strong>FECHA INICIO: </strong>{{$expediente->fecha_inicio}}</p>
<p><strong>PASO ACTUAL: </strong><a class="label label-default" href="{{route('paso.show',$expediente->pasos->last())}}">{{$expediente->actual->nombre}}</a></p>
<p><strong>USUARIO: </strong>{{$expediente->usuario->name}} ({{$expediente->usuario->nombre}} {{$expediente->usuario->apellido}})</p>
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal"><i class="fas fa-sitemap"></i> Transiciones</button>
<button type="button" class="btn btn-primary btn-xs" ><i class="fas fa-sync-alt"></i> Actualizaciones</button>
								