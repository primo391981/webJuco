@if(Auth::user()->hasRole('juridicoAdmin') || Auth::user()->permisosEscritura->contains($expediente))
	<a class="btn btn-success pull-right" data-toggle="modal" data-target="#modalRecordatorios" role="button"><i class="fas fa-plus"></i></a>
@endif
<h4>Recordatorios</h4>
<hr class="hidden-xs hidden-sm">
		@if(count($expediente->recordatorios->where('estado',0)) > 0)
			@foreach($expediente->recordatorios->where('estado',0) as $recordatorio)
			<div class="row" style="margin-bottom:5px;">
				<div class="col-xs-10">
					<form method="POST" action="{{ route('recordatorio.destroy',$recordatorio) }}" class="form-inline">
					@method('DELETE')
					@csrf
					<div class="form-group">
						<span>{{$recordatorio->fecha_vencimiento}} - {{$recordatorio->mensaje}}</span>
					</div>
					
				</div>
				<div class="col-xs-2">
					@if(Auth::user()->hasRole('juridicoAdmin') || Auth::user()->permisosEscritura->contains($expediente))
					  <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-times"></i>
					</form>
					@endif
				</div>
			</div>
			@endforeach
		@else
			No hay recordatorios programados
		@endif					
		
		


  