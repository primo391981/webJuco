<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Cliente;
use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::All();
		
		return view('juridico.cliente.listaClientes', ['clientes' => $clientes]);
    }
	
	public function inactivos()
    {
        $clientes = Cliente::onlyTrashed()->get();
		
		return view('juridico.cliente.listaClientesInactivos', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "lalala";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Juridico\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Juridico\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        if($cliente->persona_type == 'App\Persona'){
			$persona = Persona::find($cliente->persona_id);
			return view('juridico.cliente.editarClientes', ['persona' => $persona, 'tipo' => 'fisica']);
		} else {
			echo "nada";
		}
		
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Juridico\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $cliente)
    {
        $cliente->documento = $request->documento;
		$cliente->save();
		return redirect()->route('cliente.index')->with('success', "El cliente fue modificado correctamente");
    }
	
	public function activar(Request $request)
    {
		
		$cliente = Cliente::onlyTrashed()
                ->where('id', $request->cliente_id)
                ->first();
				
		$cliente->restore();
		
		return redirect()->route('cliente.index.inactivos')->with('success', "El cliente fue restaurado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Juridico\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
		
		return redirect()->route('cliente.index')->with('success', "El cliente fue eliminado correctamente");
    }
}
