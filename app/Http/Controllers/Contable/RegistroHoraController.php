<?php

namespace App\Http\Controllers\Contable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contable\Empleado;
use App\Persona;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RegistroHoraController extends Controller
{
    public function listaEmpleados()
    {	
		$empleados=Empleado::All();
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
				$regHora=DB::table('registrosHoras')
				->where('idEmpleado','=',$request->empId)
				->where('fecha','=',$fecha)
				->select('registrosHoras.*')
				->first();
				if($regHora==null){
					$empleado=Empleado::find($request->empId);
					dd($empleado);
					return view('contable.registrohora.formCargarHoras',[]);
				}else{
					return back()->withInput()->withError("Ya existen horas cargadas para ese mes y año.");
				}
			}
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}
	}
	
}
