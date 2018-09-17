<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Reporte;
use App\Juridico\Expediente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('juridico.reporteGerencial.verReporte');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('juridico.reporteGerencial.agregarReporte');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expedientes = Expediente::where([
			['fecha_inicio','>=',$request->fecha_inicio],
			['fecha_inicio','<=',$request->fecha_fin],
		])->get();
		dd($expedientes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Juridico\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(Reporte $reporte)
    {
        return view('juridico.reporteGerencial.verReporte');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Juridico\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Juridico\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Juridico\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporte $reporte)
    {
        //
    }
}
