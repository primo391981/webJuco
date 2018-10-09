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
	/*formulario para la asociacion de un empleado a una empresa junto con los datos de contrato*/
	public function formCrear($idPer){
		$persona=Persona::find($idPer);
		$empresas=Empresa::All();
		$emprAsociadas=$persona->empresas()->where('habilitado', 1)->get();
		//me tira las empresas diferentes entre todas las empresas y empresas asociadas
		$emprSinAsociar=$empresas->diff($emprAsociadas);
		$cargos=Cargo::All();	
		return view('contable.empleado.asociarEmpresa',['cargos'=>$cargos,'emprSinAsociar'=>$emprSinAsociar,'persona'=>$persona]);
		
	}

	/*Guarda la asociacion de un empleado a una empresa junto con sus datos contrato*/
    public function asociarEmpresa(Request $request,$idPer){
		try{
			
			if($request->idempresa==null){
				return back()->withInput()->withError("Debe seleccionar una empresa.");
			}
			else{
				
				$fechaFin='2118-01-01';
				if($request->fechaFin!=null){
					if($request->fechaInicio>$request->fechaFin){
						return back()->withInput()->withError("La fecha de fin debe ser mayor a la fecha de inicio.");
					}
					$fechaFin=$request->fechaFin;
				}
				
				 	$empresa=Empresa::find($request->idempresa);
					$persona=Persona::find($idPer);
					
					$noc=false;
					$per=false;
					$esp=false;
					if($request->per=='on'){
						$per=true;
					}
					if($request->noc=='on'){
						$noc=true;
					}
					if($request->esp=='on'){
						$esp=true;
					}
					
					//si empresa seleccionado grupo ==12 sn/200 else sn/30/8
					
					$cargo=Cargo::find($request->cargo);
					$valorHr=0;
					
					if($cargo->id_remuneracion==1){
						if($empresa->grupo==12){
							$valorHr=$request->monto/200;
						}
						else{
							$valorHr=($request->monto/30)/8;
						}
					}
					else{
						$valorHr=$request->monto/8;
					}
					
					$persona->empresas()->save($empresa, ['idCargo'=>$request->cargo,'fechaDesde'=>$request->fechaInicio,'fechaHasta'=>$fechaFin,'monto'=>$request->monto,'valorHora'=>$valorHr,'nocturnidad'=>$noc,'pernocte'=>$per,'espera'=>$esp,'tipoHorario'=>$request->tipo]);
					return redirect()->route('persona.show',['id' => $idPer]);
				
			}
		}
		catch(Exception $e){
			return back()->withInput()->withError($e->getMessage());
		}
		
	}
	
	/*formulario de creacion de un horario principal de un empleado en la empresa*/
	public function formCargarHorario($idEmpleado){
		$dias=Dia::All();
		$registros=Registro::All();
		$empleado=Empleado::find($idEmpleado);
		//dd($empleado->fechaDesde);
		return view('contable.empleado.cargarHorario',['dias'=>$dias,'idEmpleado'=>$idEmpleado,'registros'=>$registros,'empleado'=>$empleado]);
	}
	
	/*Guarada el horario principal de un empleado en la empresa*/
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
	
	/*formulario de edicion del horario principal de un empelado en la empresa*/
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
	
	/*Guarada horario principal de un empleado en la empresa*/
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
	
	/*formulario para la creacion de un horario especual de un empleado en la empresa*/
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

	/*Guardar horario especial de un empleado en empresa*/
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
	/*Listado de los horarios especiales por empleado en la empresa*/
	public function verHorariosEsp($idEmpleado){
		try{
			$horarios=HorarioEmpleado::where('idEmpleado','=',$idEmpleado)->orderBy('id', 'desc')->get();
			return $horarios;
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
	}
	
	public function borrarHorarioEsp(Request $request){
		try{
			$horario=HorarioEmpleado::where('idEmpleado','=',$request->idEmpleado)->first();
			if($horario->id==$request->idHorario){
				return back()->withInput()->withError("El horario principal no se puede eliminar.");
			}
			else{
				 HorarioPorDia::where('idHorarioEmpleado', $request->idHorario)->delete();
				 HorarioEmpleado::where('id', $request->idHorario)->delete();
				 $empleado=Empleado::find($request->idEmpleado);
				 return redirect()->action('PersonaController@show', ['id' => $empleado->idPersona])->withInput()->with('success',"El horario especial fue borrado correctamente.");
			}
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
		
	}
	
	public function desvincularEmpresa(Request $request){
		try{		
			$empleado=Empleado::find($request->idEmpleado);
			$persona = Persona::find($empleado->idPersona);
			$persona->empresas()->updateExistingPivot($empleado->idEmpresa,['habilitado'=>0, 'fechaBaja'=>$request->fecha, 'idMotivo'=>$request->motivo]);
					
			return redirect()->action('PersonaController@show', ['id' => $empleado->idPersona])->withInput()->with('success','La desvinculación de la empresa '.$empleado->empresa->nombreFantasia.' se realizó correctamente.');
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
	}
	
	public function search(Request $request)
    {
		if(!is_null($request->rut))
		{
			$rut = $request->rut;
			$empresa = Empresa::where("rut", "=", $rut)->first();
			
			$personas = $empresa->personas;
		}
			
		if($request->ajax()) {
				return response()->json([
					'personas' => $personas
				]);
			}
    }
	
	public function editarContrato($idEmpleado){
		try{
			$empleado=Empleado::find($idEmpleado);
			$cargos=Cargo::All();
			return view('contable.empleado.editarContrato',['cargos'=>$cargos,'empleado'=>$empleado]);
			
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
	}
	
	public function guardarEditContrato(Request $request){
		try{		
			$fechaFin='2118-01-01';
			if($request->fechaFin!=null){
				if($request->fechaInicio>$request->fechaFin){
					return back()->withInput()->withError("La fecha de fin debe ser mayor a la fecha de inicio.");
				}
				$fechaFin=$request->fechaFin;
			}
				
			$noc=false;
			$per=false;
			$esp=false;
			if($request->per=='on'){
				$per=true;
			}
			if($request->noc=='on'){
				$noc=true;
			}
			if($request->esp=='on'){
				$esp=true;
			}
			
			//si empresa seleccionado grupo ==12 sn/200 else sn/30/8
			
			$cargo=Cargo::find($request->cargo);
			$empleado=Empleado::find($request->idEmpleado);
			$valorHr=0;
			
			if($cargo->id_remuneracion==1){
				if($empleado->empresa->grupo==12){
					$valorHr=$request->monto/200;
				}
				else{
					$valorHr=($request->monto/30)/8;
				}
			}
			else{
				$valorHr=$request->monto/8;
			}
			
			$persona = Persona::find($empleado->idPersona);
			$persona->empresas()->updateExistingPivot($empleado->id,['idCargo'=>$cargo->id,'fechaDesde'=>$request->fechaInicio,'fechaHasta'=>$fechaFin,'monto'=>$request->monto,'valorHora'=>$valorHr,'nocturnidad'=>$noc,'pernocte'=>$per,'espera'=>$esp,'tipoHorario'=>$request->tipo]);
			
			return redirect()->route('persona.show',['id' => $empleado->persona->id]);
		
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
	}
	
}
