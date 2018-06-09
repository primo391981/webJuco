<?php

namespace App\Http\Controllers\Juridico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use thiagoalessio\TesseractOCR\TesseractOCR;

class OCRController extends Controller
{
	public function ocrtext(){
		
		$imagen = '/home/vagrant/code/Juco/public/img/text.png';
		
		$tesseract = new TesseractOCR($imagen);
		
		$tesseract->executable('/usr/bin/tesseract');
        //dd($tesseract);
		//var_dump($tesseract);
		//$texto = new TesseractOCR($imagen);
		//$texto->executable('/usr/bin/tesseract');
		//dd($texto);
		//($imagen)->run();
		//dd($texto);
	
		//$valor = $texto->run();
		
		//dd($valor);
		echo("Prueba OCR <br><br>El texto obtenido de la imagen: <br><br>".$tesseract->lang('spa')->run());
	}
	
}
