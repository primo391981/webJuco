<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Paso;
use App\Juridico\TipoPaso;
use App\Juridico\Expediente;
use App\Juridico\Archivo;
use App\Juridico\TipoArchivo;

use App\Juridico\Transicion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Storage;
use Carbon\Carbon;

class PasoController extends Controller
{	
	private function saveArchivo($iue,$documentos,$pasoId){
		
		//se crea el nombre del directorio
		$directorio = $iue;
		$directorio = str_slug($directorio);
			
		//por cada adjunto
		foreach($documentos as $key => $documento){
			//se registra el archivo
			$file = new Archivo();
			$file->owner_id = $pasoId;
			$file->owner_type = "App\Juridico\Paso";
			$file->archivo = $documento->storeAs('expedientes/'.$directorio, $documento->getClientOriginalName());
			$file->nombre_archivo = $documento->getClientOriginalName();
			$tipoArchivo = Storage::mimeType($file->archivo);
			
			//se obtiene el tipo de archivo y se lo registra
			$file->id_tipo = $this->tipoArchivo($file->archivo);
			
			//se guardan los cambios
			$file->save();
		}
	}
	
	private function tipoArchivo($archivo){
		//se obtiene el tipo de archivo y se lo registra
		$tipoArchivo = Storage::mimeType($archivo);
		
		switch(substr($tipoArchivo,0,4)){
			case "text": $id_tipo = 1;
					break;
			case "imag": $id_tipo = 2;
					break;
			case "vide": $id_tipo = 3;
					break;
			case "audi": $id_tipo = 4;
					break;
			default: $id_tipo = 5;
					break;
		}
		
		return $id_tipo;
		
	}
	
	private function checkRole($user, $expediente){
		if($user->hasRole('invitado')){
			if(!$user->permisosEscritura->contains($expediente)){
				return abort(403, 'Unauthorized action.');
			}; 
		};
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($expediente, $transicion)
    {
        
		//obtención del expediente correspondiente
		$exp = Expediente::find($expediente);
		
		$user = Auth::user();
		
		//si el usuario tiene el rol adecuado
		/*if($user->hasRole('invitado')){
			if(!$user->permisosEscritura->contains($exp)){
				return abort(403, 'Unauthorized action.');
			}; 
		};*/
		
		$this->checkRole($user,$exp);
		
		//transicion correspondiente
		$tran = Transicion::find($transicion);
		
		//tipo paso sigueinte correspondiente a la transicion
		$tipoPaso = TipoPaso::find($tran->id_paso_siguiente);
		
		return view('juridico.expediente.agregarPaso',['expediente' => $exp, 'tipoPaso' => $tipoPaso, 'transicion' => $tran]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//dd($request);
		//obtención del usuario registrado
        $user = Auth::user();
		
		//obtención del expediente correspondiente
		$expediente = Expediente::find($request->expediente_id);
		
		//obtención de la transicion correspondiente
		$transicion = Transicion::find($request->transicion_id);
		
		//si el usaurio tiene el rol adecuado
		$this->checkRole($user,$expediente);
				
		//si no existe el paso en el expediente		
		if($expediente->pasos->where('id_tipo',$request->tipoPaso_id)->count() == 0){
			
			//se crea el nuevo paso
			$paso = new Paso();
			$paso->id_expediente = $request->expediente_id;
			$paso->id_tipo = $request->tipoPaso_id;
			$paso->id_usuario = Auth::user()->id;
			$paso->comentario = $request->comentarios;
			$paso->flujo = $transicion->tipo_transicion;
			$paso->fecha_fin = null;
		
		} else {
			
			//se registra el paso como paralelo
			$paso = $expediente->pasos->where('id_tipo',$request->tipoPaso_id)->first();
			$paso->flujo = 0;
			
		}
		
		//se actualiza el estado del expediente	
		if($paso->id_tipo == 12){
			$expediente->estado_id = 5;
			$expediente->resultado = $request->resultado;
			$paso->fecha_fin = Carbon::now();
		} else {
			$expediente->estado_id = 2;
		}
		$expediente->save();
		
		$paso->save();
		
		//se obtiene el paso previo 
		$pasoPrevio = $expediente->pasos->where('id_tipo',$transicion->inicial->id)->first();
		
		//si el paso previo corresponde al flujo (principal o paralelo), se cierra el paso previo
		if($pasoPrevio->flujo == $paso->flujo){
			$pasoPrevio->fecha_fin = Carbon::now();
			$pasoPrevio->save();
		}
		
		//si hay archivos, se adjuntan al paso	
		if ($request->hasFile('documentos')) {
			$this->saveArchivo($expediente->iue, $request->documentos, $paso->id);
		}	
		
		//se crea una notificación y se envía por mail
		$msg = Carbon::now()." - El expediente ".$expediente->iue." ha sido modificado por el usuario ".Auth::user()->name.".";
		notificacion($paso, $msg, $expediente);
			
		return redirect()->route('expediente.show',$expediente)->with("success","El expediente fue modificado correctamente.");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Juridico\Paso  $paso
     * @return \Illuminate\Http\Response
     */
    public function show(Paso $paso)
    {
		//se obtiene el usuario registrado
		$user = Auth::user();
	   
		//se obtiene el expediente correspondiente
		$expediente = $paso->expediente;
	   
		//si el usuario tiene el rol adecuado
		$this->checkRole($user,$expediente);
	  
		//se obtienen las transiciones posibles
		$transiciones = $expediente->tipo->transiciones->where('id_paso_inicial',$expediente->paso_actual);

		return view('juridico.expediente.verPaso', ['paso' => $paso, 'expediente' => $expediente, 'transiciones' =>$transiciones]);
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Juridico\Paso  $paso
     * @return \Illuminate\Http\Response
     */
    public function edit(Paso $paso)
    {
        //se obtiene el usuario registrado
		$user = Auth::user();
		
		//se obtiene el expediente correspondiente
		$exp = $paso->expediente;
		
		//si el usuario tiene el rol adecuado
		$this->checkRole($user,$exp);
				
		//solo es posible editar el paso actual en el que se encuentra un expediente
		if( $paso->fecha_fin == null ){
			return view('juridico.expediente.editarPaso',['expediente' => $exp, 'paso' => $paso]);
		} else {
			return redirect()->back();
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Juridico\Paso  $paso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paso $paso)
    {
        //se obtiene el usuario registrado
		$user = Auth::user();
		
		//se obtiene el expediente correspondiente
		$expediente = $paso->expediente;	
		
		//si el usuario tiene el rol adecuado
		$this->checkRole($user,$expediente);
		
		$paso->comentario = $request->comentarios;
		$paso->save();
		
		//si hay archivos, se adjuntan al paso	
		if ($request->hasFile('documentos')) {
			$this->saveArchivo($expediente->iue, $request->documentos, $paso->id);
		}
		
		//se crea una notificación y se envía por mail
		$msg = Carbon::now()." - El expediente ".$expediente->iue." ha sido modificado por el usuario ".Auth::user()->name.".";
		notificacion($paso, $msg, $expediente);
		 					
		return redirect()->route('paso.show',$paso)->with("success","El expediente fue modificado correctamente.");
    }

	// inicia descarga del archivo indicado como parámetro
	public function download(Archivo $archivo)
	{
		//se general la url
		$url = Storage::url($archivo->archivo);
		
		return response()->download(storage_path('app/' . $archivo->archivo));
	}
}
