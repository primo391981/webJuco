<?php

namespace App\Http\Controllers\Juridico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoapClient;

class WebServiceController extends Controller
{
    //
	public function test(){
				
		$wsdl = "http://www.expedientes.poderjudicial.gub.uy/wsConsultaIUE.php?wsdl";    
        $client = new SoapClient($wsdl);
          
        $parameters = "10-1/2010";

        $values = $client->ConsultaIUE($parameters);
		//dd($values);
		$xml = $values;
		print "<pre>\n";
        print_r($xml);
        print "</pre>";
		
		
		//dd($client);
	}
}
