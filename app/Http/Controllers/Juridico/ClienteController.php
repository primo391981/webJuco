<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Cliente;
use App\Persona;
use App\Tipodoc;
use App\EstadoCivil;
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

	
	public function search(Request $request)
    {
		dd($request->ajax());
		
		$tipodoc = $request->tipodoc;
		$doc = $request->documento;
		
		$personas = Persona::where([
			["tipoDocumento", "=", $tipodoc],
			["documento", "like", "%".$doc."%"]
		])->get();
		
		if($request->ajax()) {
			return response()->json([
                'personas' => $personas	,
            ]);
        }
		
		//return $respuesta;
		//Se retorna la vista "index" 
		//return view('cms.contenido.listaContenidos', ['subtitulo' => $subtitulo, 'contenidos' => $contenidos]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('juridico.cliente.agregarClientes');
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFisica()
    {
        $tiposdoc = Tipodoc::All();
		
		$estados = EstadoCivil::All();
				
		
		return view('juridico.cliente.agregarFisica', ['tiposdoc' => $tiposdoc, 'estados' => $estados]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$tipoPersona = $request->tipo_persona;
		if($tipoPersona == "fisica"){	
			$persona = new Persona();
			$persona->tipoDocumento = $request->tipodoc;
			$persona->documento = $request->documento;
			$persona->nombre = $request->nombre;
			$persona->apellido = $request->apellido;
			$persona->domicilio = $request->domicilio;
			$persona->email = $request->email;
			$persona->telefono = $request->telefono;
			$persona->estadoCivil = $request->estadoCivil;
			$persona->cantHijos = $request->cantHijos;
			$persona_type = 'App\Persona';
		}
		$persona->save();
		
		$cliente = new Cliente();
		$cliente->persona_id = $persona->id;
		$cliente->persona_type = $persona_type;
		$cliente->save();
		
		return redirect()->route('cliente.index')->with('success', "El cliente se agregó correctamente");
		
		
		
	   
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
			$estados = EstadoCivil::All();
			$tiposdoc = Tipodoc::All();
			return view('juridico.cliente.editarClientes', ['persona' => $persona, 'tipo' => 'fisica', 'tiposdoc' => $tiposdoc, 'estados' => $estados]);
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
