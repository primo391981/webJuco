<?php

namespace App\Http\Controllers\Contable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contable\Cargo;
use App\Contable\Dia;
use App\Contable\Registro;
use App\Persona;
use App\Empresa;
use App\Contable\HorarioEmpleado;
use App\Contable\HorarioPorDia;
use Illuminate\Support\Facades\DB;


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
					
					$persona->empresas()->save($empresa, ['idCargo'=>$request->cargo,'fechaDesde'=>$request->fechaInicio,'fechaHasta'=>$request->fechaFin,'monto'=>$request->monto]);
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
		return view('contable.empleado.cargarHorario',['dias'=>$dias,'idEmpleado'=>$idEmpleado,'registros'=>$registros]);
	}
	public function cargarHorario(Request $request){
		try{			
			if($request->fechaDesde>$request->fechaHasta){
				return back()->withInput()->withError("La fecha de fin debe ser mayor a la fecha de inicio.");
			}
			else{
				$horarioEmp=new HorarioEmpleado;
				$horarioEmp->idEmpleado=$request->idEmpleado;
				$horarioEmp->fechaDesde=$request->fechaDesde;
				$horarioEmp->fechaHasta=$request->fechaHasta;
				$horarioEmp->save();
				$idHorarioEmp = DB::table('horariosEmpleados')->max('id');				
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
				$idPer = DB::table('empleados')->where('id',$request->idEmpleado)->value('idPersona');
				DB::table('empleados')->where('id',$request->idEmpleado)->update(['horarioCargado' => true]);
				return redirect()->action('PersonaController@show', ['id' => $idPer]);
				//return redirect()->action('PersonaController@index');
			
			}
		}
		catch(Exception $e){			
			return back()->withInput()->withError("Error en el sistema.");
		}
	}
	
	public function desasociarEmpresa(Request $request,$idPer,$idEmp){
		dd($request);
		
	}
	
	public function horarioTrabajo(Request $request,$idPer,$idEmp){
		dd($request);
	}
}
