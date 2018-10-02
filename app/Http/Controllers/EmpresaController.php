<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\TipoDoc;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Support\Facades\DB;
use Exception;

class EmpresaController extends Controller
{
    public function index()
    {
       $empresas=Empresa::All();
	   return view('contable.empresa.listaEmpresas', ['empresas' => $empresas]);
	   //este es el camino de las carpetas hasta llegar al blade correspondiente
    }
	public function desactivada()
    {
       $empresas=Empresa::onlyTrashed()->get();
	   return view('contable.empresa.listaNoEmpresas', ['empresas' => $empresas]);
	   //este es el camino de las carpetas hasta llegar al blade correspondiente
    }

    public function create()
    {
        //return vista con FORM para add empresa
		return view('contable.empresa.agregarEmpresa',[]);
    }
	
    public function store(EmpresaRequest $request)
    {
		try{
        $empresa = new Empresa;
		$empresa->rut=$request->input('rut');
		$empresa->razonSocial=$request->input('razonSocial');
		$empresa->nombreFantasia=$request->input('nombreFantasia');
		$empresa->domicilio=$request->input('domicilio');
		$empresa->numBps=$request->input('numBps');
		$empresa->numBse=$request->input('numBse');
		$empresa->numMtss=$request->input('numMtss');
		$empresa->grupo=$request->input('grupo');
		$empresa->subGrupo=$request->input('subGrupo');
		$empresa->email=$request->input('email');
		$empresa->telefono=$request->input('telefono');
		$empresa->nomContacto=$request->input('nomContacto');
		$empresa->save();		
		
		return redirect()->route('empresa.index');
		}
		catch(Exception $e){
			if($e->getCode()==23000){
				return back()->withInput()->withError("Ya existe un empresa con esos datos. RUT - GRUPO - SUBGRUPO");
			}else{
				return back()->withInput()->withError("La empresa no se pudo registrar, intente nuevamente o contacte al administrador.");
			}
		}
    }
    public function show($id)
    {	
        $empresa=Empresa::find($id);
		$tiposDocumentos=TipoDoc::All();
		return view('contable.empresa.verEmpresa',['empresa'=>$empresa,'tipoDoc'=>$tiposDocumentos]);	
    }

    public function edit($id)
    {
        $empresa=Empresa::find($id);
		return view('contable.empresa.editarEmpresa',['empresa'=>$empresa]);
    }

    public function update(EmpresaRequest $request, $id)
    {
		$empresa=Empresa::find($id);
		$empresa->rut=$request->input('rut');
		$empresa->razonSocial=$request->input('razonSocial');
		$empresa->nombreFantasia=$request->input('nombreFantasia');
		$empresa->domicilio=$request->input('domicilio');
		$empresa->numBps=$request->input('numBps');
		$empresa->numBse=$request->input('numBse');
		$empresa->numMtss=$request->input('numMtss');
		$empresa->grupo=$request->input('grupo');
		$empresa->subGrupo=$request->input('subGrupo');
		$empresa->email=$request->input('email');
		$empresa->telefono=$request->input('telefono');
		$empresa->nomContacto=$request->input('nomContacto');
		$empresa->save();
		return redirect()->route('empresa.index');
    }

    public function destroy($id)
    {
		$empresa=Empresa::find($id);
		$personasAsociados=$empresa->personas;
		$encontre=false;
		
		foreach($personasAsociados as $persona){
			if($persona->pivot->habilitado==true){
				$encontre=true;
			}
		}		
		if($encontre){
			return back()->withInput()->withError("Debe desvincular todos los empleados de la empesa antes de eliminarla.");
		}
		else{
			$empresa->delete();
			return redirect()->route('empresa.index')->with('success', "La empresa se eliminio correctamente.");			
		}		
			
    }
	
	public function restaurar($id)
    {
		$empresa= Empresa::onlyTrashed()->where('id',$id);			
		$empresa->restore();
		return redirect()->route('empresa.index');
    }
	public function buscaEmpleado(Request $request){
		
	}
	public function asociarEmpleado(Request $request, $idEmpr){
		
	}
}
