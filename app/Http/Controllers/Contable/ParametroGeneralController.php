<?php

namespace App\Http\Controllers\Contable;

use App\Contable\ParametroGeneral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParametroGeneralRequest;
use \Carbon\Carbon;

class ParametroGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $params = ParametroGeneral::All();
		
		return view('contable.parametrogeneral.listaParametroGral', ['params' => $params]);
    }
	
	public function inactivos()
    {
        $params = ParametroGeneral::onlyTrashed()->get();
		
		return view('contable.parametrogeneral.listaParametroGralInactivos', ['params' => $params]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('contable.parametrogeneral.agregarParametroGral');
    }
	
	

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParametroGeneralRequest $request)
    {
		if(!is_null($request->fecha_fin) && $request->fecha_fin < $request->fecha_inicio){
			return back()->withInput()->withError('Error en la carga del parámetro. Verifique las fechas de vigencia');
		};
		
		$parametro = ParametroGeneral::where('nombre',$request->nombre)->latest()->first();
		$bandera = 1;
		
		if(!is_null($parametro)){
			if($request->fecha_inicio > $parametro->fecha_inicio){
				if(is_null($parametro->fecha_fin) || $parametro->fecha_fin >= $request->fecha_inicio){
					$fecha_fin = Carbon::parse($request->fecha_inicio);
					$fecha_fin = $fecha_fin->subDays(1);
					$parametro->fecha_fin = $fecha_fin->toDateString();
					$parametro->save();
				} 				 
			} else {
				$bandera = 0;
			}
		}
		
		if($bandera==1){
			$param = new ParametroGeneral();
			$param->nombre = $request->nombre;
			$param->descripcion = $request->descripcion;
			$param->fecha_inicio = $request->fecha_inicio;
			$param->fecha_fin = $request->fecha_fin;
			$param->valor = $request->valor;
			
			$param->save();
			
			return redirect()->route('parametrogeneral.index')->with('success', "El parámetro se creó correctamente");
		} else {
			return back()->withInput()->withError('Error en la carga del parámetro. Verifique las fechas de vigencia');
		}
	}

	/**
     * Search a created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(ParametroGeneralRequest $request)
    {
		$parametro = ParametroGeneral::where('nombre',$request->nombre)->latest()->first();
		
		if(!is_null($parametro)){
			$mensaje = "El Parámetro ya existe en la base de datos. Desea sobreescribirlo?";
			$find = true;
		} else {
			$mensaje = null;
			$find = false;
			
		}
		
		if($request->ajax()) {
			return response()->json([
				'mensaje' => $mensaje,
				'find' => $find
				
			]);	
		}
    }
	
    /**
     * Display the specified resource.
     *
     * @param  \App\Contable\ParametroGeneral  $parametroGeneral
     * @return \Illuminate\Http\Response
     */
    public function show(ParametroGeneral $parametrogeneral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contable\ParametroGeneral  $parametroGeneral
     * @return \Illuminate\Http\Response
     */
    public function edit(ParametroGeneral $parametrogeneral)
    {
        $subtitulo = 'Editar parámetro general';
		
		return view('contable.parametrogeneral.editarParametroGral', ['subtitulo' => $subtitulo, 'param' => $parametrogeneral]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contable\ParametroGeneral  $parametroGeneral
     * @return \Illuminate\Http\Response
     */
    public function update(ParametroGeneralRequest $request, ParametroGeneral $parametrogeneral)
    {
       	$parametro = ParametroGeneral::where('nombre',$request->nombre)->latest()->first();
		
		if($parametro == $parametrogeneral){
			$parametrogeneral->descripcion = $request->descripcion;
			$parametrogeneral->fecha_fin = $request->fecha_fin;
			$parametrogeneral->valor = $request->valor;
			$parametrogeneral->save();			 
			
			return redirect()->route('parametrogeneral.index')->with('success', "El parámetro fue modificado correctamente");
		
		} else {
			
			return back()->withInput()->withError('El parámetro seleccionado no puede ser modificado. Contáctese con el administrador');
		}
    }

	public function activar(Request $request)
    {
		
		$param = ParametroGeneral::onlyTrashed()
                ->where('id', $request->param_id)
                ->first();
				
		$param->restore();
		
		return redirect()->route('parametrogeneral.index.inactivos')->with('success', "El cargo fue restaurado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contable\ParametroGeneral  $parametroGeneral
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParametroGeneral $parametrogeneral)
    {
         $parametrogeneral->delete();
		
		return redirect()->route('parametrogeneral.index')->with('success', "El parámetro fue eliminado correctamente");
    }
}
