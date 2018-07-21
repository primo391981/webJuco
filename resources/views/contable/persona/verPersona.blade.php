@extends('contable.contable') 
@section('seccion', " - DETALLE") 
 
@section('content') 
@if (Session::has('error')) 
<br>   
  <div class="alert alert-danger"> 
    {{Session::get('error')}} 
  </div> 
@endif 
<br> 
<div class="row">   
  <div class="col-xs-12 col-md-9"> 
    <div class="panel panel-warning"> 
      <div class="panel-heading"> 
        <h4>EMPRESAS ASOCIADAS AL EMPLEADO</h4>           
      </div> 
      <div class="panel-body text-warning">           
        <div class="table-responsive"> 
            <table id="tableEmpresas" class="table"> 
               
              <thead> 
              <tr> 
                <th>NOMBRE FANTASIA</th> 
                <th>CONTACTO</th> 
                <th>TELEFONO</th> 
                <th></th> 
              </tr> 
            </thead> 
            <tbody> 
            @foreach($emprAsociadas as $empr) 
              <tr> 
                <td>{{$empr->nombreFantasia}}</td> 
                <td>{{$empr->nomContacto}}</td> 
                <td>{{$empr->telefono}}</td> 
                <th>DESVINCULAR</th> 
              </tr> 
            @endforeach 
            </tbody> 
             
            </table> 
        </div> 
      </div> 
      <div class="panel-footer"> 
        <a href="{{ route('persona.index') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-list-ul"></i> Listado empleados</a> 
      </div> 
     
    </div> 
  </div> 
  <div class="col-xs-12 col-md-3"> 
    <div class="panel panel-warning"> 
      <div class="panel-heading"> 
        <h4>DETALLE EMPLEADO</h4>           
      </div> 
      <div class="panel-body text-warning">           
        <p>{{$persona->nombre}} {{$persona->apellido}}</p> 
        <hr>         
        <p><strong>TIPO DOCUMENTO :</strong> {{$persona->tipoDoc->nombre}}</p> 
        <p><strong>DOCUMENTO :</strong> {{$persona->documento}}</p> 
        <p><strong>TELÉFONO :</strong> {{$persona->telefono}}</p> 
        <p><strong>EMAIL :</strong> {{$persona->email}}</p> 
        <p><strong>DOMICILIO :</strong> {{$persona->domicilio}}</p> 
        <p><strong>ESTADO CIVIL :</strong> {{$persona->eCivil->nombre}}</p> 
        <p><strong>CANTIDAD DE HIJOS :</strong> {{$persona->cantHijos}}</p> 
      </div> 
      <div class="panel-footer"> 
        <form method="GET" action="{{ route('persona.edit', $persona->id) }}">																
			<button type="submit"class="btn btn-warning btn-block"><i class="far fa-edit"></i> Modificar datos</button>												
		</form>
      </div> 
    </div> 
  </div> 
</div> 
<div class="row"> 
  <div class="col-xs-12"> 
    <div class="panel panel-warning"> 
      <div class="panel-heading"> 
        <h4>LISTADO EMPRESAS SIN ASOCIAR AL EMPLEADO</h4>           
      </div> 
      <div class="panel-body text-warning">           
        <div class="table-responsive"> 
            <table id="tableEmp" class="table table-hover">               
              <thead> 
              <tr> 
                <th>RAZON SOCIAL</th> 
                <th>NOMBRE FANTASIA</th> 
                <th>CARGO</th> 
                <th>FECHA INICIO</th> 
                <th>FECHA FIN</th> 
                <th>SUELDO</th> 
                <th>ASOCIAR</th> 
              </tr> 
            </thead> 
            <tbody> 
              @foreach($emprSinAsociar as $emp) 
                  <tr> 
                      <td>{{$emp->nombreFantasia}}</td> 
                      <td>{{$emp->razonSocial}}</td> 
                       
                      <form method="POST" action="{{route('persona.asociarEmpresa',[$persona->id,$emp->id]) }}"> 
                        @csrf                   
                        <td> 
                          <select name="cargo" class="form-control" id="cargo" required> 
                          @foreach($cargos as $key => $tipo) 
                            <option value="{{ $tipo->id }}" {{ old('tipo') == $key + 1 ? 'selected' : '' }}>{{ $tipo->nombre }}</option>   
                          @endforeach 
                          </select> 
                        </td> 
                        <td><input type="date" name="fechaInicio" id="fechaInicio" class="form-control" required ></td> 
                        <td><input type="date" name="fechaFin" id="fechaFin" class="form-control" required></td> 
                        <td><input type="number" name="monto" id="monto" class="form-control" min="1" required></td> 
                        <td align="center"> 
                          <button type="submit"class="btn btn-success"><i class="far fa-handshake fa-lg"></i></button>                         
                        </td> 
                      </form>                   
                      </tr> 
              @endforeach 
            </tbody> 
             
            </table> 
          </div> 
      </div> 
      <div class="panel-footer"> 
        <a href="{{ route('cargo.create') }}" class="btn btn-warning btn-block" role="button"><i class="fas fa-plus"></i> Agregar nuevo cargo</a> 
      </div> 
    </div> 
  </div> 
</div>   
 
<script> 
$(document).ready(function() { 
    $('#tableEmpresas').DataTable( {         
    "language": { 
    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"}, 
    dom: '<"top"f>t<"bottom"Bpi><"clear">', 
        buttons: [ 
           { extend: 'print', text: 'IMPRIMIR' }, 
       { extend: 'pdf', text: 'PDF' },        
       { extend: 'excel', text: 'EXCEL' }, 
       { extend: 'copy', text: 'COPIAR TABLA' } 
        ] 
    } ); 
   
   
} ); 
</script> 
<script> 
$(document).ready(function() { 
    $('#tableEmp').DataTable( {         
    "language": { 
    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"}, 
    dom: '<"top"f>t<"bottom"Bpi><"clear">', 
        buttons: [ 
           { extend: 'print', text: 'IMPRIMIR' }, 
       { extend: 'pdf', text: 'PDF' },        
       { extend: 'excel', text: 'EXCEL' }, 
       { extend: 'copy', text: 'COPIAR TABLA' } 
        ] 
    } ); 
   
} ); 
</script>           
@endsection 
 