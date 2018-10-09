<?php

namespace App\Http\Controllers\CMS;

use App\CMS\Contenido;
use App\CMS\Contenedor;
use App\CMS\TipoContenedor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ContenidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contenidos = Contenido::orderBy("titulo")->get();
		
		$subtitulo = 'Lista de Contenidos';
		//Se retorna la vista "index" 
		return view('cms.contenido.listaContenidos', ['subtitulo' => $subtitulo, 'contenidos' => $contenidos]);
    }
	
	public function inactivos()
    {
		$contenidos = Contenido::onlyTrashed()->get();
				
		return view('cms.contenido.listaContenidosInactivos', ['contenidos' => $contenidos]);
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subtitulo = 'Agregar Contenido';
	
		return view('cms.contenido.agregarContenidos', ['subtitulo' => $subtitulo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
			'titulo' => 'required',
			'subtitulo' => 'required',
			'texto' => 'required',
		]);

		$contenido = new Contenido();

		$contenido->titulo = $request->titulo;
		$contenido->subtitulo = $request->subtitulo;
		$contenido->texto = $request->texto;
		$contenido->archivo = $request->archivo !== null ? $request->archivo : "";
		$contenido->nombre_archivo = $request->nombre_archivo !== null ? $request->nombre_archivo : "";
		$contenido->imagen = $request->imagen !== null ? $request->imagen : "";
		$contenido->alt_imagen = $request->alt_imagen !== null ? $request->alt_imagen : "";
		
		$contenido->save();
		
		$contenidos = Contenido::orderBy("titulo")->get();
		$subtitulo = 'Lista de Contenidos';

		// devolver mensaje de creado correctamente
		return redirect()->route('contenido.index')->with('success','El contenido fue modificado correctamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function edit(Contenido $contenido)
    {
		$subtitulo = 'Editar Contenido';

		return view('cms.contenido.editarContenidos', ['subtitulo' => $subtitulo, 'contenido' => $contenido]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contenido $contenido)
    {
        $request->validate([
			'titulo' => 'required',
			'subtitulo' => 'required',
			'texto' => 'required',
		]);
		
		$contenido->titulo = $request->titulo;
		$contenido->subtitulo = $request->subtitulo;
		$contenido->texto = $request->texto;
		
		
		//manejo del archivo adjunto
		if($request->hasFile('archivo')){
			$archivo = $request->file('archivo');
			$path = $archivo->store('public/contenidos/archivos');
			$contenido->archivo = Storage::url($path);
		} 
		
		$contenido->nombre_archivo = $request->nombre_archivo !== null ? $request->nombre_archivo : "nombre de archivo";
		
		//manejo de imagen adjunta
		if($request->hasFile('imagen')){
			$imagen = $request->file('imagen');
			$path = $imagen->store('public/contenidos/imagenes');
			$contenido->imagen = Storage::url($path);
		} 
		
		$contenido->alt_imagen = $request->alt_imagen !== null ? $request->alt_imagen : "Texto de imagen";
		
		$contenido->save();
		
		// devolver mensaje de creado correctamente
		
		return redirect()->route('contenido.index')->with('success','El contenido fue modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contenido $contenido)
    {
        $contenido->delete();
		
		return redirect()->route('contenido.index')->with('success','El contenido fue eliminado correctamente');
    }
	
	//subir el nivel de un contenido 
	public function upContenido(Request $request)
	{
		$contenido_id = $request->input('contenido_id');
		
		$contenedor_id = $request->input('contenedor_id');
		
		$contenedor = Contenedor::findOrFail($contenedor_id);
		$contenido = $contenedor->contenidos->where('id',$contenido_id)->first();
		
		$nuevo_orden_up = $contenido->pivot->orden - 1;
		
		$contenido = $contenedor->contenidos;
		
		//id del contenido que va a descender
		$contenido_id_down = $contenido[$nuevo_orden_up-1]->id;
		
		//posicion a la que desciende 
		$nuevo_orden_down = $nuevo_orden_up+1;
		
		//transaccion
			$contenedor->contenidos()->updateExistingPivot($contenido_id,['orden' => $nuevo_orden_up]);
			$contenedor->contenidos()->updateExistingPivot($contenido_id_down,['orden' => $nuevo_orden_down]);
		//
		
		return redirect()->route('contenedor.edit', ['contenedor' => $contenedor]);

	}
	
	
	//bajar el nivel de un contenido 
	public function downContenido(Request $request)
	{
		
		$contenido_id = $request->input('contenido_id');

		$contenedor_id = $request->input('contenedor_id');
		
		$contenedor = Contenedor::findOrFail($contenedor_id);

		$contenido = $contenedor->contenidos->where('id',$contenido_id)->first();
		
		$nuevo_orden_down = $contenido->pivot->orden + 1;
		
		$contenido = $contenedor->contenidos;
		
		//id del organo que va a descender
		$contenido_id_up = $contenido[$nuevo_orden_down - 1]->id;
		
		//posicion a la que desciende 
		$nuevo_orden_up = $nuevo_orden_down - 1;
		
		$contenedor->contenidos()->updateExistingPivot($contenido_id,['orden' => $nuevo_orden_down]);
		$contenedor->contenidos()->updateExistingPivot($contenido_id_up,['orden' => $nuevo_orden_up]);

		return redirect()->route('contenedor.edit', ['contenedor' => $contenedor]);
		
	}
	
	//restaurar contenido eliminado 
	public function activarContenido(Request $request)
	{
		//dd($request);
		$contenido = Contenido::withTrashed()->where('id',$request->contenido_id)->first();
		
		$contenido->restore();
		
		return redirect()->route('contenido.index.inactivos')->with('success', 'El contenido fue restaurado correctamente.');
		
	}
	
}
