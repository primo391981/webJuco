<?php

namespace App\Http\Controllers\CMS;

use App\CMS\Menuitem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuitemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$menuitems = Menuitem::orderBy("orden_menu")->get();
		
		return view('cms.menuitem.listaMenuitem', ['menuitems' => $menuitems]);
		
    }
	
	public function inactivos()
    {
		$menuitems = Menuitem::onlyTrashed()->get();
				
		return view('cms.menuitem.listaMenuitemInactivos', ['menuitems' => $menuitems]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('cms.menuitem.agregarMenuitem');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orden = Menuitem::All()->count();
		
		$menuitem = new Menuitem();
		
		$menuitem->titulo = $request->titulo;
		$menuitem->descripcion = $request->descripcion;
		$menuitem->orden_menu = $orden + 1;
		
		$menuitem->save();
		
		return redirect()->route('menuitem.index')->with('success','El ítem de menú fue creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CMS\Menuitem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function show(Menuitem $menuitem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CMS\Menuitem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function edit(Menuitem $menuitem)
    {
        $subtitulo = 'Editar Item de Menú';
		
		return view('cms.menuitem.editarMenuitem', ['menuitem' => $menuitem, 'subtitulo' => $subtitulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CMS\Menuitem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menuitem $menuitem)
    {
        
		$menuitem->titulo = $request->titulo;
		$menuitem->descripcion = $request->descripcion;
		
		$menuitem->save();
		
		return redirect()->route('menuitem.index')->with('success','El ítem de menú fue modificado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CMS\Menuitem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menuitem $menuitem)
    {		
		//se obtiene el orden en el menu del item a borrar
		$ordenBorrado = $menuitem->orden_menu;
		
		//se obtiene la lista de items existente
		$items = Menuitem::where('orden_menu','>',$ordenBorrado)->orderBy('orden_menu')->get();
		
		//se actualiza el orden de los restantes items
		foreach($items as $item){
			$item->orden_menu--;
			$item->save();
		}
		
		$menuitem->delete();
		
		return redirect()->route('menuitem.index')->with('success','El ítem de menú fue eliminado correctamente.');
    }
	
	//subir el nivel de un item 
	public function upMenu(Request $request)
	{
		$menuitem_id = $request->menuitem_id;
		
		$menuitem_up = Menuitem::find($menuitem_id);
		
		$orden_actual = $menuitem_up->orden_menu;
		
		$menuitem_down = Menuitem::where('orden_menu',$orden_actual-1)->first();
		
		//se sube el nivel del item
		$menuitem_up->orden_menu--;
		$menuitem_down->orden_menu++;
		
		$menuitem_up->save();
		$menuitem_down->save();
		
		return redirect()->route('menuitem.index');

	}
	
	
	//bajar el nivel de un item 
	public function downMenu(Request $request)
	{
		$menuitem_id = $request->menuitem_id;
		
		$menuitem_down = Menuitem::find($menuitem_id);
		
		$orden_actual = $menuitem_down->orden_menu;
		
		$menuitem_up = Menuitem::where('orden_menu',$orden_actual+1)->first();
		
		//dd($menuitem_up);
		
		//se sube el nivel del item
		$menuitem_down->orden_menu++;
		$menuitem_up->orden_menu--;
		
		$menuitem_down->save();
		$menuitem_up->save();
		
		return redirect()->route('menuitem.index');
		
	}
	
	//restaurar contenido eliminado 
	public function activarMenuitem(Request $request)
	{
		
		$menuitem = Menuitem::withTrashed()->where('id',$request->menuitem_id)->first();
		
		$menuitem->orden_menu = Menuitem::All()->count() + 1; 
		$menuitem->save();
		
		$menuitem->restore();
		
		return redirect()->route('menuitem.index.inactivos')->with('success', 'El ítem fue restaurado correctamente.');
		
	}
}
