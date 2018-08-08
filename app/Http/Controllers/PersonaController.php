<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Persona;
use App\Empresa;
use App\Contable\Empleado;
use App\TipoDoc;
use App\Contable\Cargo;
use App\Contable\Dia;
use App\EstadoCivil;
use App\Contable\HorarioEmpleado;
use App\Contable\HorarioPorDia;

use Exception;

use App\Http\Requests\PersonaRequest;
use App\Http\Controllers\Controller;

class PersonaController extends Controller
{
    public function index()
    {
		$personas=Persona::All();
		return view('contable.persona.listaPersonas', ['personas' => $personas]);
    }
    
    public function create()
    {
		$tiposDocumentos=TipoDoc::All();
		$estados = EstadoCivil::All();
		return view('contable.persona.agregarPersona',['tiposdoc'=>$tiposDocumentos, 'estados'=>$estados]);
    }
	
	
    public function store(PersonaRequest $request)
    {
		$persona=new Persona;
		$persona->tipoDocumento = $request->input('tipodoc');		
		$persona->documento=$request->input('documento');
		$persona->nombre=$request->input('nombre');
		$persona->apellido=$request->input('apellido');
		$persona->domicilio=$request->input('domicilio');
		$persona->telefono=$request->input('telefono');
		$persona->email=$request->input('email');
		$persona->cantHijos=$request->input('cantHijos');		
		$persona->estadoCivil=$request->input('estadoCivil');		
		try{
			$persona->save();
			return redirect()->route('persona.index')->with('success', "El empleado ".$persona->tipoDoc->nombre." - ".$persona->documento." se agregó correctamente.");
		}
		catch(Exception $e){
			
			if($e->getCode()==23000){
				return back()->withInput()->withError("Ya existe un empleado con ese tipo de documento y documento.");
			}else{
				return back()->withInput()->withError("El empleado no se pudo registrar, intente nuevamente o contacte al administrador.");
			}
		}		
    }

    public function show($id)
    {		
		try{
			$persona=Persona::find($id);
			$emprAsociadas=$persona->empresas;
			$cargos=Cargo::All();
			$dias=Dia::All();
			$collectionHorariosPorDia = collect([]);
			if($emprAsociadas->isNotEmpty()){

			foreach($emprAsociadas as $empr){
					
					if($empr->pivot->horarioCargado==true){

						$menorId = DB::table('contable_horarios_empleados')->where('idEmpleado','=',$empr->pivot->id)->min('id');

						//con el menor id join contable_horarios_por_dia
						$horariosPorDIa=DB::table('contable_horarios_empleados')
						->join('contable_horarios_por_dia','contable_horarios_empleados.id','contable_horarios_por_dia.idHorarioEmpleado')
						->where('contable_horarios_por_dia.idHorarioEmpleado','=',$menorId)
						//->where('horariosPorDia.idHorarioEmpleado','=',$menorId)
						->select('contable_horarios_por_dia.*')
						->get();
						
						$collectionHorariosPorDia->put($empr->pivot->id,$horariosPorDIa);
					}
				}
			}
			return view('contable.persona.verPersona',['persona'=>$persona,'emprAsociadas'=>$emprAsociadas,'cargos'=>$cargos,'dias'=>$dias,'collectionHorariosPorDia'=>$collectionHorariosPorDia]);
		}
		catch(Exception $e){
			return back()->withInput()->withError("Problemas en el sistema, intente nuevamente o contacte al administrador.");
		}
	}

    public function edit($id)
    {
        $persona=Persona::find($id);
		$tiposDocumentos=TipoDoc::All();
		$estados = EstadoCivil::All();
		
		return view('contable.persona.editarPersona',['persona'=>$persona, 'tiposdoc'=>$tiposDocumentos, 'estados'=>$estados]);
    }

    public function update(PersonaRequest $request, $id)
    {
        $persona=Persona::find($id);		
		$persona->documento=$request->input('documento');
		$persona->nombre=$request->input('nombre');
		$persona->apellido=$request->input('apellido');
		$persona->domicilio=$request->input('domicilio');
		$persona->telefono=$request->input('telefono');
		$persona->email=$request->input('email');
		$persona->cantHijos=$request->input('cantHijos');		
		$persona->estadoCivil=$request->input('estadoCivil');		
		$persona->save();
		return redirect()->route('persona.index');
    }
	
    public function destroy($id)
    {
        $persona=Persona::find($id);
		$persona->delete();
		
		return redirect()->route('persona.index');
    }
	public function restaurar($id)
    {
		$persona= Persona::onlyTrashed()->where('id',$id);			
		$persona->restore();
		return redirect()->route('persona.index');
    }
		public function desactivado()
    {
       $personas=Persona::onlyTrashed()->get();
	   return view('contable.persona.listaNoPersonas', ['personas' => $personas]);
	   //este es el camino de las carpetas hasta llegar al blade correspondiente
    }

}
