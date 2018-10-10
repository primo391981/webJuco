<?php

namespace App\Http\Controllers\Contable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contable\Empleado;
use App\Contable\RegistroHora;
use App\Contable\HorarioEmpleado;
use App\Contable\HorarioPorDia;
use App\Contable\Dia;
use App\Contable\TipoHora;
use App\Contable\Feriado;

use App\Persona;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegistroHoraController extends Controller
{
	/*listado de todos los empleados por empresa (debe tener el horario principal cargado) para el manejo de marcas reloj*/
    public function listaEmpleados(){	
		try{
			$habilitados=Empleado::where('habilitado','=',true)->get();
			$empleados=collect([]);
			foreach($habilitados as $emp){
				if($emp->cargo->remuneracion->id==1){
					if($emp->tipoHorario==1){
						if($emp->horarioCargado==true){
							$empleados->push($emp);
						}						
					}
					else{
						$empleados->push($emp);
					}
				}
				else{
					$empleados->push($emp);
				}				
			}						
			return view('contable.registrohora.listaEmpleados',['empleados'=>$empleados]);
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}		
	}
	
	/*formulario para el ingreso de marcas de reloj de un empleado en un mes y anio dado*/
	public function formMarcas(Request $request){
		try{				
				//ver si esta dentro del contrato del empleado.
				$empleado=Empleado::where('id','=',$request->idEmpleado)->first();
				$fecha=new Carbon($request->mes."-01");
				
				if($this->habilitadoFechaContrato($empleado,$fecha)){
					if($this->tieneMarcas($empleado,$fecha)==false){
						$total=collect([]);
						for($i=1;$i<=$fecha->daysInMonth;$i++){
							$calendario =collect([]);
							$fechaActual=new Carbon($request->mes."-".$i);
							
							$calendario->push(Dia::where('id','=',$fechaActual->dayOfWeekIso)->first()->nombre);
							$calendario->push($i."/".$fechaActual->month);							
							
							if($this->esMensualHab($empleado)){
								if($this->diaFeriado($fechaActual)){								
									$calendario->push("00:00:00");
									$calendario->push("danger");
								}
								else{
									$hor=$empleado->horarios()->where('fechaDesde','<=',$fechaActual)->where('fechaHasta','>=',$fechaActual)->latest()->first();
									$dia=$hor->horariosPorDia()->where('idDia','=',$fechaActual->dayOfWeekIso)->first();//cant horas y tipo registro									
									$calendario->push($dia->cantHoras);
									$calendario->push($this->obtenerColor($dia->idRegistro));
								}
							}							
							$total->push($calendario);
						}						
						//retorno la vista
						return view('contable.registrohora.formCargarHoras',['total'=>$total,'idEmpleado'=>$request->idEmpleado,'fecha'=>$fecha,'empleado'=>$empleado,'mes'=>$fecha->month,'anio'=>$fecha->year]);					
					}
					else{
						return back()->withInput()->withError("Ya existen horas cargadas de ".$empleado->persona->nombre." ".$empleado->persona->apellido." para la fecha ".$fecha->month." / ".$fecha->year.".");
					}
				}
				else{
					$fDesde= new Carbon($empleado->fechaDesde);
					$fHasta= new Carbon($empleado->fechaHasta);
					if($fHasta->year == '2118'){
						$msj=$fDesde->toDateString();
					}
					else{
						$msj=$fDesde->toDateString()." hasta ".$fHasta->toDateString();
					}
					return back()->withInput()->withError("Debe elegir una fecha que este dentro del contrato del empleado. Contrato vigente desde ".$msj);
				}				
			
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}
	}
				
	/*muestra formulario de edicion de maracas de reloj de un empleado en un mes y anio dado*/
	public function editarMes(Request $request){
		try{
			$empleado=Empleado::find($request->idEmpleado);
			$fecha=new Carbon($request->mes.'-01');
			if($this->tieneMarcas($empleado,$fecha)){
				$total=collect([]);
				for($i=1;$i<=$fecha->daysInMonth;$i++){
					$calendario =collect([]);
					$fechaActual=new Carbon($request->mes."-".$i);
					
					$calendario->push(Dia::where('id','=',$fechaActual->dayOfWeekIso)->first()->nombre);
					$calendario->push($i."/".$fechaActual->month);							
					//NO VOY A TENER UNA SOLA HR REGISTRO EN ESA FECHA, necesito hacer un foreach ya que en es afecha puedo tener noc , per, extra,espera 
					$horasReg=RegistroHora::where('idEmpleado','=',$empleado->id)->where('fecha','=',$request->mes."-".$i)->get();
					$calendario->push($horasReg);
					
						if($this->esMensualHab($empleado)){						
							if($this->diaFeriado($fechaActual)){								
								$calendario->push("danger");
							}
							else{
								$hor=$empleado->horarios()->where('fechaDesde','<=',$fechaActual)->where('fechaHasta','>=',$fechaActual)->latest()->first();
								$dia=$hor->horariosPorDia()->where('idDia','=',$fechaActual->dayOfWeekIso)->first();//tipo registro									
								$calendario->push($this->obtenerColor($dia->idRegistro));
							}
						}
						else{
							$calendario->push($this->obtenerColor($horasReg->first()->tipoDia));
						}
					$total->push($calendario);
				}						
				$tiposHoras=TipoHora::All();
				return view('contable.registrohora.formEditarHoras',['total'=>$total,'empleado'=>$empleado,'fecha'=>$fecha,'tiposHoras'=>$tiposHoras,'mes'=>$fecha->month,'anio'=>$fecha->year]);
			}
			else{
				return back()->withInput()->withError("NO existen horas cargadas de ".$empleado->persona->nombre." ".$empleado->persona->apellido." para la fecha ".$fecha->month." / ".$fecha->year.".");
			}
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}
		
	}
		
	/*listado de marcas de reloj de un empleado en un mes y anio*/
	public function verMarcas(Request $request){
		try{
			$empleado=Empleado::find($request->idEmpleado);
			$fecha=new Carbon($request->mes.'-01');
			if($this->tieneMarcas($empleado,$fecha)){
				$total=collect([]);
				for($i=1;$i<=$fecha->daysInMonth;$i++){
					$calendario =collect([]);
					$fechaActual=new Carbon($request->mes."-".$i);
					
					$calendario->push(Dia::where('id','=',$fechaActual->dayOfWeekIso)->first()->nombre);
					$calendario->push($i."/".$fechaActual->month);							
					//NO VOY A TENER UNA SOLA HR REGISTRO EN ESA FECHA, necesito hacer un foreach ya que en es afecha puedo tener noc , per, extra,espera 
					$horasReg=RegistroHora::where('idEmpleado','=',$empleado->id)->where('fecha','=',$request->mes."-".$i)->get();
					$calendario->push($horasReg);
					
						if($this->esMensualHab($empleado)){						
							if($this->diaFeriado($fechaActual)){								
								$calendario->push("danger");
							}
							else{
								$hor=$empleado->horarios()->where('fechaDesde','<=',$fechaActual)->where('fechaHasta','>=',$fechaActual)->latest()->first();
								$dia=$hor->horariosPorDia()->where('idDia','=',$fechaActual->dayOfWeekIso)->first();//tipo registro									
								$calendario->push($this->obtenerColor($dia->idRegistro));
							}
						}
						else{
							$calendario->push($this->obtenerColor($horasReg->first()->tipoDia));
						}
					$total->push($calendario);
				}
						
				$tiposHoras=TipoHora::All();
				return view('contable.registrohora.formVerHoras',['total'=>$total,'fecha'=>$fecha,'empleado'=>$empleado,'tiposHoras'=>$tiposHoras,'mes'=>$fecha->month,'anio'=>$fecha->year]);
			}
			else{
				return back()->withInput()->withError("NO existen horas cargadas de ".$empleado->persona->nombre." ".$empleado->persona->apellido." para la fecha ".$fecha->month." / ".$fecha->year.".");
			}
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}
	}
	
	/*guarda ingreso y edicion de marcas de reloj de un empleado en un mes y anio dado*/
	public function guardarMarcas(Request $request){
		DB::beginTransaction();
		try{			
			
			$tiposHoras=TipoHora::All();			
			$fecha=new Carbon($request->fecha);
			$empleado=Empleado::find($request->idEmpleado);
			
			for($i=1;$i<=$fecha->daysInMonth;$i++){
				foreach($tiposHoras as $th){
						$fechaActual=$fecha->year.'-'.$fecha->month.'-'.$i;	
						$this->accionRegistroHr($empleado,$th,$request->input($th->id.$i.'/'.$fecha->month),$fechaActual,$request->input('radio'.$i.'/'.$fecha->month));
				}
			}
			
			DB::commit();
			return redirect()->route('reloj.listaEmpleados')->with('success', "Las marcas reloj de ".$empleado->persona->nombre." ".$empleado->persona->apellido." para la fecha ".$fecha->month." / ".$fecha->year." fueron ingresadas correctamente.");			
		}
		catch(Exception $e){
			DB::rollBack();
			return back()->withInput()->withError("Error en el sistema.");
		}
	}
	
	//compureba si el empleado tiene cargo mensual habitual
	private function esMensualHab($empleado){
		$es=false;
		if($empleado->cargo->remuneracion->id==1 && $empleado->tipoHorario==1){
			$es=true;
		}
		return $es;
	}
		
	//comprubea si tiene marcas ya ingresadas para una fecha dada
	private function tieneMarcas($empleado,$fecha){
		$tieneMarcas=false;
		$i=1;				 
		while($tieneMarcas==false && $i<=$fecha->daysInMonth){			
			$hrReg=$empleado->registrosHoras()->where('fecha','=',$fecha->year.'-'.$fecha->month.'-'.$i)->first();		
			if($hrReg!=null){
				$tieneMarcas=true;
			}
			$i++;
		}
		return $tieneMarcas;
	}
	
	//comprueba si la fecha de parametro esta dentro del contrato del empleado.
	private function habilitadoFechaContrato($empleado,$fecha){
		$habilitado=false;
		$fDesde=new Carbon($empleado->fechaDesde);
		$fHasta=new Carbon($empleado->fechaHasta);
		if($fecha->between($fDesde,$fHasta)){
			$habilitado=true;
		}
		return $habilitado;
	}
	
	//comprueba si es dia feriado obligatorio(solo lo utiliza empleado con cargo mensual habitual)
	private function diaFeriado($fecha){
		$feriados=Feriado::All();
		$esFeriado=false;
		foreach($feriados as $fer){
			if($fer->dia == $fecha->day && $fer->mes==$fecha->month){
				$esFeriado=true;
			}
		}
		return $esFeriado;
	}
	
	//coor segun el tipo de dia registrado
	private function obtenerColor($dato){
		$color=" ";
		switch($dato){
			case 2:
			case 'm':
				$color='info';
				break;
			case 3:
			case 'd':
				$color='danger';
				break;
		}
		return $color;
	}
	
	//actuliza,guarda o eliminar segun los cambios horario
	private function accionRegistroHr($empleado,$th,$CantHorasReq,$fechaActual,$tipoDia){		
		$horaReg=$empleado->registrosHoras()->where('fecha','=',$fechaActual)->where('idTipoHora','=',$th->id)->first();
		if($th->id==1 || (($CantHorasReq!="00:00:00" && $CantHorasReq!="00:00")&& !is_null($CantHorasReq))){
			//1 me indica que es update o crear (tengo que buscar si existe el dato en la BD)
				if($horaReg!=null){
					//ACTUALIZAR EL DATO
					$horaReg->cantHoras=$CantHorasReq;
					if($this->esMensualHab($empleado)==false){
						//si es jornalero o tiene horario felxible
						$horaReg->tipoDia=$tipoDia;
					}
					$horaReg->save();
				}
				else{
					//CREAR EL DATO
					$regHora=new RegistroHora;
					$regHora->idEmpleado=$empleado->id;
					$regHora->idTipoHora=$th->id;
					$regHora->cantHoras=$CantHorasReq;
					$regHora->fecha=$fechaActual;
					if($this->esMensualHab($empleado)==false){
						//si es jornalero o tiene horario felxible
						$regHora->tipoDia=$tipoDia;
					}
					$regHora->save();
				}
		}
		else{
			//else. th!=1 && tiene valor 00
			//2 me indica que viene con valor 00, si existe en la BD tengo que borrarlo
			if($horaReg!=null){
				//ELIMINAR EL DATO
				$horaReg->delete();
			}
		}
	}
}
