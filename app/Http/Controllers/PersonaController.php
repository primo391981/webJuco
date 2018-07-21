<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Persona;
use App\Empresa;
use App\Contable\Empleado;
use App\TipoDoc;
use App\Contable\Cargo;
use App\EstadoCivil;
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
        $persona=Persona::find($id);
		$empresas=Empresa::All();
		$emprAsociadas=$persona->empresas;
		//me tira las empresas diferentes entre todas las empresas y empresas asociadas
		$emprSinAsociar=$empresas->diff($emprAsociadas);
		$cargos=Cargo::All();
		
		return view('contable.persona.verPersona',['persona'=>$persona,'emprSinAsociar'=>$emprSinAsociar,'emprAsociadas'=>$emprAsociadas,'cargos'=>$cargos]);
    }
	public function asociarEmpresa(Request $request, $idper, $idempr)
	{
		try{
			
			$fHasta =\Carbon\Carbon::parse($request->fechaHasta)->format('Y/m/d');
			$fDesde =\Carbon\Carbon::parse($request->fechaDesde)->format('Y/m/d');
			
			
			if($fHasta>$fDesde){
				dd($request->input('fechaHasta'));
				return back()->withInput()->withError("La fecha de fin debe ser mayor a la fecha de inicio.");
			}else{
			$empresa=Empresa::find($idempr);
			dd($idempr);
			$persona=Persona::find($idper);
			$persona->empresas()->save($empresa, ['idCargo'=>$request->cargo,'fechaDesde'=>$request->fechaDesde,'fechaHasta'=>$request->fechaHasta,'monto'=>$request->monto]);
				return redirect()->route('persona.show',['id' => $idper]);
			}
		}
		catch(Exception $e){
			return back()->withInput()->withError($e->getMessage());
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
