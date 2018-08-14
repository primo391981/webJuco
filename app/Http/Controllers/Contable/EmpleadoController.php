<?php

namespace App\Http\Controllers\Contable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contable\Cargo;
use App\Contable\Dia;
use App\Contable\Registro;
use App\Persona;
use App\Empresa;
use App\Contable\Empleado;

use App\Contable\HorarioEmpleado;
use App\Contable\HorarioPorDia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class EmpleadoController extends Controller
{
	public function formCrear($idPer){
		
		$persona=Persona::find($idPer);
		$empresas=Empresa::All();
		$emprAsociadas=$persona->empresas;
		//me tira las empresas diferentes entre todas las empresas y empresas asociadas
		$emprSinAsociar=$empresas->diff($emprAsociadas);
		$cargos=Cargo::All();	
		return view('contable.empleado.asociarEmpresa',['cargos'=>$cargos,'emprSinAsociar'=>$emprSinAsociar,'persona'=>$persona]);
		
	}

    public function asociarEmpresa(Request $request,$idPer){
		try{
			if($request->idempresa==null){
				return back()->withInput()->withError("Debe seleccionar una empresa.");
			}
			else{
				if($request->fechaInicio>$request->fechaFin){
					return back()->withInput()->withError("La fecha de fin debe ser mayor a la fecha de inicio.");
				} else {
					$empresa=Empresa::find($request->idempresa);
					$persona=Persona::find($idPer);
					
					$persona->empresas()->save($empresa, ['idCargo'=>$request->cargo,'fechaDesde'=>$request->fechaInicio,'fechaHasta'=>$request->fechaFin,'monto'=>$request->monto,'valorHora'=>$request->valorhr]);
					return redirect()->route('persona.show',['id' => $idPer]);
				}
			}
		}
		catch(Exception $e){
			return back()->withInput()->withError($e->getMessage());
		}
		
	}
	
	public function formCargarHorario($idEmpleado){
		$dias=Dia::All();
		$registros=Registro::All();
		$empleado=Empleado::find($idEmpleado);
		//dd($empleado->fechaDesde);
		return view('contable.empleado.cargarHorario',['dias'=>$dias,'idEmpleado'=>$idEmpleado,'registros'=>$registros,'empleado'=>$empleado]);
	}
	
	public function cargarHorario(Request $request){
		try{
			if($request->fechaDesde>$request->fechaHasta){
				return back()->withInput()->withError("La fecha de fin debe ser mayor a la fecha de inicio.");
				//if($request->fechaDesde==null or $request->fechaHasta==null){
			}
			else{
				$horarioEmp=new HorarioEmpleado;
				$horarioEmp->idEmpleado=$request->idEmpleado;
				$horarioEmp->fechaDesde=$request->fechaDesde;
				$horarioEmp->fechaHasta=$request->fechaHasta;
				$horarioEmp->save();
				
				$idHorarioEmp = DB::table('contable_horarios_empleados')->max('id');	
				
				$dias=Dia::All();
				foreach($dias as $dia){
					
					$hrDia=new HorarioPorDia;
					$hrDia->idHorarioEmpleado=$idHorarioEmp;
					
					$nomCantHora="hr".$dia->id;
					$nomReg="reg".$dia->id;
					
					$hrDia->idRegistro=$request->$nomReg;
					$hrDia->idDia=$dia->id;
					$hrDia->cantHoras=$request->$nomCantHora;
					
					$hrDia->save();
				}

				$idPer = DB::table('contable_empleados')->where('id',$request->idEmpleado)->value('idPersona');
			
				DB::table('contable_empleados')->where('id',$request->idEmpleado)->update(['horarioCargado' => true]);

				return redirect()->action('PersonaController@show', ['id' => $idPer]);
				//return redirect()->action('PersonaController@index');
			
			}
		}
		catch(Exception $e){			
			return back()->withInput()->withError("Error en el sistema.");
		}
	}
	
	public function editHorarioPrincipal($idEmpleado,$idHorarioPrincipal){
		try{
			//return $idEmpleado." / ".$idHorarioPrincipal;
			$horarioPrincipal=HorarioEmpleado::where('id','=',$idHorarioPrincipal)->where('idEmpleado','=',$idEmpleado)->first();
			$registros =Registro::All();
			$dias=Dia::All();
			return view('contable.empleado.editarHorario',['registros'=>$registros,'horarioPrincipal'=>$horarioPrincipal,'dias'=>$dias]);
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
	}
	
	public function guardarHorarioPrin(Request $request){
		try{
			//dd($request);
			$dias=Dia::All();
			foreach($dias as $dia){
				HorarioPorDia::where('idHorarioEmpleado','=',$request->idHorarioEmp)
				->where('idDia','=',$dia->id)
				->update(['idRegistro' =>$request->input('reg'.$dia->id),'cantHoras'=>$request->input($dia->id)]);
			}
			$hrEmp=HorarioEmpleado::where('id','=',$request->idHorarioEmp)->first();
			$per=$hrEmp->empleado->persona;
			return redirect()->action('PersonaController@show', ['id' => $per->id]);
			
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
	}
	
	public function formHorarioEspecial(Request $request){
		try{
			if($request->fechaDesde>=$request->fechaHasta){
				return back()->withInput()->withError("Fecha de inicio debe ser menor a la fecha final.");
			}
			else{
				$fechaDesde=new Carbon($request->fechaDesde);
				$fechaHasta=new Carbon($request->fechaHasta);
				if($fechaDesde->diffInDays($fechaHasta)>=6){
					
					//me fijo si tiene contrato entre esas fechas
					$empleado=Empleado::where('id','=',$request->idEmpleado)->first();
					$fInicioContrato=new Carbon($empleado->fechaDesde);
					$fFinContrato=new Carbon($empleado->fechaHasta);
					if($fechaDesde->between($fInicioContrato,$fFinContrato) && $fechaHasta->between($fInicioContrato,$fFinContrato)){
						$horarioPrincipal=$empleado->horarios->first();
						$registros =Registro::All();
						$dias=Dia::All();
						return view('contable.empleado.formHorarioEspecial',['registros'=>$registros,'horarioPrincipal'=>$horarioPrincipal,'dias'=>$dias,'fechaDesde'=>$request->fechaDesde,'fechaHasta'=>$request->fechaHasta,'idEmpleado'=>$empleado->id]);
					}
					else{
						return back()->withInput()->withError("Las fechas seleccionadas deben estar dentro del contrato del empleado ".$fInicioContrato->toDateString()." y ".$fFinContrato->toDateString());
					}
				}
				else{
					return back()->withInput()->withError("Debe existir una mínima difernecia de 6 días.");
				}
			}
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
	}

	public function guardarHorarioEsp(Request $request){
		try{
			$dias=Dia::All();
			$empleado=Empleado::find($request->idEmpleado);
			$horariosEmpleado=$empleado->horarios;
			$editar=false;
			foreach($horariosEmpleado as $horario){
				if($horario->fechaDesde== $request->fechaDesde && $horario->fechaHasta== $request->fechaHasta){
					$editar=true;
					foreach($dias as $dia){					
						$nomCantHora="hr".$dia->id;
						$nomReg="reg".$dia->id;
						HorarioPorDia::where('idDia','=',$dia->id)->where('idHorarioEmpleado','=',$horario->id)
						->update(['idRegistro' =>$request->$nomReg,'cantHoras'=>$request->$nomCantHora]);
					}
				}
			}			
			if($editar==false){
				$horarioEmpleado= new HorarioEmpleado;				
				$horarioEmpleado->idEmpleado=$request->idEmpleado;
				$horarioEmpleado->fechaDesde= $request->fechaDesde;
				$horarioEmpleado->fechaHasta=$request->fechaHasta;
				$horarioEmpleado->save();
				$idHorarioEmp = DB::table('contable_horarios_empleados')->max('id');	
				
				foreach($dias as $dia){
					
					$hrDia=new HorarioPorDia;
					$hrDia->idHorarioEmpleado=$idHorarioEmp;
					
					$nomCantHora="hr".$dia->id;
					$nomReg="reg".$dia->id;
					
					$hrDia->idRegistro=$request->$nomReg;
					$hrDia->idDia=$dia->id;
					$hrDia->cantHoras=$request->$nomCantHora;					
					$hrDia->save();
				}								
    		}
			return redirect()->action('PersonaController@show', ['id' => $empleado->idPersona])->withInput()->with('success',"El horario especial en ".$empleado->empresa->nombreFantasia." en las fechas ".$request->fechaDesde." y ".$request->fechaHasta." fue ingresado correctamente.");
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}		
	}
}
