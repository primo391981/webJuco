<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Expediente;
use App\Juridico\Transicion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoapClient;

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
        $parameters = $request->iue;

        $values = $client->ConsultaIUE($parameters);
		//dd($values);
		/*
		$xml = $values;
		print "<pre>\n";
        print_r($xml);
        print "</pre>";
		*/
		dd($values);
		foreach($values->movimientos as $movimiento){
			
		}
		//dd($client);
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
        //
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