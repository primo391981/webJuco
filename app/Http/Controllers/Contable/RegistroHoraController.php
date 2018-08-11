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
    public function listaEmpleados()
    {	
		$empleados=Empleado::where("horarioCargado","=",true)->get();
		return view('contable.registrohora.listaEmpleados',['empleados'=>$empleados]);
    }
	public function compruebaMes(Request $request){
		try{
			if($request->mes==null){
				return back()->withInput()->withError("Debe seleccionar un mes y año.");
			}
			else{
				//si ya lo tiene cargado advertir
				$fecha=$request->mes."-01";		
				$regHora=RegistroHora::where([['idEmpleado','=',$request->empId],['fecha','=',$fecha]])->first();
				if($regHora==null){
					$idHorario=HorarioEmpleado::where('idEmpleado','=',$request->empId)->min('id');
					$horariosPorDia=HorarioPorDia::where('idHorarioEmpleado','=',$idHorario)->get();
					
					$dt=new Carbon($fecha);
					$dias=Dia::All();
					
					$total=collect([]);
					for($i=1;$i<=$dt->daysInMonth;$i++){
						$calendario =collect([]);
						$aux=new Carbon($fecha=$request->mes."-".$i);
						foreach($dias as $dia){
							if($dia->id==$aux->dayOfWeekIso){
								foreach($horariosPorDia as $hr){
									if($dia->id==$hr->idDia){
										$calendario->push($dia->nombre);
										$calendario->push($i."/".$aux->month);
										$calendario->push($hr->cantHoras);
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
									}
								}
							}							
						}				
						$total->push($calendario);
					}
				
					return view('contable.registrohora.formCargarHoras',['total'=>$total,'idEmpleado'=>$request->empId,'fecha'=>$dt]);
				}else{
					$empleado=Empleado::find($request->empId);
					$per=Persona::find($empleado->idPersona);			
					$faux=new Carbon($request->mes);
					$mes=$faux->month;
					$anio=$faux->year;
					return back()->withInput()->withError("Ya existen horas cargadas de ".$per->nombre." ".$per->apellido." para la fecha ".$mes." / ".$anio.".");
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
}
