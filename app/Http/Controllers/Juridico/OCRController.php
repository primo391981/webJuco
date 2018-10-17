<?php

namespace App\Http\Controllers\Juridico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use thiagoalessio\TesseractOCR\TesseractOCR;

class OCRController extends Controller
{
	public function readOCR(){
		return view('juridico.ocr.formOCR');
	}
	
	public function ocrtext(Request $request){
		
		
		$archivo = $request->file('archivo')->storeAs('public/ocr','file');
		//dd($archivo);
		$imagen = '/home/vagrant/code/webJuco/public/storage/ocr/file';
		
		$tesseract = new TesseractOCR($imagen);
		try{
			$resultado = $tesseract->lang('spa')->run();
		} catch (\Exception $e){
			return redirect()->back()->with('error','No se pudo leer el archivo. Intente con otro archivo. Error reportado: '.$e->getMessage());
		}
		
		return redirect()->back()->with(['success' => 'La lectura de imagen se realizó correctamente.', 'resultado' => $resultado]);
	}
	
}
