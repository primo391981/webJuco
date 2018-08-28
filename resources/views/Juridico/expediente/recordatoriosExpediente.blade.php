<div class="box box-danger" id="boxRecordatorios">
	<div class="box-header">
		<h4>Recordatorios</h4>
	</div>
	<div class="box-body" id="bodyRecordatorios" style="overflow-y: scroll;">
		@if(count($expediente->recordatorios) > 0)
			@foreach($expediente->recordatorios as $recordatorio)
				<div class="alert alert-warning" role="alert"> {{$recordatorio->fecha_vencimiento}} - {{$recordatorio->mensaje}} <i class="fas fa-exclamation"></i></div>
			@endforeach
		@else
			No hay recordatorios programados
		@endif
	</div>	
	<div class="box-footer text-center">
		<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalRecordatorios"> <i class="fas fa-plus"></i> nuevo</button>
	</div>					
</div>