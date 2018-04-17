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
        //
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
}
