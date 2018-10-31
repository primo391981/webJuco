<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Reporte;
use App\Juridico\Expediente;
use App\Juridico\TipoExpediente;
use App\Juridico\Dataset;
use App\Juridico\Estado;
use Auth;
use PDF;
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
	
	public function createExpediente()
    {
        $expedientes = Expediente::All();
		
		return view('juridico.reporteExpediente.agregarReporte',['expedientes' => $expedientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//recupero los expedientes en el periodo solicitado
		$expedientes = Expediente::where([
			['fecha_inicio','>=',$request->fecha_inicio],
			['fecha_inicio','<=',$request->fecha_fin],
		])->get();
		
		//si hay registros, se crea el reporte
		if($expedientes->count() == 0){
			return redirect()->back()->with('error','No hay expedientes registrados en el período seleccionado. Ingrese otro período.');
		}
			
		$reporte = new Reporte();
		$reporte->fecha_desde = $request->fecha_inicio;
		$reporte->fecha_hasta = $request->fecha_fin;
		$reporte->user_id = Auth::User()->id;
		$reporte->tipo = 1;
			
		$reporte->save();
		
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
				'borderColor' =>  'rgba(255,255,255,1)',
				'borderWidth' =>  '2'
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
				'borderWidth' =>  2
				
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
		
		// dataset total de expedientes
		$data = $expedientes->count();
		
		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = $data;
		
		$dataset->save();
		
		// dataset total de expedientes ganados
		$data = $expedientes->where('resultado',1)->count();
		
		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = $data;
		
		$dataset->save();
		$pasoMaximo = null;
		
		// dataset max duración de pasos de expedientes
		$maximo = 0; //en dias, para test, en minutos
		// dataset min duración de pasos de expedientes
		$minimo = 99999999; //en dias, para test, en minutos
		// dataset promedio duración de pasos de expedientes
		$contador = 0;
		$acumulador = 0;
		// dataset cantidad de clientes
		$contadorClientes = 0;
		
		foreach($expedientes as $expediente){
			//contador de pasos
			$contador = $contador + $expediente->pasos->count();
			//contador de clientes
			$contadorClientes = $contadorClientes + $expediente->clientes->count();	
			
			foreach($expediente->pasos as $paso){
				if($paso->id_tipo!=12){
					$dt1=new Carbon($paso->created_at);
				
					//Si el paso está finalizado
					if($paso->fecha_fin != null){
						//$duracion = $dt1->diffInMinutes($paso->fecha_fin);
						$duracion = $dt1->diffInDays($paso->fecha_fin); // Para producción va en días
					//Sino, tomo la duración actual
					} else {
						$duracion = $dt1->diffInDays(Carbon::now());
					}
					
					//guardo el mayor registro y el paso para mostrar
					if($duracion >= $maximo){
						$maximo = $duracion;
						$pasoMaximo = $paso;
					}
					
					//guardo el menor registro y el paso para mostrar
					if($duracion <= $minimo){
						$minimo = $duracion;
						$pasoMinimo = $paso;
					}
					
					//guardo el acumulado de pasos
					$acumulador = $acumulador + $duracion;
				}
			}
		}
		
		$data = ['maximo'=>$maximo , 'pasoMaximo' => $pasoMaximo];

		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = json_encode($data);
		
		$dataset->save();
		// fin  dataset  max duración de pasos de expedientes
	
		$data = ['minimo'=>$minimo , 'pasoMinimo' => $pasoMinimo];

		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = json_encode($data);
		
		$dataset->save();
		// fin  dataset  min duración de pasos de expedientes
		
		$data = $acumulador / $contador;

		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = json_encode($data);
		
		$dataset->save();
		// fin  dataset  min duración de pasos de expedientes
		
		$data = $contadorClientes;

		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = json_encode($data);
		
		$dataset->save();
		// fin  dataset  min duración de pasos de expedientes
				
		return redirect()->route('reporte.show',['reporte' => $reporte]);
	}

	public function storeExpediente(Request $request)
    {
		//obtengo el expediente
		$expediente = Expediente::find($request->expediente_id);
		
		//creo un nuevo reporte
		$reporte = new Reporte();
		$reporte->user_id = Auth::User()->id;
		$reporte->tipo = 2; //reporte de tipo "expediente"
			
		$reporte->save();
		
		//se guarda el id del expediente como primer dataset
		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = $expediente->id;
		
		$dataset->save();
		
		// dataset por duración de pasos del expediente
		$data = [
			'labels' =>  [],
			'datasets' =>  [[
				'data' =>  [],
				'backgroundColor' =>  [],
				'borderColor' =>  [],
				'borderWidth' =>  2
				
			]]
		];
	
		$pasoMaximo = null;
		$maximo = 0; //en dias, para test, en minutos
		$minimo = 99999999; //en dias, para test, en minutos
		$acumulador = 0;
		
		foreach($expediente->pasos as $paso){

			if($paso->id_tipo!=12){
				
				array_push($data['labels'],$paso->tipo->nombre);
				$dt1=new Carbon($paso->created_at);
				//si el paso está finalizado
				if($paso->fecha_fin != null){
					$fecha_fin = new Carbon($paso->fecha_fin);
					//$duracion = $dt1->diffInSeconds($paso->fecha_fin);
					$duracion = $dt1->diffInDays($paso->fecha_fin); //Para producción va en días
				} else {
					$fecha_fin = Carbon::now();
					//Sino, tomo la duración actual
					$duracion = $dt1->diffInDays(Carbon::now());
				}
				
				array_push($data['datasets'][0]['data'],$fecha_fin->diffInDays($paso->created_at));
				array_push($data['datasets'][0]['backgroundColor'],'rgba(54, 162, 235, 0.5)');
				array_push($data['datasets'][0]['borderColor'],'rgba(54, 162, 235, 1)');
				
				//guardo el mayor registro y el paso para mostrar
				if($duracion >= $maximo){
					$maximo = $duracion;
					$pasoMaximo = $paso;
				}
				
				//guardo el mayor registro y el paso para mostrar
				if($duracion <= $minimo){
					$minimo = $duracion;
					$pasoMinimo = $paso;
				}
				
				$acumulador = $acumulador + $duracion;
			}
		};
		
		//get cantidad de expedientes por estado
		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = json_encode($data);
		
		$dataset->save();
		// fin dataset estado de expedientes
		// dataset2 total de pasos posibles de expedientes
		$data = $expediente->tipo->transiciones->count();
		
		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = $data;
		
		$dataset->save();
		// fin de dataset total de expedientes
		// dataset3 total de pasos del expediente completados
		$data = $expediente->pasos->count();
		
		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = $data;
		
		$dataset->save();
		
		// fin de dataset total de pasos de expedientes ganados
		// dataset max duración de pasos de expedientes
		$data = ['maximo'=>$maximo , 'pasoMaximo' => $pasoMaximo];

		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = json_encode($data);
		
		$dataset->save();
		// fin  dataset  max duración de pasos de expedientes
		// dataset5 min duración de paso de expediente
		$data = ['minimo'=>$minimo , 'pasoMinimo' => $pasoMinimo];

		$dataset = new Dataset();
		$dataset->id_reporte = $reporte->id;
		$dataset->dataset = json_encode($data);
		
		$dataset->save();
		// fin  dataset  min duración de pasos de expedientes
		// dataset promedio duración de pasos de expedientes
		$contador = $expediente->pasos->count();

		$data = $acumulador / $contador;

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
        if($reporte->tipo == 1){
			return view('juridico.reporteGerencial.verReporte',['reporte' => $reporte]);
		} else {
			$expediente = Expediente::find($reporte->datasets[0]->dataset);
			return view('juridico.reporteExpediente.verReporte',['reporte' => $reporte, 'expediente' => $expediente]);
		}
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
