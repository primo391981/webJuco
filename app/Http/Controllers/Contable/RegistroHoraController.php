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
							
							$guardarMarca=false;
							if($th->id==1){
								$guardarMarca=true;
							}
							else{
								if($request->input($th->id.$i.'/'.$fecha->month)!="00:00:00" && $request->input($th->id.$i.'/'.$fecha->month)!="00:00"){
									$guardarMarca=true;
								}								
							}
							
							if($guardarMarca){
								$registroHora->cantHoras=$request->input($th->id.$i.'/'.$fecha->month);
								$registroHora->idTipoHora=$th->id;
								
								if($empleado->tipoHorario==2 || $empleado->cargo->remuneracion->id==2 ){
									$registroHora->tipoDia=$request->input('radio'.$i.'/'.$fecha->month);	
								}
								$registroHora->save();
							}						
					}
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
	
	/*muestra formulario de edicion de maracas de reloj de un empleado en un mes y anio dado*/
	public function editarMes(Request $request){
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
											
											foreach($horasReg as $hr){
													switch($hr->tipoDia){
															case 'c':		
																$calendario->push(" ");
																break;
															case 'm':
																$calendario->push("info");
																break;
															case 'd':
																$calendario->push("danger");
																break;
												}
												break;//break foreach;
											}
											
										}
									}	
									$total->push($calendario);
								}
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

	/*Guarda las marcas de reloj editadas para un empleado en un mes y anio dado*/
	public function guardarMarcasEdit(Request $request){
		DB::beginTransaction();
		try{
			$tiposHoras=TipoHora::All();			
			$fecha=new Carbon($request->fecha);
			$empleado=Empleado::find($request->idEmpleado);
			
			for($i=1;$i<=$fecha->daysInMonth;$i++){
				foreach($tiposHoras as $th){
					
					if($request->input($th->id.$i.'/'.$fecha->month)!=null){//por si es null el valor nocturnidad pernocte espera
						
						$horasReg=RegistroHora::where('idEmpleado','=',$request->idEmpleado)->where('fecha','=',$fecha->year.'-'.$fecha->month.'-'.$i)->where('idTipoHora','=',$th->id)->first();
						if($horasReg!=null){
							//si existe actualizo
							$fechaNueva=$fecha->year.'-'.$fecha->month.'-'.$i;
							if($request->input($th->id.$i.'/'.$fecha->month)!="00:00:00" && $request->input($th->id.$i.'/'.$fecha->month)!="00:00"){
								
								RegistroHora::where('idEmpleado','=',$request->idEmpleado)->where('fecha','=',$fechaNueva)->where('idTipoHora','=',$th->id)->update(['cantHoras'=>$request->input($th->id.$i.'/'.$fecha->month)]);	
								if($empleado->tipoHorario==2 || $empleado->cargo->remuneracion->id==2 ){
									RegistroHora::where('idEmpleado','=',$request->idEmpleado)->where('fecha','=',$fechaNueva)->where('idTipoHora','=',$th->id)->update(['tipoDia'=>$request->input('radio'.$i.'/'.$fecha->month)]);	
								}
							}
							else{
								if($horasReg->idTipoHora==1 && ($request->input($th->id.$i.'/'.$fecha->month)=="00:00:00" || $request->input($th->id.$i.'/'.$fecha->month)=="00:00")){
									RegistroHora::where('idEmpleado','=',$request->idEmpleado)->where('fecha','=',$fechaNueva)->where('idTipoHora','=',$th->id)->update(['cantHoras'=>$request->input($th->id.$i.'/'.$fecha->month)]);
									if($empleado->tipoHorario==2 || $empleado->cargo->remuneracion->id==2 ){
										RegistroHora::where('idEmpleado','=',$request->idEmpleado)->where('fecha','=',$fechaNueva)->where('idTipoHora','=',$th->id)->update(['tipoDia'=>$request->input('radio'.$i.'/'.$fecha->month)]);	
									}
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
							//sino lo tengo que crear
							$fechaNueva=$fecha->year.'-'.$fecha->month.'-'.$i;
							if($request->input($th->id.$i.'/'.$fecha->month)!="00:00:00" && $request->input($th->id.$i.'/'.$fecha->month)!="00:00"){
								DB::table('contable_registros_horas')->insert(['idEmpleado'=>$request->idEmpleado,'idTipoHora'=>$th->id,'cantHoras'=>$request->input($th->id.$i.'/'.$fecha->month),'fecha'=>$fechaNueva]);
								if($empleado->tipoHorario==2 || $empleado->cargo->remuneracion->id==2 ){
									RegistroHora::where('idEmpleado','=',$request->idEmpleado)->where('fecha','=',$fechaNueva)->where('idTipoHora','=',$th->id)->update(['tipoDia'=>$request->input('radio'.$i.'/'.$fecha->month)]);	
								}
							}
							elseif($th->id==1 && ($request->input($th->id.$i.'/'.$fecha->month)=="00:00:00"||$request->input($th->id.$i.'/'.$fecha->month)=="00:00")){
								DB::table('contable_registros_horas')->insert(['idEmpleado'=>$request->idEmpleado,'idTipoHora'=>$th->id,'cantHoras'=>$request->input($th->id.$i.'/'.$fecha->month),'fecha'=>$fechaNueva]);	
								if($empleado->tipoHorario==2 || $empleado->cargo->remuneracion->id==2 ){
									RegistroHora::where('idEmpleado','=',$request->idEmpleado)->where('fecha','=',$fechaNueva)->where('idTipoHora','=',$th->id)->update(['tipoDia'=>$request->input('radio'.$i.'/'.$fecha->month)]);	
								}
							}
						}
						
					}
				}
			}
			DB::commit();
			return redirect()->route('reloj.listaEmpleados')->with('success', "Las marcas reloj de ".$empleado->persona->nombre." ".$empleado->persona->apellido." para la fecha ".$fecha->month." / ".$fecha->year." fueron EDITADAS correctamente.");			
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
											
											foreach($horasReg as $hr){
													switch($hr->tipoDia){
															case 'c':		
																$calendario->push(" ");
																break;
															case 'm':
																$calendario->push("info");
																break;
															case 'd':
																$calendario->push("danger");
																break;
												}
												break;//break foreach;
											}
											
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
