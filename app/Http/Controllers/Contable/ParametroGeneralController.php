<?php

namespace App\Http\Controllers\Contable;

use App\Contable\ParametroGeneral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParametroGeneralRequest;

class ParametroGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $params = ParametroGeneral::All();
		
		return view('contable.parametrogeneral.listaParametroGral', ['params' => $params]);
    }
	
	public function inactivos()
    {
        $cargos = Cargo::onlyTrashed()->get();
		
		return view('contable.cargo.listaCargosInactivos', ['cargos' => $cargos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('contable.parametrogeneral.agregarParametroGral');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParametroGeneralRequest $request)
    {
		$param = new ParametroGeneral();
		$param->nombre = $request->nombre;
		$param->descripcion = $request->descripcion;
		$param->fecha_inicio = $request->fecha_inicio;
		$param->fecha_fin = $request->fecha_fin;
		$param->valor = $request->valor;
		
		$param->save();
		
		return redirect()->route('parametrogral.index')->with('success', "El parámetro se creó correctamente");
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contable\ParametroGeneral  $parametroGeneral
     * @return \Illuminate\Http\Response
     */
    public function show(ParametroGeneral $parametroGeneral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contable\ParametroGeneral  $parametroGeneral
     * @return \Illuminate\Http\Response
     */
    public function edit(ParametroGeneral $param)
    {
        $subtitulo = 'Editar parámetro general';
		
		dd($param);
		
		return view('contable.parametrogeneral.editarParametroGral', ['subtitulo' => $subtitulo, 'param' => $param]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contable\ParametroGeneral  $parametroGeneral
     * @return \Illuminate\Http\Response
     */
    public function update(ParametroGeneralRequest $request, ParametroGeneral $parametroGeneral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contable\ParametroGeneral  $parametroGeneral
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParametroGeneral $parametroGeneral)
    {
        //
    }
}
