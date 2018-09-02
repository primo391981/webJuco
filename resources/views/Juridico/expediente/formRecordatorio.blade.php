<div class="row">
<div class="col-xs-12 text-center">
	<p><strong>NUEVO RECORDATORIO</strong></p>
</div>
</div>
<div class="row">
<div class="col-xs-12">
<form method="POST" action="{{ route('recordatorio.store') }}" class="form-horizontal">
						  @csrf
						  <input type="hidden" name="id_expediente" value="{{$expediente->id}}">
						  <div class="form-group">
							<label for="fecha" class="col-sm-2 control-label">Fecha</label>
							<div class="col-sm-10">
							  <input type="date" class="form-control" name="fecha">
							</div>
						  </div>
						  <div class="form-group">
							<label for="cantDias" class="col-sm-2 control-label">Días</label>
							<div class="col-sm-10">
							  <input type="number" class="form-control" name="cantDias" placeholder="Cantidad de días previos al vencimiento">
							</div>
						  </div>
						  <div class="form-group">
							<label for="mensaje" class="col-sm-2 control-label">Mensaje</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" name="mensaje" placeholder="opcional">
							</div>
						  </div>
						  <div class="form-group">
							<div class="col-xs-12 col-md-6" style="margin-bottom:5px;">
							  <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Confirmar</button>
							</div>
							<div class="col-xs-12 col-md-6">
							<button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
							</div>
						  </div>
						</form>
					
</div>
</div>						
				