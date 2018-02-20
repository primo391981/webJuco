<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class WebController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
	//contenido es la variable que se llama en el index
	//$contenido es el array en el que se cargaron los datos en el Controller
    {
		$tituloFirma = 'Nuestra Firma';
		$textoFirma = 'Este es el contenido de nuestra firma';
        return view('index', ['tituloFirma' => $tituloFirma, 'textoFirma' => $textoFirma]);
    }
	
	//        return view('index', ['user' => User::findOrFail($id)]);
}