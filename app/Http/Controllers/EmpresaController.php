<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class EmpresaController extends Controller
{
    public function index()
    {
       $empresas=Empresa::All();
	   return view('contable.empresa.listaEmpresas', ['empresas' => $empresas]);
	   //este es el camino de las carpetas hasta llegar al blade correspondiente
    }

    public function create()
    {
        //return vista con FORM para add empresa
		return view('contable.empresa.agregarEmpresa',[]);
    }

   
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		
        $empresa=Empresa::find($id);
		return view('contable.empresa.verEmpresa',['empresa'=>$empresa]);
		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa=Empresa::find($id);
		return view('contable.empresa.editarEmpresa',['empresa'=>$empresa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$empresa=Empresa::find($id);
		$empresa->delete();
		return redirect()->route('empresa.index');
    }
}
