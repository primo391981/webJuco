<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Expediente;
use App\Juridico\Cliente;
use App\Juridico\Transicion;
use App\Juridico\TipoExpediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoapClient;
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
          
		 // ejemplo: 10-1/2010
        $iue = $request->iue;

        $expediente = $client->ConsultaIUE($iue);
		
		//dd($expediente->caratula);
		
		if($expediente->estado === "EL EXPEDIENTE NO SE ENCUENTRA EN EL SISTEMA"){
			return back()->withInput()->withError('El expediente no se encuentra en el sistema del Poder Judicial');
		} else {
			$tipoExpedientes = TipoExpediente::All();
			$clientes = Cliente::All();
			
			//dd($clientes);
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
		$expediente->paso_actual = 0;
		$expediente->user_id = Auth::user()->id;
		
		$expediente->save();
		foreach($request->clientes as $cliente){
			$expediente->clientes()->attach($cliente);
		}
		
		//dd($expediente->clientes);
		//setting varables a mostrar en el formulario de creación de paso
		
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
        $expediente = Expediente::find(1);
		
		echo $expediente->tipo_id;
		
		echo $expediente->tipo->transiciones->where('id_paso_inicial',$expediente->paso_actual);
		
		//echo $expediente->tipo->transiciones->where('id_tipo_expediente',$expediente->tipo_id); 
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
}
