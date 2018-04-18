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
		
		
		$contenedor->id_itemmenu = $request->input('id_itemmenu');
		
		//obtener el orden dentro de menuitem correspondiente
		$menuitem = Menuitem::findOrFail($contenedor->id_itemmenu);
		$orden = $menuitem->contenedores->count();
		$contenedor->orden_menu = $orden + 1;
		
		
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
			
		$contenedor->titulo = $request->titulo;
		$contenedor->tipo = $request->tipo;
			
		if($contenedor->id_itemmenu != $request->id_itemmenu){
			$contenedor->id_itemmenu = $request->id_itemmenu;
			//obtener el orden dentro de menuitem correspondiente
			$menuitem = Menuitem::findOrFail($contenedor->id_itemmenu);
			$orden = $menuitem->contenedores->count();
			$contenedor->orden_menu = $orden + 1;
		}
		
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
	
	public function assignContenido(Request $request, $contenido_id)
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
	
	public function deassignContenido(Request $request)
    {
        //dd($contenido_id);
		$id_contenedor = $request->contenedor_id;
		$id_contenido = $request->contenido_id;
		
		$contenedor = Contenedor::findOrFail($id_contenedor);
		
		$orden = $contenedor->contenidos->where('id',$id_contenido)->first()->pivot->orden;
		
		$listado = $contenedor->contenidos()->wherePivot('orden', '>=' , $orden)->get();
		
		//TODO: reordenar los contenidos luego de eliminar la asignación.
		// reocorrer la lista de asignados con orden mayor o igual a $orden y renumerar.
		//foreach()
		
		//TODO: eliminar la asignacion.
    }
	
	public function deassignContenedor(Request $request)
    {
        //dd($contenido_id);
		$id_contenedor = $request->contenedor_id;
		$contenedor = Contenedor::findOrFail($id_contenedor);
		$contenedor->id_itemmenu = null;
		$contenedor->orden_menu = null;
		
		$contenedor->save();
		
		//reordenamiento de los contenedores en el menú
		
		$menuitem_id = $request->menuitem_id;
		$menuitem = Menuitem::find($menuitem_id);
		
		$orden_liberado = $contenedor->orden_menu;
		
		$listado = $menuitem->contenedores->where('orden_menu', '>=', $orden_liberado)->sortBy('orden_menu');
		
		foreach($listado as $cont){
			$cont->orden_menu--;
			$cont->save();
		}
		
		return redirect()->route('menuitem.edit', ['menuitem' => $menuitem]);
		
    }
	
	//subir el nivel de un contenedor en el menu 
	public function upContenedor(Request $request)
	{
		$menuitem_id = $request->input('menuitem_id');
		
		$menuitem = Menuitem::find($menuitem_id);
		
		$contenedor_id = $request->input('contenedor_id');
		
		$contenedor_up = Contenedor::find($contenedor_id);
		
		$orden_actual = $contenedor_up->orden_menu;
		
		$contenedor_down = $menuitem->contenedores->where('orden_menu',$orden_actual-1)->first();
		
		//se sube el nivel del item
		$contenedor_up->orden_menu--;
		$contenedor_down->orden_menu++;
		
		$contenedor_up->save();
		$contenedor_down->save();
		
		return redirect()->route('menuitem.edit', ['menuitem' => $menuitem]);

	}
	
	
	//bajar el nivel de un contenedor en el menu 
	public function downContenedor(Request $request)
	{
		$menuitem_id = $request->input('menuitem_id');
		
		$menuitem = Menuitem::find($menuitem_id);
		
		$contenedor_id = $request->input('contenedor_id');
		
		$contenedor_down = Contenedor::find($contenedor_id);
		
		$orden_actual = $contenedor_down->orden_menu;
		
		$contenedor_up = $menuitem->contenedores->where('orden_menu',$orden_actual+1)->first();
		
		//se sube el nivel del item
		$contenedor_down->orden_menu++;
		$contenedor_up->orden_menu--;
		
		$contenedor_down->save();
		$contenedor_up->save();
		
		return redirect()->route('menuitem.edit', ['menuitem' => $menuitem]);
		
	}
	
}
