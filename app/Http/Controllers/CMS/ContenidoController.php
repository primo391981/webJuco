<?php

namespace App\Http\Controllers\CMS;

use App\CMS\Contenido;
use App\CMS\Contenedor;
use App\CMS\TipoContenedor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
			//'filepath' => 'nullable',
			//'imagen' => 'nullable',
			//'alt_imagen' => 'nullable',
		]);
		
		//dd($request);
		$contenido = new Contenido();
		//dd($request);
		$contenido->titulo = $request['titulo'];
		$contenido->subtitulo = $request['subtitulo'];
		$contenido->texto = $request['texto'];
		$contenido->archivo = $request['archivo'] !== null ? $request['archivo'] : "";
		$contenido->imagen = $request['imagen'] !== null ? $request['imagen'] : "";
		$contenido->alt_imagen = $request['imagen'] !== null ? $request['alt_imagen'] : "";
		$contenido->nombre_archivo = $request['imagen'] !== null ? $request['nombre_archivo'] : "";
		
		//dd($contenido);
		//dd($contenido);
		$contenido->save();
		
		
		/*Contenido::create([
			'titulo' => $data['titulo']
		]);
		*/
		
		$contenidos = Contenido::orderBy("titulo")->get();
		$subtitulo = 'Lista de Contenidos';
		// devolver mensaje de creado correctamente
		
		return view('cms.contenido.listaContenidos', ['subtitulo' => $subtitulo, 'contenidos' => $contenidos]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function show(Contenido $contenido)
    {
        //
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
			//'filepath' => 'nullable',
			//'imagen' => 'nullable',
			//'alt_imagen' => 'nullable',
		]);
		
		$contenido->titulo = $request['titulo'];
		$contenido->subtitulo = $request['subtitulo'];
		$contenido->texto = $request['texto'];
		$contenido->archivo = $request['archivo'] !== null ? $request['archivo'] : "";
		$contenido->imagen = $request['imagen'] !== null ? $request['imagen'] : "";
		$contenido->alt_imagen = $request['imagen'] !== null ? $request['alt_imagen'] : "";
		$contenido->nombre_archivo = $request['imagen'] !== null ? $request['nombre_archivo'] : "";
		
		//dd($contenido);
		//dd($contenido);
		$contenido->save();
		
		
		/*Contenido::create([
			'titulo' => $data['titulo']
		]);
		*/
		
		$contenidos = Contenido::orderBy("titulo")->get();
		$subtitulo = 'Lista de Contenidos';
		// devolver mensaje de creado correctamente
		
		return view('cms.contenido.listaContenidos', ['subtitulo' => $subtitulo, 'contenidos' => $contenidos]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contenido  $contenido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contenido $contenido)
    {
        //
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
		
		$contenedor->contenidos()->updateExistingPivot($contenido_id,['orden' => $nuevo_orden_up]);
		$contenedor->contenidos()->updateExistingPivot($contenido_id_down,['orden' => $nuevo_orden_down]);
		
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
}
