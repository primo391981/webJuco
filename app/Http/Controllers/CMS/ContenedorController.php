<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//Se debe indicar qué modelos ("clases") van a utilizarse
use App\CMS\Contenedor;
use App\CMS\TipoContenedor;


class ContenedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //Si bien se puede acceder directamente a la vista desde la ruta, se mantiene el acceso via controller por si en el futuro se agrega funcionalidad desde este punto
		
		//se retorna la vista "index" 
		//return view('admin.admin');
		$contenedores = Contenedor::orderBy("orden_menu")->get();
		
		
		
		$subtitulo = 'Lista de Contenedores';
		//se retorna la vista "index" 
		return view('cms.listaContenedores', ['subtitulo' => $subtitulo, 'contenedores' => $contenedores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Redirige al formulario de agregar contenedor.
	{
		$subtitulo = 'Agregar Contenedor';
		
		$tipos_contenedor = TipoContenedor::All();
	
		return view('cms.agregarContenedor', ['subtitulo' => $subtitulo, 'tipos_contenedor' => $tipos_contenedor]);
	}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contenedors  $contenedors
     * @return \Illuminate\Http\Response
     */
    public function show(Contenedors $contenedors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contenedors  $contenedors
     * @return \Illuminate\Http\Response
     */
    public function edit(Contenedors $contenedors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contenedors  $contenedors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contenedors $contenedors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contenedors  $contenedors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contenedors $contenedors)
    {
        //
    }
}
