<div class="box box-success" id="boxRecordatorios">
	<div class="box-header">
		<h4>Recordatorios</h4>
	</div>
	<div class="box-body" id="bodyRecordatorios" style="overflow-y: scroll;">
		@if(count($expediente->recordatorios->where('estado',0)) > 0)
			@foreach($expediente->recordatorios->where('estado',0) as $recordatorio)
				<div class="alert alert-warning"> 
					{{$recordatorio->fecha_vencimiento}} - {{$recordatorio->mensaje}} <i class="fas fa-exclamation"></i> 
					<form class="form-inline" style="display: inline-block;" method="POST" action="{{ route('recordatorio.destroy',$recordatorio) }}">
						@method('DELETE')
						@csrf
						<button type="submit" class="btn btn-link"><i class="fas fa-times"></i>
					</form>
				</div>
			@endforeach
		@else
			No hay recordatorios programados
		@endif
	</div>	
	<div class="box-footer text-center">
		@if(Auth::user()->hasRole('juridicoAdmin') || Auth::user()->permisosEscritura->contains($expediente))
			<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalRecordatorios"> <i class="fas fa-plus"></i> recordatorio</button>
		@endif
	</div>					
</div>