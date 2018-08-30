<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\ArchivoPaso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArchivoPasoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Juridico\ArchivoPaso  $archivoPaso
     * @return \Illuminate\Http\Response
     */
    public function show(ArchivoPaso $archivoPaso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Juridico\ArchivoPaso  $archivoPaso
     * @return \Illuminate\Http\Response
     */
    public function edit(ArchivoPaso $archivoPaso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Juridico\ArchivoPaso  $archivoPaso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArchivoPaso $archivoPaso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Juridico\ArchivoPaso  $archivoPaso
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArchivoPaso $archivoPaso)
    {
        $user = Auth::user();
		
		if($user->hasRole('invitado')){
			if(!$user->permisosEscritura->contains($exp)){
				return abort(403, 'Unauthorized action.');
			}; 
		};
		
		$archivoPaso->delete();
		
		return redirect()->back()->with('message','El archivo fue borrado correctamente');
    }
}
