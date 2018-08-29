<div class="container-fluid">
					<div class="col-md-12 example-title">
						<h3>Nuevo recordatorio</h3>	
					</div>
					<div>
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
							<div class="col-sm-12 text-center">
							  <button type="submit" class="btn btn-primary">guardar</button>
							</div>
						  </div>
						</form>
					</div>
				</div>