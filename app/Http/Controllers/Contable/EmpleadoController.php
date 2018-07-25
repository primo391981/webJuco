<?php

namespace App\Http\Controllers\Contable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contable\Cargo;
use App\Persona;
use App\Empresa;

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
	public function desasociarEmpresa(Request $request,$idPer,$idEmp){
		dd($request);
		
	}
	
	public function horarioTrabajo(Request $request,$idPer,$idEmp){
		dd($request);
	}
}
