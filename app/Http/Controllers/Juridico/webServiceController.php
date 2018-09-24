<?php

namespace App\Http\Controllers\Juridico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoapClient;

class WebServiceController extends Controller
{
    //
	    //
	public function index(){
		return view('Juridico.webservice.busqueda');
	}
	
	public function test(Request $request){
				
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
		/*foreach($values->movimientos as $movimiento){
			
		}
		*/
		//dd($client);
	}
}
