<?php

namespace App\Http\Controllers\Contable;

use App\Contable\Cargo;
use App\Contable\Remuneracion;
use App\Http\Requests\CargoRequest;
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
		
		return view('contable.cargo.listaCargos', ['cargos' => $cargos]);
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
        $remuneraciones = Remuneracion::All();
		return view('contable.cargo.agregarCargos', ['remuneraciones' => $remuneraciones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CargoRequest $request)
    {
        $cargo = new Cargo;
		$cargo->nombre = $request->nombre;
		$cargo->descripcion = $request->descripcion;
		$cargo->id_remuneracion = $request->id_remuneracion;
		
		$cargo->save();
		
		return redirect()->route('cargo.index')->with('success', "El cargo se creó correctamente");
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
    public function update(CargoRequest $request, Cargo $cargo)
    {
        $cargo->nombre = $request->nombre;
		$cargo->descripcion = $request->descripcion;
		$cargo->save();
		
		return redirect()->route('cargo.index')->with('success', "El cargo fue modificado correctamente");
    }
	
	public function activar(Request $request)
    {
		
		$cargo = Cargo::onlyTrashed()
                ->where('id', $request->cargo_id)
                ->first();
				
		$cargo->restore();
		
		return redirect()->route('cargo.index.inactivos')->with('success', "El cargo fue restaurado correctamente");
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
		
		return redirect()->route('cargo.index')->with('success', "El cargo fue eliminado correctamente");
    }
}
