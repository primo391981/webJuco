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
<p>
	<strong>PASO ACTUAL: </strong>
	@foreach($expediente->pasos->where('fecha_fin',null) as $paso)
		@if($paso->flujo == 0)
			<a class="label label-success" href="{{route('paso.show',$paso)}}">{{$paso->tipo->nombre}}</a>
		@else
			<a class="label label-warning" href="{{route('paso.show',$paso)}}">{{$paso->tipo->nombre}}</a>
		@endif
	@endforeach
</p>
<p><strong>USUARIO: </strong>{{$expediente->usuario->name}} ({{$expediente->usuario->nombre}} {{$expediente->usuario->apellido}})</p>
<p><strong>ESTADO: </strong>{{$expediente->estado->nombre}} </p>
@if($expediente->estado_id == 5)
	<p><strong>RESULTADO: </strong>
	@if($expediente->resultado == 0)
		<i class="fas fa-times text-danger"></i> Perdido
	@else
		<i class="fas fa-check text-success"></i> Ganado
	@endif
	</p>
@endif
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal"><i class="fas fa-sitemap"></i> Transiciones</button>
<!--<button type="button" class="btn btn-primary btn-xs" ><i class="fas fa-sync-alt"></i> Actualizaciones</button> -->
								