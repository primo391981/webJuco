<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Paso;
use App\Juridico\TipoPaso;
use App\Juridico\Expediente;
use App\Juridico\ArchivoPaso;
use App\Juridico\TipoArchivo;
use App\Juridico\Notificacion;
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
    public function create($expediente, $paso)
    {
        $exp = Expediente::find($expediente);
		$tipoPaso = TipoPaso::find($paso);
		$tiposArchivo = TipoArchivo::All();
		
		return view('juridico.expediente.agregarPaso',['expediente' => $exp, 'tipoPaso' => $tipoPaso, 'tiposArchivo' => $tiposArchivo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
		$paso = new Paso();
		$paso->id_expediente = $request->expediente_id;
		$paso->id_tipo = $request->tipoPaso_id;
		$paso->id_usuario = Auth::user()->id;
		$paso->comentario = $request->comentarios;
		$paso->fecha_fin = null;
		
		$expediente = Expediente::find($request->expediente_id);
		$expediente->paso_actual = $request->tipoPaso_id;
		
		$paso->save();
		$expediente->save();
		
		if ($request->hasFile('documentos')) {
			/*$num = 1;
			
			dd(str_slug($fileName,'-'));*/
			$directorio = $expediente->iue;
			$directorio = str_slug($directorio);
			foreach($request->documentos as $key => $documento){
				
				$file = new ArchivoPaso();
				$file->id_paso = $paso->id;
				$file->id_tipo = $request->tipoarchivo;
				$file->archivo = $documento->storeAs('expedientes/'.$directorio, $expediente->actual->nombre."_".$key.".".$documento->extension());
				$file->nombre_archivo = $file->archivo;
				//dd(Storage::mimeType($file->nombre_archivo));
				$file->save();
			}
		}	
		
		$notificacion = new Notificacion();
		$notificacion->id_paso = $paso->id;
		$notificacion->id_user = $paso->id_usuario;
		$notificacion->id_tipo = 1; //tipo info
		$notificacion->fecha_envio = Carbon::now();
		$notificacion->estado = 1; //se programa para enviar cuanto antes.
		$notificacion->mensaje = "El expediente ".$expediente->iue." ha sido modificado.";
		
		$notificacion->save();
		
		// envío de mail, pruebas	
		$mensaje = "mail de prueba de juco";
        Mail::to('primo39@gmail.com')->send(new SendMailable($mensaje));
		
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
	   $expediente = $paso->expediente;
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
        //
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
        //
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
	public function download(ArchivoPaso $archivo)
	{
		$url = Storage::url($archivo->archivo);
		
		return response()->download(storage_path('app/' . $archivo->archivo));
	}
}
