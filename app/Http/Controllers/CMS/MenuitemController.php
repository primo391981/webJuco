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
        //
		$menuitems = Menuitem::orderBy("orden_menu")->get();
		
		$subtitulo = 'Lista de items de menú';
		
		return view('cms.menuitem.listaMenuitem', ['subtitulo' => $subtitulo, 'menuitems' => $menuitems]);
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$subtitulo = 'Agregar Item de Menú';
		
		return view('cms.menuitem.agregarMenuitem', ['subtitulo' => $subtitulo]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CMS\Menuitem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menuitem $menuitem)
    {
        //
    }
	
	//subir el nivel de un item 
	public function upMenu(Request $request)
	{
		$menuitem_id = $request->input('menuitem_id');
		
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
		$menuitem_id = $request->input('menuitem_id');
		
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
}
