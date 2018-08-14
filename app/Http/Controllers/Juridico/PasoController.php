<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Paso;
use App\Juridico\TipoPaso;
use App\Juridico\Expediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

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
		return view('juridico.expediente.agregarPaso',['expediente' => $exp, 'tipoPaso' => $tipoPaso]);
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
		
		return redirect()->route('expediente.show',$expediente)->with("success","El expediente fue modificado correctamente.");
		
		/*if ($request->hasFile('documentos')) {
			foreach($request->documentos as $documento){
				var_dump($documento);
			}
		}*/	
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Juridico\Paso  $paso
     * @return \Illuminate\Http\Response
     */
    public function show(Paso $paso)
    {
       dd($paso);
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
}
