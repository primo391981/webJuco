<?php

namespace App\Http\Controllers\Juridico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use thiagoalessio\TesseractOCR\TesseractOCR;

class OCRController extends Controller
{

	public function ocrtext(){
		
		$imagen = "/home/vagrant/code/webJuco/public/img/pdf4.png";
		
		$tesseract = new TesseractOCR($imagen);
		//dd($tesseract);
        $tesseract->executable('/usr/bin/tesseract');
        //var_dump($tesseract);
		//$texto = new TesseractOCR($imagen);
		//dd($texto);
		//($imagen)->run();
		//dd($texto);
		
		//$valor = $texto->run();
		
		//dd($valor);
		echo($tesseract->lang('spa')->run());
	}
	
}
