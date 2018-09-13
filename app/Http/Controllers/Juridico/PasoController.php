<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Paso;
use App\Juridico\TipoPaso;
use App\Juridico\Expediente;
use App\Juridico\Archivo;
use App\Juridico\TipoArchivo;
use App\Juridico\Notificacion;
use App\Juridico\Transicion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Storage;
use Carbon\Carbon;
use Mail;
use App\Mail\SendMailable;

class PasoController extends Controller
{
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
		if($user->hasRole('invitado')){
			if(!$user->permisosEscritura->contains($exp)){
				return abort(403, 'Unauthorized action.');
			}; 
		};
		
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
		//obtención del usuario registrado
        $user = Auth::user();
		
		//obtención del expediente correspondiente
		$expediente = Expediente::find($request->expediente_id);
		
		//se actualiza el estado del expediente
		$expediente->estado_id = 2;
		$expediente->save();
		
		//obtención de la transicion correspondiente
		$transicion = Transicion::find($request->transicion_id);
		
		//si el usaurio tiene el rol adecuado
		if($user->hasRole('invitado')){
			if(!$user->permisosEscritura->contains($expediente)){
				return abort(403, 'Unauthorized action.');
			}; 
		};
				
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
			//se genera le nombre de carpeta para el almacenamiento
			$directorio = $expediente->iue;
			$directorio = str_slug($directorio);
			
			//por cada archivo
			foreach($request->documentos as $key => $documento){
				
				//se crea un nuevo registro
				$file = new Archivo();
				
				//se registra que corresponde a un paso
				$file->owner_id = $paso->id;
				$file->owner_type = "App\Juridico\Paso";
				
				//se guarda el archivo en la ubicación correspondiente
				$file->archivo = $documento->storeAs('expedientes/'.$directorio, $documento->getClientOriginalName());
				$file->nombre_archivo = $documento->getClientOriginalName();
				
				//se obtiene el tipo de archivo y se lo registra
				$tipoArchivo = Storage::mimeType($file->archivo);
				
				switch(substr($tipoArchivo,0,4)){
				case "text": $file->id_tipo = 1;
						break;
				case "imag": $file->id_tipo = 2;
						break;
				case "vide": $file->id_tipo = 3;
						break;
				case "audi": $file->id_tipo = 4;
						break;
				default: $file->id_tipo = 5;
						break;
				}
				
				//se guardan los cambios
				$file->save();
			}
			
		}	
		
		
		//se crea una notificación
		$notificacion = new Notificacion();
		$notificacion->id_paso = $paso->id;
		$notificacion->id_user = $paso->id_usuario;
		$notificacion->id_tipo = 1; //tipo info
		$notificacion->fecha_envio = Carbon::now();
		$notificacion->estado = 0; //se envía una notificación por mail.
		$notificacion->mensaje = Carbon::now()." - El expediente ".$expediente->iue." ha sido modificado por el usuario ".Auth::user()->name.".";
		
		$notificacion->save();
		
		//se actualiza el estado del expediente	
		if($paso->id_tipo == 12){
			$expediente->estado_id = 5;
		} else {
			$expediente->estado_id = 2;
		}
		$expediente->save();
			
		// envío de mail, notificación de modificación	
		Mail::to($expediente->usuario->email)->send(new SendMailable($notificacion->mensaje));
		foreach($expediente->permisosExpedientes as $usuario){
			Mail::to($usuario->email)->send(new SendMailable($notificacion->mensaje));
		}
		// fin envío de mail
	
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
		if($user->hasRole('invitado')){
			if(!$user->permisosExpedientes->contains($expediente)){
				return abort(403, 'Unauthorized action.');
			};
		};
	  
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
		if($user->hasRole('invitado')){
			if(!$user->permisosEscritura->contains($exp)){
				return abort(403, 'Unauthorized action.');
			}; 
		};
				
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
		if($user->hasRole('invitado')){
			if(!$user->permisosEscritura->contains($expediente)){
				return abort(403, 'Unauthorized action.');
			}; 
		};
		
		$paso->comentario = $request->comentarios;
		$paso->save();
		
		//si hay archivos adjuntos se registran
		if ($request->hasFile('documentos')) {
			//se crea el nombre del directorio
			$directorio = $expediente->iue;
			$directorio = str_slug($directorio);
			
			//por cada adjunto
			foreach($request->documentos as $key => $documento){
				//se registra el archivo
				$file = new Archivo();
				$file->owner_id = $paso->id;
				$file->owner_type = "App\Juridico\Paso";
				$file->archivo = $documento->storeAs('expedientes/'.$directorio, $documento->getClientOriginalName());
				$file->nombre_archivo = $documento->getClientOriginalName();
				$tipoArchivo = Storage::mimeType($file->archivo);
				
				//se registra el tipo de archivo
				switch(substr($tipoArchivo,0,4)){
				case "text": $file->id_tipo = 1;
						break;
				case "imag": $file->id_tipo = 2;
						break;
				case "vide": $file->id_tipo = 3;
						break;
				case "audi": $file->id_tipo = 4;
						break;
				default: $file->id_tipo = 5;
						break;
				}
				
				//se guardan los cambios
				$file->save();
			}
		}	
		
		//se crea una notificacion
		$notificacion = new Notificacion();
		$notificacion->id_paso = $paso->id;
		$notificacion->id_user = $paso->id_usuario;
		$notificacion->id_tipo = 1; //tipo info
		$notificacion->fecha_envio = Carbon::now();
		$notificacion->estado = 1; //se envía una notificación por mail.
		$notificacion->mensaje = "El expediente ".$expediente->iue." ha sido modificado.";
		
		$notificacion->save();
		
		// envío de mail, pruebas	
		$mensaje = "mail de prueba de juco";
        Mail::to($expediente->usuario->email)->send(new SendMailable($notificacion->mensaje));
		
		// fin envío de mail
	
		 					
		return redirect()->route('paso.show',$paso)->with("success","El expediente fue modificado correctamente.");
    }

	// inicia descarga del archivo indicado como parámetro
	public function download(Archivo $archivo)
	{
		//se obtiene el usuario registrado
		$user = Auth::user();
		
		//si el usuario tiene el rol adecuado
		if($user->hasRole('invitado')){
			if(!$user->permisosExpedientes->contains($expediente)){
				return abort(403, 'Unauthorized action.');
			};
		};
		
		//se general la url
		$url = Storage::url($archivo->archivo);
		
		return response()->download(storage_path('app/' . $archivo->archivo));
	}
}
