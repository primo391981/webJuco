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
					if($emp->tipoHora==1){
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
						
						$esMensualHab=false;
						if($empleado->cargo->remuneracion->id==1 && $empleado->tipoHorario==1){
							$horarios=HorarioEmpleado::where('idEmpleado','=',$empleado->id)->orderBy('id', 'desc')->get();
							$esMensualHab=true;
						}
						
						$dias=Dia::All();
						$total=collect([]);
						
						for($i=1;$i<=$fecha->daysInMonth;$i++){
							$calendario =collect([]);
							$fechaActual=new Carbon($request->mes."-".$i);
							if($esMensualHab){
								$cargoDia=false;
								foreach($horarios as $hr){
								$hrFechaDesde=new Carbon($hr->fechaDesde);$hrFechaHasta=new Carbon($hr->fechaHasta);
									if($cargoDia==false && $fechaActual->between($hrFechaDesde,$hrFechaHasta)){
										foreach($dias as $dia){
											if($dia->id==$fechaActual->dayOfWeekIso){
												foreach($hr->horariosPorDia as $hd){
													if($dia->id==$hd->idDia){
														$calendario->push($dia->nombre);
														$calendario->push($i."/".$fechaActual->month);
														$calendario->push($hd->cantHoras);
														switch($hd->idRegistro){
															case 1:		
																$calendario->push(" ");
																break;
															case 2:
																$calendario->push("info");
																break;
															case 3:
																$calendario->push("danger");
																break;
														}
													}
												}
											}							
										}				
										$total->push($calendario);
										$cargoDia=true;
									}
								}//cierra foreach horarios
							}
							else{
									foreach($dias as $dia){
										if($dia->id==$fechaActual->dayOfWeekIso){
											$calendario->push($dia->nombre);
											$calendario->push($i."/".$fechaActual->month);		
										}
									}	
									$total->push($calendario);
								}
						}
						
						//retorno la vista
						$mes=$fecha->month;
						$anio=$fecha->year;
						return view('contable.registrohora.formCargarHoras',['total'=>$total,'idEmpleado'=>$request->idEmpleado,'fecha'=>$fecha,'empleado'=>$empleado,'mes'=>$mes,'anio'=>$anio]);					
					}
					else{
						return back()->withInput()->withError("Ya existen horas cargadas de ".$empleado->persona->nombre." ".$empleado->persona->apellido." para la fecha ".$fecha->month." / ".$fecha->year.".");
					}
				}
				else{
					$fDesde= new Carbon($empleado->fechaDesde);
					$fHasta= new Carbon($empleado->fechaHasta);
					return back()->withInput()->withError("Debe elegir una fecha que este dentro del contrato del empleado. Contrato vigente desde ".$fDesde->toDateString()." hasta ".$fHasta->toDateString());
				}				
			
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}
	}
			
	/*guarda ingreso de marcas de reloj de un empleado en un mes y anio dado*/
	public function guardarMarcas(Request $request){
		DB::beginTransaction();
		try{
			
			$tiposHoras=TipoHora::All();			
			$fecha=new Carbon($request->fecha);
			$empleado=Empleado::find($request->idEmpleado);
			
			for($i=1;$i<=$fecha->daysInMonth;$i++){
				foreach($tiposHoras as $th){
					
					if($request->input($th->id.$i.'/'.$fecha->month)!=null){//por si es null el valor nocturnidad pernocte espera
						$registroHora=new RegistroHora;
						$registroHora->idEmpleado=$request->idEmpleado;
						$registroHora->fecha=$fecha->year.'-'.$fecha->month.'-'.$i;
						
						if($empleado->cargo->remuneracion->id==1 && $empleado->tipoHorario==1){
							//mensual con horario habitual
							
							if($request->input($th->id.$i.'/'.$fecha->month)!="00:00:00" && $request->input($th->id.$i.'/'.$fecha->month)!="00:00"){
								$registroHora->cantHoras=$request->input($th->id.$i.'/'.$fecha->month);
								$registroHora->idTipoHora=$th->id;
								$registroHora->save();
							}
							elseif($th->id==1 && ($request->input($th->id.$i.'/'.$fecha->month)=="00:00:00" || $request->input($th->id.$i.'/'.$fecha->month)=="00:00") ){
								$registroHora->cantHoras=$request->input($th->id.$i.'/'.$fecha->month);
								$registroHora->idTipoHora=$th->id;
								$registroHora->save();
							}
							
						}
						else{
							//menusal horario flexible o jornalero
							//si ese dia esta trabajado lo guarda
							if($request->input('trabajado'.$i.'/'.$fecha->month)=='on'){		

								if($request->input($th->id.$i.'/'.$fecha->month)!="00:00:00" && $request->input($th->id.$i.'/'.$fecha->month)!="00:00"){
									$registroHora->cantHoras=$request->input($th->id.$i.'/'.$fecha->month);
									$registroHora->idTipoHora=$th->id;
									$registroHora->save();
								}
								elseif($th->id==1 && ($request->input($th->id.$i.'/'.$fecha->month)=="00:00:00" || $request->input($th->id.$i.'/'.$fecha->month)=="00:00") ){
									$registroHora->cantHoras=$request->input($th->id.$i.'/'.$fecha->month);
									$registroHora->idTipoHora=$th->id;
									$registroHora->save();
								}
							}
						}
					}
				}
			}
						
			$empleado=Empleado::find($request->idEmpleado);	
			DB::commit();
			return redirect()->route('reloj.listaEmpleados')->with('success', "Las marcas reloj de ".$empleado->persona->nombre." ".$empleado->persona->apellido." para la fecha ".$fecha->month." / ".$fecha->year." fueron ingresadas correctamente.");			
		}
		catch(Exception $e){
			DB::rollBack();
			return back()->withInput()->withError("Error en el sistema.");
		}
	}
	
	/*muestra formulario de edicion de maracas de reloj de un empleado en un mes y anio dado*/
	public function editarMes(Request $request){
		try{
			if($request->mes==null){
				return back()->withInput()->withError("Debe seleccionar un mes y año.");
			}
			else{
				$fechaaux=$request->mes."-01";
				$hrReg=RegistroHora::where('idEmpleado','=',$request->idEmpleado)->where('fecha','=',$fechaaux)->first();
				if($hrReg!=null){
					
					//1- obtener todos los horairos del empleado, 2- dia a dia ver si esta dentro de cada horario, 3- agregar a una coleccion con datos
						$dias=Dia::All();
						$total=collect([]);
						$horarios=HorarioEmpleado::where('idEmpleado','=',$request->idEmpleado)->orderBy('id', 'desc')->get();
						$fecha=new Carbon($request->mes."-01");
						for($i=1;$i<=$fecha->daysInMonth;$i++){
							$calendario =collect([]);
							$cargoDia=false;
							foreach($horarios as $hr){
								$hrFechaDesde=new Carbon($hr->fechaDesde);$hrFechaHasta=new Carbon($hr->fechaHasta);$fechaActual=new Carbon($request->mes."-".$i);
								if($cargoDia==false && $fechaActual->between($hrFechaDesde,$hrFechaHasta)){
									foreach($dias as $dia){
										if($dia->id==$fechaActual->dayOfWeekIso){
											foreach($hr->horariosPorDia as $hd){
												if($dia->id==$hd->idDia){
													$calendario->push($dia->nombre);
													$calendario->push($i."/".$fechaActual->month);
													switch($hd->idRegistro){
														case 1:		
															$calendario->push(" ");
															break;
														case 2:
															$calendario->push("info");
															break;
														case 3:
															$calendario->push("danger");
															break;
													}
													//$calendario->push($hd->cantHoras);
													//NO VOY A TENER UNA SOLA HR REGISTRO EN ESA FECHA, necesito hacer un foreach ya que en es afecha puedo tener noc , per, extra,espera 
													$horasReg=RegistroHora::where('idEmpleado','=',$request->idEmpleado)->where('fecha','=',$request->mes."-".$i)->get();
													$calendario->push($horasReg);
												}
											}
										}							
									}				
									$total->push($calendario);
									$cargoDia=true;
								}
							}
						}
						//retorno la vista
						//dd($total);
						$tiposHoras=TipoHora::All();
						$empleado=Empleado::where('id','=',$request->idEmpleado)->first();
						$mes=$fecha->month;
						$anio=$fecha->year;
						return view('contable.registrohora.formEditarHoras',['total'=>$total,'idEmpleado'=>$request->idEmpleado,'fecha'=>$fecha,'empleado'=>$empleado,'tiposHoras'=>$tiposHoras,'mes'=>$mes,'anio'=>$anio]);
				}
				else{
					return back()->withInput()->withError("Todavía NO ingreso maracas reloj para la fecha ".$request->mes);
				}
			}
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}
	}

	/*Guarda las marcas de reloj editadas para un empleado en un mes y anio dado*/
	public function guardarMarcasEdit(Request $request){
		
		DB::beginTransaction();
		try{
			$tiposHoras=TipoHora::All();
			$fecha=new Carbon($request->fecha);
			$aux=1;
			foreach($tiposHoras as $th){				
				if($request->input($th->id.$aux.'/'.$fecha->month)!=null){//por si es null el valor nocturnidad pernocte espera
					for($i=1;$i<=$fecha->daysInMonth;$i++){
						$horasReg=RegistroHora::where('idEmpleado','=',$request->idEmpleado)->where('fecha','=',$fecha->year.'-'.$fecha->month.'-'.$i)->where('idTipoHora','=',$th->id)->first();
						if($horasReg!=null){
							//si existe actualizo
							$fechaNueva=$fecha->year.'-'.$fecha->month.'-'.$i;
							if($request->input($th->id.$i.'/'.$fecha->month)!="00:00:00" && $request->input($th->id.$i.'/'.$fecha->month)!="00:00"){
								RegistroHora::where('idEmpleado','=',$request->idEmpleado)->where('fecha','=',$fechaNueva)->where('idTipoHora','=',$th->id)->update(['cantHoras'=>$request->input($th->id.$i.'/'.$fecha->month)]);		
							}
							else{
								if($horasReg->idTipoHora==1 && ($request->input($th->id.$i.'/'.$fecha->month)=="00:00:00" || $request->input($th->id.$i.'/'.$fecha->month)=="00:00")){
								RegistroHora::where('idEmpleado','=',$request->idEmpleado)->where('fecha','=',$fechaNueva)->where('idTipoHora','=',$th->id)->update(['cantHoras'=>$request->input($th->id.$i.'/'.$fecha->month)]);
								}
								else{
									if($request->input($th->id.$i.'/'.$fecha->month)=="00:00:00" || $request->input($th->id.$i.'/'.$fecha->month)=="00:00"){
									//existe pero le puso valor 00 entonces lo tengo que eliminar 
									$horasReg->delete();
									}									
								}
							}						
						}
						else{
							//sino la creo
							$fechaNueva=$fecha->year.'-'.$fecha->month.'-'.$i;
							if($request->input($th->id.$i.'/'.$fecha->month)!="00:00:00" && $request->input($th->id.$i.'/'.$fecha->month)!="00:00"){
								DB::table('contable_registros_horas')->insert(['idEmpleado'=>$request->idEmpleado,'idTipoHora'=>$th->id,'cantHoras'=>$request->input($th->id.$i.'/'.$fecha->month),'fecha'=>$fechaNueva]);
							}
							elseif($th->id==1 && ($request->input($th->id.$i.'/'.$fecha->month)=="00:00:00"||$request->input($th->id.$i.'/'.$fecha->month)=="00:00")){
								DB::table('contable_registros_horas')->insert(['idEmpleado'=>$request->idEmpleado,'idTipoHora'=>$th->id,'cantHoras'=>$request->input($th->id.$i.'/'.$fecha->month),'fecha'=>$fechaNueva]);							
							}
						}
					}
				}
			}
			DB::commit();
			$empleado=Empleado::find($request->idEmpleado);
			$per=Persona::find($empleado->idPersona);			
			$mes=$fecha->month;
			$anio=$fecha->year;
			return redirect()->route('reloj.listaEmpleados')->with('success', "Las marcas reloj de ".$per->nombre." ".$per->apellido." para la fecha ".$mes." / ".$anio." fueron EDITADAS correctamente.");
		}
		catch(Exception $e){
			DB::rollBack();
			return back()->withInput()->withError("Error en el sistema.");
		}
		
	}
	
	/*listado de marcas de reloj de un empleado en un mes y anio*/
	public function verMarcas(Request $request){
		try{
			$empleado=Empleado::find($request->idEmpleado);
			$fecha=new Carbon($request->mes.'-01');
			if($this->tieneMarcas($empleado,$fecha)){
				
				$esMensualHab=false;
						if($empleado->cargo->remuneracion->id==1 && $empleado->tipoHorario==1){
							$horarios=HorarioEmpleado::where('idEmpleado','=',$empleado->id)->orderBy('id', 'desc')->get();
							$esMensualHab=true;
						}
						
						$dias=Dia::All();
						$total=collect([]);
						
						for($i=1;$i<=$fecha->daysInMonth;$i++){
							$calendario =collect([]);
							$fechaActual=new Carbon($request->mes."-".$i);
							if($esMensualHab){
								$cargoDia=false;
								foreach($horarios as $hr){
								$hrFechaDesde=new Carbon($hr->fechaDesde);$hrFechaHasta=new Carbon($hr->fechaHasta);
									if($cargoDia==false && $fechaActual->between($hrFechaDesde,$hrFechaHasta)){
										foreach($dias as $dia){
											if($dia->id==$fechaActual->dayOfWeekIso){
												foreach($hr->horariosPorDia as $hd){
													if($dia->id==$hd->idDia){
														$calendario->push($dia->nombre);
														$calendario->push($i."/".$fechaActual->month);
														//NO VOY A TENER UNA SOLA HR REGISTRO EN ESA FECHA, necesito hacer un foreach ya que en es afecha puedo tener noc , per, extra,espera 
														$horasReg=RegistroHora::where('idEmpleado','=',$empleado->id)->where('fecha','=',$request->mes."-".$i)->get();
														$calendario->push($horasReg);
														switch($hd->idRegistro){
															case 1:		
																$calendario->push(" ");
																break;
															case 2:
																$calendario->push("info");
																break;
															case 3:
																$calendario->push("danger");
																break;
														}
													}
												}
											}							
										}				
										$total->push($calendario);
										$cargoDia=true;
									}
								}//cierra foreach horarios
							}
							else{
									foreach($dias as $dia){
										if($dia->id==$fechaActual->dayOfWeekIso){
											$calendario->push($dia->nombre);
											$calendario->push($i."/".$fechaActual->month);
											$horasReg=RegistroHora::where('idEmpleado','=',$empleado->id)->where('fecha','=',$request->mes."-".$i)->get();
											$calendario->push($horasReg);
										}
									}	
									$total->push($calendario);
								}
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
	
	private function tieneMarcas($empleado,$fecha){
		$tieneMarcas=false;
		if($empleado->cargo->remuneracion->id==1 && $empleado->tipoHorario==1){
				$hrReg=RegistroHora::where('idEmpleado','=',$empleado->id)->where('fecha','=',$fecha->year.'-'.$fecha->month.'-01')->first();
				if($hrReg!=null){
					$tieneMarcas=true;
				}
			}
			else{
				$i=1; 
				while($tieneMarcas==false && $i<=$fecha->daysInMonth){
					$hrReg=RegistroHora::where('idEmpleado','=',$empleado->id)->where('fecha','=',$fecha->year.'-'.$fecha->month.'-'.$i)->first();
					if($hrReg!=null){
						$tieneMarcas=true;
					}
					$i++;
				}
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
	
	
}
