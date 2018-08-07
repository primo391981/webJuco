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
				return back()->withInpush()->withError("Debe seleccionar un mes y año.");
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
					return back()->withInpush()->withError("Ya existen horas cargadas para ese mes y año.");
				}
			}
		}
		catch(Exception $e){
			return back()->withInpush()->withError("Error en el sistema.");
		}
	}
	
	public function guardarMarcas(Request $request){
		try{
			$tiposHoras=TipoHora::All();
			$fecha=new Carbon($request->fecha);
			foreach($tiposHoras as $th){
				for($i=1;$i<=$fecha->daysInMonth;$i++){
				$fechaNueva=$fecha->year.'-'.$fecha->month.'-'.$i;
				DB::table('contable_registros_horas')->insert(['idEmpleado'=>$request->idEmpleado,'idTipoHora'=>$th->id,'cantHoras'=>$request->input($th->id.$i.'/'.$fecha->month),'fecha'=>$fechaNueva]);
					//$regHora=new RegistroHora(['idEmpleado'=>$empleado->idEmpleado,'idTipoHora'=>$th->id,'cantHoras'=>$request->input($th->id.$i.'/'.$fecha->month),'fecha'=>$fecha]);
					//$empleado->registrosHoras()->save($regHora);					
				}
			}
			$todo=DB::table('contable_registros_horas')->where('idEmpleado','=',$request->idEmpleado)->get();
			dd($todo);
			return 'todo ok';
		}
		catch(Exception $e){
			return back()->withInpush()->withError("Error en el sistema.");
		}
	}
}
