<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Archivo;
use App\Juridico\Expediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Storage;

class ArchivoController extends Controller
{
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		if ($request->hasFile('documentos')) {

			if($request->owner_type === "App\Juridico\Expediente"){
				$expediente = Expediente::find($request->owner_id);
				$directorio = $expediente->iue;
				$directorio = str_slug($directorio);
				$directorio = 'expedientes/'.$directorio;
			} else {
				$directorio = $request->owner_id;
				$directorio = 'clientes/'.$directorio;
			}
			
			foreach($request->documentos as $key => $documento){
				
				$file = new Archivo();
				$file->owner_id = $request->owner_id;
				$file->owner_type = $request->owner_type;
				
				$file->archivo = $documento->storeAs($directorio, $documento->getClientOriginalName());
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
		
		return redirect()->back()->with('success','El archivo fue creado correctamente');
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Juridico\ArchivoPaso  $archivoPaso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archivo $archivo)
    {
        $user = Auth::user();
		
		if($user->hasRole('invitado')){
			if(!$user->permisosEscritura->contains($exp)){
				return abort(403, 'Unauthorized action.');
			}; 
		};
		
		$archivo->delete();
		
		return redirect()->back()->with('success','El archivo fue borrado correctamente');
    }
}
