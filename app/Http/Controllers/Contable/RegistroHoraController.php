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
    public function listaEmpleados(){	
		try{
			$empleados=Empleado::where("horarioCargado","=",true)->get();
			return view('contable.registrohora.listaEmpleados',['empleados'=>$empleados]);
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}		
	}
	
	public function formMarcas(Request $request){
		try{
			if($request->mes==null){
				return back()->withInput()->withError("Debe seleccionar un mes y año.");
			}
			else{
				//ver si esta dentro del contrato del empleado.
				$empleado=Empleado::where('id','=',$request->idEmpleado)->first();
				$fecha=new Carbon($request->mes."-01");
				$fDesde=new Carbon($empleado->fechaDesde);
				$fHasta=new Carbon($empleado->fechaHasta);
				if($fecha->between($fDesde,$fHasta)){
					//advertir si ya tiene cargado ese mes
					$regHora=RegistroHora::where([['idEmpleado','=',$request->idEmpleado],['fecha','=',$fecha]])->first();
					if($regHora==null){
						//1- obtener todos los horairos del empleado, 2- dia a dia ver si esta dentro de cada horario, 3- agregar a una coleccion con datos
						$dias=Dia::All();
						$total=collect([]);
						$horarios=HorarioEmpleado::where('idEmpleado','=',$empleado->id)->orderBy('id', 'desc')->get();
						//dd($horarios);
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
							}
						}
						//retorno la vista
						return view('contable.registrohora.formCargarHoras',['total'=>$total,'idEmpleado'=>$request->idEmpleado,'fecha'=>$fecha,'empleado'=>$empleado]);					
					}
					else{
						return back()->withInput()->withError("Ya existen horas cargadas de ".$empleado->persona->nombre." ".$empleado->persona->apellido." para la fecha ".$fecha->month." / ".$fecha->year.".");
					}
				}
				else{
					return back()->withInput()->withError("Debe elegir una fecha que este dentro del contrato del empleado. Contrato vigente desde ".$fDesde->toDateString()." hasta ".$fHasta->toDateString());
				}				
			}
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}
	}
	
	public function guardarMarcas(Request $request){
		try{
			$tiposHoras=TipoHora::All();
			$fecha=new Carbon($request->fecha);
			foreach($tiposHoras as $th){
				for($i=1;$i<=$fecha->daysInMonth;$i++){
					if($request->input($th->id.$i.'/'.$fecha->month)!="00:00:00"){
						$fechaNueva=$fecha->year.'-'.$fecha->month.'-'.$i;
						DB::table('contable_registros_horas')->insert(['idEmpleado'=>$request->idEmpleado,'idTipoHora'=>$th->id,'cantHoras'=>$request->input($th->id.$i.'/'.$fecha->month),'fecha'=>$fechaNueva]);
						//$regHora=new RegistroHora(['idEmpleado'=>$empleado->idEmpleado,'idTipoHora'=>$th->id,'cantHoras'=>$request->input($th->id.$i.'/'.$fecha->month),'fecha'=>$fecha]);
						//$empleado->registrosHoras()->save($regHora);		
					}
					elseif($th->id==1 && $request->input($th->id.$i.'/'.$fecha->month)=="00:00:00"){
						$fechaNueva=$fecha->year.'-'.$fecha->month.'-'.$i;
						DB::table('contable_registros_horas')->insert(['idEmpleado'=>$request->idEmpleado,'idTipoHora'=>$th->id,'cantHoras'=>$request->input($th->id.$i.'/'.$fecha->month),'fecha'=>$fechaNueva]);
					}
				}
			}
			/*$todo=DB::table('contable_registros_horas')->where('idEmpleado','=',$request->idEmpleado)->get();
			return 'todo ok';*/
			$empleado=Empleado::find($request->idEmpleado);
			$per=Persona::find($empleado->idPersona);			
			$mes=$fecha->month;
			$anio=$fecha->year;
			return redirect()->route('reloj.listaEmpleados')->with('success', "Las marcas reloj de ".$per->nombre." ".$per->apellido." para la fecha ".$mes." / ".$anio." fueron ingresadas correctamente.");			
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}
	}
	
	public function editarMes(Request $request){
		try{
			if($request->mes==null){
				return back()->withInput()->withError("Debe seleccionar un mes y año.");
			}
			else{
				$fecha=new Carbon($request->mes."-1");
				$registrosHoras=DB::table('contable_registros_horas')
					->where('idEmpleado','=',$request->empId)
					->whereBetween('fecha',[$fecha->year.'-'.$fecha->month.'-1',$fecha->year.'-'.$fecha->month.'-'.$fecha->daysInMonth])
					->get();				
				if($registrosHoras->isNotEmpty()){
					$idHorario=HorarioEmpleado::where('idEmpleado','=',$request->empId)->min('id');
					$horariosPorDia=HorarioPorDia::where('idHorarioEmpleado','=',$idHorario)->get();
					
					$dias=Dia::All();
					
					$total=collect([]);
					foreach($registrosHoras as $rh){
						$calendario =collect([]);
						$fechaBd=new Carbon($rh->fecha);
						foreach($dias as $dia){
							if($dia->id==$fechaBd->dayOfWeekIso){
								foreach($horariosPorDia as $hr){
									if($dia->id==$hr->idDia){
										$calendario->push($dia->nombre);
										switch($hr->idRegistro){
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
										$calendario->push($rh);
									}
								}
							}							
						}
						$total->push($calendario);
					}
					//dd($total);
					//return view('contable.registrohora.formEditarHoras',['total'=>$total,'idEmpleado'=>$request->empId]);
				}
				else{
					$empleado=Empleado::where('id','=',$request->empId)->first();
					$per=Persona::find($empleado->idPersona);
					return back()->withInput()->withError("No hay marcas reloj ingresadas para ".$per->nombre." ".$per->apellido." en la fecha: ".$fecha->month." / ".$fecha->year);
			
				}
			}
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}
	}

	public function compruebaMeses($idEmpleado,$fecha){
		
		
		
	}
}
