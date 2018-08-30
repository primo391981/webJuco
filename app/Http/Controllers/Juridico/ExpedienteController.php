<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Expediente;
use App\Juridico\Cliente;
use App\Juridico\Transicion;
use App\Juridico\TipoExpediente;
use App\Juridico\Paso;
use App\Administracion\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoapClient;
use SoapFault;
use Auth;

class ExpedienteController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $expedientes = Expediente::All();
	   
	   return view('juridico.expediente.listaExpediente', ['expedientes' => $expedientes]);
		
    }
	
	public function search(Request $request){
		
		$wsdl = "http://www.expedientes.poderjudicial.gub.uy/wsConsultaIUE.php?wsdl";    
		$client = new SoapClient($wsdl); 
		$iue = $request->iue;
		
		try { 
			$expediente = $client->ConsultaIUE($iue);
        } catch (SoapFault $e) { 
			return back()->withInput()->withError('El sistema del Poder Judicial no se encuentra disponible en este momento. Haga click <a href="">aquí</a> para ingresar un iue de forma manual.');
		} 		
		
		if($expediente->estado === "EL EXPEDIENTE NO SE ENCUENTRA EN EL SISTEMA"){
			return back()->withInput()->withError('El expediente no se encuentra en el sistema del Poder Judicial');
		} else {
			$tipoExpedientes = TipoExpediente::All();
			$clientes = Cliente::All();
			return view('juridico.expediente.agregarExpediente',['clientes' => $clientes, 'tipoExpedientes' => $tipoExpedientes, 'expediente' => $expediente, 'tipoDocumento' => 'DEMANDA' ]);
		}
		
		
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('juridico.expediente.webserviceExpediente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
        //dd(Auth::user()->id);
		$request->validate([
			'IUE' => 'required|unique:juridico_expedientes',
		]);
		
		
		$expediente = new Expediente();
		$expediente->iue = $request->IUE;
		$expediente->tipo_id = $request->tipoexp;
		$expediente->caratula = $request->caratula;
		$expediente->fecha_inicio = $request->fecha_inicio;
		$expediente->fecha_inicio = $request->fecha_inicio;
		$expediente->juzgado = $request->juzgado;
		$expediente->estado_id = 1;
		$expediente->paso_actual = 1;
		$expediente->user_id = Auth::user()->id;
		
		$expediente->save();
		foreach($request->clientes as $cliente){
			$expediente->clientes()->attach($cliente);
		}
		
		//setting variables a mostrar en el formulario de creación de paso
		$paso = new Paso();
		$paso->id_expediente = $expediente->id;
		$paso->id_tipo = 1;
		$paso->id_usuario = Auth::user()->id;
		$paso->comentario = "Expediente creado";
		$paso->fecha_fin = null;
		
		$paso->save();

		if ($request->exists('nextExpediente')){
			return view('juridico.expediente.agregarPaso', ['expediente' => $expediente, 'numero_paso' => 1, 'nombre_paso' => "Adjuntar Demanda"])->with('success', "El expediente se creó correctamente.");
		} else {
			return redirect()->route('expediente.index')->with('success', "El expediente se creó correctamente.");
		}
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Juridico\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function show(Expediente $expediente)
    {
        $transiciones = $expediente->tipo->transiciones->where('id_paso_inicial',$expediente->paso_actual);
		
		$usuarios = User::All();
		
		return view('juridico.expediente.verExpediente', ['expediente' => $expediente, 'transiciones' => $transiciones, 'usuarios' => $usuarios]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Juridico\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function edit(Expediente $expediente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Juridico\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expediente $expediente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Juridico\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expediente $expediente)
    {
        //
    }
	
	public function addPermiso(Request $request, Expediente $expediente)
	{
		$expediente->permisosExpedientes()->attach($request->usuario, ['id_tipo' => $request->tipoPermiso]);

		return redirect()->back()->with('success', 'Permiso asignado correctamente');
	}
}
