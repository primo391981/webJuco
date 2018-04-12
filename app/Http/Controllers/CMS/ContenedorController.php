<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//Se debe indicar qué modelos ("clases") van a utilizarse
use App\CMS\Contenedor;
use App\CMS\TipoContenedor;
use App\CMS\Menuitem;
use App\CMS\Contenido;



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
		return view('cms.contenedor.listaContenedores', ['subtitulo' => $subtitulo, 'contenedores' => $contenedores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Redirige al formulario de agregar contenedor.
		$subtitulo = 'Agregar Contenedor';
		
		$tipos_contenedor = TipoContenedor::All();
		
		$menuitems = Menuitem::All();
	
		return view('cms.contenedor.agregarContenedor', ['subtitulo' => $subtitulo, 'tipos_contenedor' => $tipos_contenedor, 'menuitems' => $menuitems]);
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
		$contenedor = new Contenedor;
		
		$contenedor->titulo = $request->input('titulo');
		$contenedor->tipo = $request->input('tipo');
		$contenedor->orden_menu = $request->input('orden_menu');
		$contenedor->id_itemmenu = $request->input('id_itemmenu');
		$contenedor->color = $request->input('color');
		
		if($request->input('img_fondo')!==null){
			$contenedor->img_fondo = "1";
		} else {
			$contenedor->img_fondo = "0";
		}
			
		if($request->input('ancho_pantalla')!==null){
			$contenedor->ancho_pantalla = "2";
		} else {
			$contenedor->ancho_pantalla = "1";
		}
		
		$contenedor->save();
		
		//dd($contenedor);
		return redirect()->route('contenedor.edit',['contenedor' => $contenedor]);
		//return redirect()->route('contenedor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contenedors  $contenedors
     * @return \Illuminate\Http\Response
     */
    public function show(Contenedor $contenedor)
    {
        //
				
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contenedors  $contenedors
     * @return \Illuminate\Http\Response
     */
    public function edit(Contenedor $contenedor)
    {
        //
		 //
		$subtitulo = 'Editar Contenedor';
		
		$tipos_contenedor = TipoContenedor::All();
		
		$menuitems = Menuitem::All();
		
		return view('cms.contenedor.editarContenedor', ['subtitulo' => $subtitulo, 'tipos_contenedor' => $tipos_contenedor, 'contenedor' => $contenedor, 'menuitems' => $menuitems]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contenedors  $contenedors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contenedor $contenedor)
    {
        //TODO: validar
			
		$contenedor->titulo = $request->input('titulo');
		$contenedor->tipo = $request->input('tipo');
		$contenedor->orden_menu = $request->input('orden_menu');
		$contenedor->id_itemmenu = $request->input('id_itemmenu');
		$contenedor->color = $request->input('color');
		
		if($request->input('img_fondo')!==null){
			$contenedor->img_fondo = "1";
		} else {
			$contenedor->img_fondo = "0";
		}
			
		if($request->input('ancho_pantalla')!==null){
			$contenedor->ancho_pantalla = "2";
		} else {
			$contenedor->ancho_pantalla = "1";
		}
		
		$contenedor->save();
		
		//dd($contenedor);
		return redirect()->route('contenedor.edit',['contenedor' => $contenedor]);
		//return redirect()->route('contenedor.index');
		
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contenedors  $contenedors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contenedor $contenedor)
    {
        //
    }
	
	public function asignContenido(Request $request, $contenido_id)
    {
        //dd($contenido_id);
		$id_contenedor = $request->contenedor_id;
		$contenedor = Contenedor::findOrFail($id_contenedor);
		$contenido = Contenido::findOrFail($contenido_id);
		$orden = $contenedor->contenidos()->count() + 1; 
		
		if($contenedor->contenidos()->save($contenido, ['orden' => $orden])){
			$mensaje = "contenido asignado correctamente";
		} else {
			$mensaje = "el contenido no ha sido asignado";
		};
		
		if ($request->ajax()) {
            return response()->json([
                'message' => $mensaje
            ]);
        }
    }
	
}
