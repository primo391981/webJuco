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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($expediente, $transicion)
    {
        
		//dd($tran);
		$exp = Expediente::find($expediente);
		
		$user = Auth::user();
		
		if($user->hasRole('invitado')){
			if(!$user->permisosEscritura->contains($exp)){
				return abort(403, 'Unauthorized action.');
			}; 
		};
		$tran = Transicion::find($transicion);
		
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
		
        $user = Auth::user();
		$expediente = Expediente::find($request->expediente_id);
		$transicion = Transicion::find($request->transicion_id);
		if($user->hasRole('invitado')){
			if(!$user->permisosEscritura->contains($expediente)){
				return abort(403, 'Unauthorized action.');
			}; 
		};
				
		if($expediente->pasos->where('id_tipo',$request->tipoPaso_id)->count() == 0){
			$paso = new Paso();
			$paso->id_expediente = $request->expediente_id;
			$paso->id_tipo = $request->tipoPaso_id;
			$paso->id_usuario = Auth::user()->id;
			$paso->comentario = $request->comentarios;
			$paso->flujo = $transicion->tipo_transicion;
			$paso->fecha_fin = null;
		
		} else {
			$paso = $expediente->pasos->where('id_tipo',$request->tipoPaso_id)->first();
			$paso->flujo = 0;
			
		}
		
		$paso->save();
		
		$pasoPrevio = $expediente->pasos->where('id_tipo',$transicion->inicial->id)->first();
		//dd($pasoPrevio);
		if($pasoPrevio->flujo == $paso->flujo){
			$pasoPrevio->fecha_fin = Carbon::now();
			$pasoPrevio->save();
		}
			
		if ($request->hasFile('documentos')) {

			$directorio = $expediente->iue;
			$directorio = str_slug($directorio);
			foreach($request->documentos as $key => $documento){
				
				$file = new Archivo();
				$file->owner_id = $paso->id;
				$file->owner_type = "App\Juridico\Paso";
				
				$file->archivo = $documento->storeAs('expedientes/'.$directorio, $documento->getClientOriginalName());
				$file->nombre_archivo = $documento->getClientOriginalName();
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
				
				$file->save();
			}
		}	
		
		$notificacion = new Notificacion();
		$notificacion->id_paso = $paso->id;
		$notificacion->id_user = $paso->id_usuario;
		$notificacion->id_tipo = 1; //tipo info
		$notificacion->fecha_envio = Carbon::now();
		$notificacion->estado = 0; //se envía una notificación por mail.
		$notificacion->mensaje = Carbon::now()." - El expediente ".$expediente->iue." ha sido modificado por el usuario ".Auth::user()->name.".";
		
		$notificacion->save();
		
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
	   $user = Auth::user();
	   
	   $expediente = $paso->expediente;
	   
	   if($user->hasRole('invitado')){
			if(!$user->permisosExpedientes->contains($expediente)){
				return abort(403, 'Unauthorized action.');
			};
		};
	  
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
        $user = Auth::user();
		$exp = $paso->expediente;
		
		if($user->hasRole('invitado')){
			if(!$user->permisosEscritura->contains($exp)){
				return abort(403, 'Unauthorized action.');
			}; 
		};
				
		//solo es posible editar el paso actual en el que se encuentra un expediente
		if( $exp->pasos->last()->id == $paso->id ){
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
        $user = Auth::user();
		$expediente = $paso->expediente;	
		
		if($user->hasRole('invitado')){
			if(!$user->permisosEscritura->contains($expediente)){
				return abort(403, 'Unauthorized action.');
			}; 
		};
		
		$paso->comentario = $request->comentarios;
		$paso->save();
		
		if ($request->hasFile('documentos')) {
			$directorio = $expediente->iue;
			$directorio = str_slug($directorio);
			foreach($request->documentos as $key => $documento){
				$file = new Archivo();
				$file->owner_id = $paso->id;
				$file->owner_type = "App\Juridico\Paso";
				$file->archivo = $documento->storeAs('expedientes/'.$directorio, $documento->getClientOriginalName());
				$file->nombre_archivo = $documento->getClientOriginalName();
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
				
				$file->save();
			}
		}	
		
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Juridico\Paso  $paso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paso $paso)
    {
        //
    }
	
	// inicia descarga del archivo indicado como parámetro
	public function download(Archivo $archivo)
	{
		$user = Auth::user();
		
		if($user->hasRole('invitado')){
			if(!$user->permisosExpedientes->contains($expediente)){
				return abort(403, 'Unauthorized action.');
			};
		};
		
		$url = Storage::url($archivo->archivo);
		
		return response()->download(storage_path('app/' . $archivo->archivo));
	}
}
