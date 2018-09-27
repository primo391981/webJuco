<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Cliente;
use App\Persona;
use App\Empresa;
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
		if($request->tipo_persona == "fisica"){
			if(!is_null($request->documento)){
				$tipodoc = $request->tipodoc;
				$doc = $request->documento;
				$personas = Persona::where([
					["tipoDocumento", "=", $tipodoc],
					["documento", "like", $doc],
				])->first();
			}
		} else {
			if(!is_null($request->rut)){
				$rut = $request->rut;
				$personas = Empresa::where("rut", "like", $rut)->first();
			}
		}
		
		if($request->ajax()) {
				return response()->json([
					'personas' => $personas
				]);
			}

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
	
	public function createJuridica()
    {
 		return view('juridico.cliente.agregarJuridica');
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
		
		
		//dd($request);
		

		if($tipoPersona == "fisica"){	
			
			$persona = Persona::where([
				['tipoDocumento','=',$request->tipodoc],
				['documento','=',$request->documento]
			])->first();
			
			if(is_null($persona)){
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
				$persona->save();
			}
			$persona_type = 'App\Persona';
		} else {
			
			$persona = Empresa::where('rut','=',$request->rut)->first();
			
			if(is_null($persona)){
				$persona = new Empresa();
				$persona->razonSocial = $request->razonSocial;
				$persona->rut = $request->rut;
				$persona->domicilio = $request->domicilio;
				$persona->nombreFantasia = $request->nombreFantasia;
				$persona->numBps = $request->numBps;
				$persona->numBse = $request->numBse;
				$persona->numMtss = $request->numMtss;
				$persona->grupo = $request->grupo;
				$persona->subGrupo = $request->subGrupo;
				$persona->email = $request->email;
				$persona->telefono = $request->telefono;
				$persona->nomContacto = $request->nomContacto;
				$persona->save();
			}
			$persona_type = 'App\Empresa';
		}
		
		
		$cliente=Cliente::where([
			['persona_id','=',$persona->id],
			['persona_type','=',$persona_type],
		])->withTrashed()->get();
		
		//dd($cliente);
		
		if(count($cliente) === 0){
			$cliente = new Cliente();
			$cliente->persona_id = $persona->id;
			$cliente->persona_type = $persona_type;
			$cliente->save();
			
			return redirect()->route('cliente.index')->with('success', "El cliente se agregó correctamente");
		} else {
			return back()->withInput()->withError('El cliente ya se encuentra regsitrado');
		}
		
	   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Juridico\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('juridico.cliente.verCliente', ['cliente' => $cliente]);
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
			$persona = Empresa::find($cliente->persona_id);
			
			return view('juridico.cliente.editarClientes', ['persona' => $persona, 'tipo' => 'juridica']);
		}
	
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Juridico\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
		$persona = $cliente->persona;
		if($cliente->persona_type=="App\Persona"){
			$persona->tipoDocumento = $request->tipodoc;
			$persona->documento = $request->documento;
			$persona->nombre = $request->nombre;
			$persona->apellido = $request->apellido;
			$persona->domicilio = $request->domicilio;
			$persona->email = $request->email;
			$persona->telefono = $request->telefono;
			$persona->estadoCivil = $request->estadoCivil;
			$persona->cantHijos = $request->cantHijos;
		} else {
			$persona->razonSocial = $request->razonSocial;
			$persona->rut = $request->rut;
			$persona->domicilio = $request->domicilio;
			$persona->nombreFantasia = $request->nombreFantasia;
			$persona->numBps = $request->numBps;
			$persona->numBse = $request->numBse;
			$persona->numMtss = $request->numMtss;
			$persona->grupo = $request->grupo;
			$persona->subGrupo = $request->subGrupo;
			$persona->email = $request->email;
			$persona->telefono = $request->telefono;
			$persona->nomContacto = $request->nomContacto;

		}
		
		$persona->save();
		
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
        if($cliente->expedientes->count() > 0){
			return redirect()->route('cliente.index')->with('error', "El cliente no puede ser eliminado porque participa en uno o más expedientes.");
		} else {
			$cliente->delete();
		
			return redirect()->route('cliente.index')->with('success', "El cliente fue eliminado correctamente");
		}
		
    }
}
