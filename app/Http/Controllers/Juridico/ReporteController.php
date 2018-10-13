<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Reporte;
use App\Juridico\Expediente;
use App\Juridico\TipoExpediente;
use App\Juridico\Dataset;
use App\Juridico\Estado;

use \Carbon\Carbon;

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
		$pasoMaximo = null;
		
		// fin de dataset total de expedientes ganados
		
		// dataset max duración de pasos de expedientes
		$maximo = 0; //en dias, para test, en minutos
		
		foreach($expedientes as $expediente){
			foreach($expediente->pasos as $paso){
				$dt1=new Carbon($paso->created_at);
				
				//Si el paso está finalizado
				if($paso->fecha_fin != null){
					dd($paso->fecha_fin);
					$duracion = $dt1->diffInMinutes($paso->fecha_fin);
					// $duracion = $dt1->diffInDays($paso->fecha_fin); Para producción va en días
					//dd($duracion);
				//Sino, tomo la duración actual
				} else {
					$duracion = $dt1->diffInMinutes(Carbon::now());
				}
				
				//guardo el mayor registro y el paso para mostrar
				
				if($duracion >= $maximo){
					$maximo = $duracion;
					$pasoMaximo = $paso;
				}
			}
		}
		
		$data = ['maximo'=>$maximo , 'pasoMaximo' => $pasoMaximo];

		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = json_encode($data);
		
		$dataset->save();
		// fin  dataset  max duración de pasos de expedientes
		
		// dataset min duración de pasos de expedientes
		$minimo = 99999999; //en dias, para test, en minutos
	
		foreach($expedientes as $expediente){
			foreach($expediente->pasos as $paso){
				$dt1=new Carbon($paso->created_at);
				
				//Si el paso está finalizado
				if($paso->fecha_fin != null){
					$duracion = $dt1->diffInMinutes($paso->fecha_fin);
					// $duracion = $dt1->diffInDays($paso->fecha_fin); Para producción va en días
					//dd($duracion);
				//Sino, tomo la duración actual
				} else {
					$duracion = $dt1->diffInMinutes(Carbon::now());
				}
				
				//guardo el mayor registro y el paso para mostrar
				
				if($duracion <= $minimo){
					$minimo = $duracion;
					$pasoMinimo = $paso;
				}
			}
		}
		
		$data = ['minimo'=>$minimo , 'pasoMinimo' => $pasoMinimo];

		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = json_encode($data);
		
		$dataset->save();
		// fin  dataset  min duración de pasos de expedientes
		
		// dataset promedio duración de pasos de expedientes
		$contador = 0;
		$acumulador = 0;
		
		foreach($expedientes as $expediente){
			$contador = $contador + $expediente->pasos->count();
			
			foreach($expediente->pasos as $paso){
				$dt1=new Carbon($paso->created_at);
				if($paso->fecha_fin != null){
					$duracion = $dt1->diffInMinutes($paso->fecha_fin);
					// $duracion = $dt1->diffInDays($paso->fecha_fin); Para producción va en días
					//dd($duracion);
				//Sino, tomo la duración actual
				} else {
					$duracion = $dt1->diffInMinutes(Carbon::now());
				}
				
				$acumulador = $acumulador + $duracion;
			}
			
		}
		
		$data = $duracion / $contador;

		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = json_encode($data);
		
		$dataset->save();
		// fin  dataset  min duración de pasos de expedientes
		
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
