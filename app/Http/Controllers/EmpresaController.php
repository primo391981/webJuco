<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\TipoDoc;
use App\Contable\TipoRecibo;
use App\Contable\Empleado;
use App\Contable\ReciboEmpleado;
use App\Contable\DetalleRecibo;
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
	
	public function listadoReportes(){
		$empresas=Empresa::All();
		$tiposRecibo=TipoRecibo::All();
		return view('contable.reporte.listaReportes', ['empresas' => $empresas,'tiposRecibo'=>$tiposRecibo]);
	}
	
	public function reporteUno(Request $request){
		//$empleados=Empleado::where('idEmpresa','=',$request->empresa)->where('habilitado','=',1)->get();
		$empresa=Empresa::find($request->empresa);
		$empleados=$empresa->personas()->where('habilitado',1)->get();
		
		$montos = collect([]);
		foreach($empleados as $emp){			
			$recibo=ReciboEmpleado::where('idEmpleado','=',$emp->pivot->id)->where('idTipoRecibo','=',$request->tiporec)->where('fechaRecibo','=',$request->fecha."-01")->first();
			if($recibo==null){
				$montos->push("0");
			}
			else{
				$detalle=DetalleRecibo::where('idRecibo','=',$recibo->id)->where('idConceptoRecibo','=',21)->first();
				$montos->push($detalle->monto);				
			}
		}
		$data= [
				'labels'=>$empleados->pluck('documento'),
				'datasets'=> [[
					'label'=>'',
					'data'=> $montos,
					'backgroundColor'=> [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(255, 159, 64, 0.2)'
					],
					'borderColor'=> [
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					'borderWidth'=> 1
				]]
			];
		
		$jsonArmado=json_encode($data);
		//dd($jsonArmado);
		
		$haber=TipoRecibo::find($request->tiporec);
		$titulo=$request->titulo." / Fecha:".$request->fecha." / Tipo de haber: ".$haber->nombre;
		return view('contable.reporte.grafico', ['jsonArmado' => $jsonArmado,'titulo'=>$titulo,'tipografico'=>$request->tipografico]);
		
	}
		
}
