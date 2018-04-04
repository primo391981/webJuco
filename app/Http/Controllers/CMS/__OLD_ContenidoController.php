<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CMS\Contenido;

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
