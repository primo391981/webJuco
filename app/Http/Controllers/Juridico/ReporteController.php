<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Reporte;
use App\Juridico\Expediente;
use App\Juridico\TipoExpediente;
use App\Juridico\Dataset;
use App\Juridico\Estado;
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
        $reportes = Reporte::All();
		
		return view('juridico.reporteGerencial.listaReportes',['reportes' => $reportes]);
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
        $reporte = new Reporte();
		$reporte->fecha_desde = $request->fecha_inicio;
		$reporte->fecha_hasta = $request->fecha_fin;
		
		$reporte->save();
		
		$expedientes = Expediente::where([
			['fecha_inicio','>=',$request->fecha_inicio],
			['fecha_inicio','<=',$request->fecha_fin],
		])->get();
		
		// Creación de datasets		
		
		//dataset por tipos de proceso
		$data = [
			'labels' =>  [],
			'datasets' =>  [[
				'data' =>  [],
				'backgroundColor' =>  [
					'rgba(255, 99, 132, 0.5)',
					'rgba(54, 162, 235, 0.5)',
					'rgba(255, 206, 86, 0.5)',
					'rgba(75, 192, 192, 0.5)',
					'rgba(153, 102, 255, 0.5)',
				],
				'borderColor' =>  [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
				],
				'borderWidth' =>  1
			]]
		];
	

		$tipoExpedientes = TipoExpediente::All();
		
		foreach($tipoExpedientes as $tipoExpediente){
			array_push($data['labels'],$tipoExpediente->nombre);
		};

		//get cantidad de expedientes por tipoExpediente
		array_push($data['datasets'][0]['data'],$expedientes->where('tipo_id',1)->count());
		array_push($data['datasets'][0]['data'],$expedientes->where('tipo_id',2)->count());
		array_push($data['datasets'][0]['data'],$expedientes->where('tipo_id',3)->count());
		array_push($data['datasets'][0]['data'],$expedientes->where('tipo_id',4)->count());
		array_push($data['datasets'][0]['data'],$expedientes->where('tipo_id',5)->count());

		
		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = json_encode($data);
		
		$dataset->save();
		// fin dataset tipo de proceso
		
		// dataset por estado de expedientes
		
		$data = [
			'labels' =>  [],
			'datasets' =>  [[
				'data' =>  [],
				'backgroundColor' =>  [
					'rgba(255, 99, 132, 0.5)',
					'rgba(54, 162, 235, 0.5)',
					'rgba(255, 206, 86, 0.5)',
					'rgba(75, 192, 192, 0.5)',
					'rgba(153, 102, 255, 0.5)',
				],
				'borderColor' =>  [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
				],
				'borderWidth' =>  1
			]]
		];
		
		$estadosExpedientes = Estado::All();
		
		foreach($estadosExpedientes as $estado){
			array_push($data['labels'],$estado->nombre);
		};
		
		//get cantidad de expedientes por estado
		array_push($data['datasets'][0]['data'],$expedientes->where('estado_id',1)->count());
		array_push($data['datasets'][0]['data'],$expedientes->where('estado_id',2)->count());
		array_push($data['datasets'][0]['data'],$expedientes->where('estado_id',3)->count());
		array_push($data['datasets'][0]['data'],$expedientes->where('estado_id',4)->count());
		array_push($data['datasets'][0]['data'],$expedientes->where('estado_id',5)->count());
		
		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = json_encode($data);
		
		$dataset->save();
		// fin dataset estado de expedientes
		
		// dataset total de expedientes
		$data = $expedientes->count();
		
		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = $data;
		
		$dataset->save();
		// fin de dataset total de expedientes
		
		// dataset total de expedientes ganados
		$data = $expedientes->where('resultado',1)->count();
		
		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = $data;
		
		$dataset->save();
		// fin de dataset total de expedientes ganados
		
		// dataset por estado de expedientes
		
		$data = [
			'labels' =>  [],
			'datasets' =>  [[
				'data' =>  [],
				'options': [
					'scales': {
						'xAxes': [[
							'stacked': true
						]],
						'yAxes': [[
							'stacked': true
						]]
					}
				]
				'backgroundColor' =>  [
					'rgba(255, 99, 132, 0.5)',
					'rgba(54, 162, 235, 0.5)',
					'rgba(255, 206, 86, 0.5)',
					'rgba(75, 192, 192, 0.5)',
					'rgba(153, 102, 255, 0.5)',
				],
				'borderColor' =>  [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
				],
				'borderWidth' =>  1
			]]
		];
		
		$estadosExpedientes = Estado::All();
		
		foreach($estadosExpedientes as $estado){
			array_push($data['labels'],$estado->nombre);
		};
		
		//get cantidad de expedientes por estado
		array_push($data['datasets'][0]['data'],$expedientes->where('estado_id',1)->count());
		array_push($data['datasets'][0]['data'],$expedientes->where('estado_id',2)->count());
		array_push($data['datasets'][0]['data'],$expedientes->where('estado_id',3)->count());
		array_push($data['datasets'][0]['data'],$expedientes->where('estado_id',4)->count());
		array_push($data['datasets'][0]['data'],$expedientes->where('estado_id',5)->count());
		
		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = json_encode($data);
		
		$dataset->save();
		// fin dataset estado de expedientes
		
		
		return redirect()->route('reporte.show',['reporte' => $reporte]);
    
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Juridico\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(Reporte $reporte)
    {
        return view('juridico.reporteGerencial.verReporte',['reporte' => $reporte]);
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
        $reporte->delete();
		
		return redirect()->route('reporte.index')->with('success', "El reporte fue eliminado correctamente"); 
    }
}
