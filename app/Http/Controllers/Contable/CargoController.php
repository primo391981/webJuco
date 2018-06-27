<?php

namespace App\Http\Controllers\Contable;

use App\Contable\Cargo;
use App\Contable\Remuneracion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::All();
		
		return view('contable.cargo.listaCargos', ['cargos' => $cargos, 'subtitle' => "Activos"]);
    }
	
	public function inactivos()
    {
        $cargos = Cargo::onlyTrashed()->get();
		
		return view('contable.cargo.listaCargos', ['cargos' => $cargos, 'subtitle' => "Inactivos"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $remuneraciones = Remuneracion::All();
		return view('contable.cargo.agregarCargos', ['remuneraciones' => $remuneraciones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cargo = new Cargo;
		$cargo->nombre = $request->nombre;
		$cargo->descripcion = $request->descripcion;
		$cargo->id_remuneracion = $request->id_remuneracion;
		
		$cargo->save();
		
		$subtitle = 'Activos';
		
		return redirect()->route('cargo.index', $subtitle);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contable\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show(Cargo $cargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contable\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit(Cargo $cargo)
    {
        $subtitulo = 'Editar Cargo';
		
		$remuneraciones = Remuneracion::All();
		
		return view('contable.cargo.editarCargos', ['subtitulo' => $subtitulo, 'cargo' => $cargo, 'remuneraciones' => $remuneraciones]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contable\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargo $cargo)
    {
        $cargo->nombre = $request->nombre;
		$cargo->descripcion = $request->descripcion;
		$cargo->save();
		
		return redirect()->route('cargo.index');
    }
	
	public function activar(Cargo $cargo)
    {
		dd($cargo);
		
        $cargo->restore();
		
		$subtitle = 'Inactivos';
		
		return redirect()->route('cargo.index', $subtitle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contable\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cargo $cargo)
    {
        $cargo->delete();
		
		return redirect()->route('cargo.index');
    }
}
