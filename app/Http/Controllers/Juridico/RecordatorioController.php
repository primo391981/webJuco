<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Recordatorio;
use App\Juridico\Expediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class RecordatorioController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
		
		if($user->hasRole('invitado')){
			$exp = Expediente::find($request->id_expediente);
			if(!$user->permisosEscritura->contains($exp)){
				return abort(403, 'Unauthorized action.');
			}; 
		};
		
		$recordatorio = new Recordatorio();
		$recordatorio->id_expediente = $request->id_expediente;
		$recordatorio->fecha_vencimiento = $request->fecha;
		$recordatorio->cant_dias = $request->cantDias;
		$recordatorio->mensaje = $request->mensaje;
		$recordatorio->estado = 0;
		
		$recordatorio->save();
		
		return redirect()->route('expediente.show',$recordatorio->id_expediente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Juridico\Recordatorio  $recordatorio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recordatorio $recordatorio)
    {
        $user = Auth::user();
		
		if($user->hasRole('invitado')){
			$exp = $recordatorio->expediente;
			if(!$user->permisosEscritura->contains($exp)){
				return abort(403, 'Unauthorized action.');
			}; 
		};
		
		$recordatorio->delete();
		
		return redirect()->back()->with('success', 'El recordatorio fue eliminado correctamente');
    }
}
