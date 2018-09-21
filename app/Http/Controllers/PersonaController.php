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
use App\Contable\Registro;
use App\EstadoCivil;
use App\Contable\HorarioEmpleado;
use App\Contable\HorarioPorDia;
use App\Contable\BajaMotivo;
use Carbon\Carbon;

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
		$persona->nombre=strtoupper($request->input('nombre'));
		$persona->apellido=strtoupper($request->input('apellido'));
		$persona->domicilio=strtoupper($request->input('domicilio'));
		$persona->telefono=$request->input('telefono');
		$persona->email=$request->input('email');
		$persona->cantHijos=$request->input('cantHijos');		
		$persona->estadoCivil=$request->input('estadoCivil');		
		$persona->conDiscapacidad=$request->input('conDiscapacidad');	
		$persona->nacionalidad=strtoupper($request->input('nacionalidad'));
		$fecha=new Carbon($request->input('fechaNacimiento'));
		$persona->fechaNacimiento=$fecha->year.'-'.$fecha->month.'-'.$fecha->day;
		$persona->pagoNombre=strtoupper($request->input('pagoNombre'));
		$persona->pagoNumero=$request->input('pagoNumero');
		$persona->departamento=strtoupper($request->input('departamento'));
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
			$dias=Dia::All();
			$registros=Registro::All();
			$motivos=BajaMotivo::All();
			
			return view('contable.persona.verPersona',['persona'=>$persona,'dias'=>$dias,'registros'=>$registros,'bajaMotivos'=>$motivos]);
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
		$persona->conDiscapacidad=$request->input('conDiscapacidad');		
		
		$persona->save();
		return redirect()->route('persona.index');
    }
	
    public function destroy($id)
    {
       
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
