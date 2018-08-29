<?php

namespace App\Http\Controllers\Contable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresa;
use App\Contable\Empleado;
use App\Contable\Pago;
use App\Contable\TipoRecibo;
use App\Contable\TipoHora;
use App\Contable\RegistroHora;
use App\Contable\Registro;
use App\Contable\Dia;
use App\Contable\HorarioEmpleado;
use Exception;
use \Carbon\Carbon;

class HaberesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::with('personas')->get();
		//$empresas=Empresa::All();
		$tiposHaberes = TipoRecibo::All();		
        return view('contable.haberes.listaEmpresasHaberes', ['empresas' => $empresas, 'tiposHaberes' => $tiposHaberes]);
    }
	public function listaEmpleados(Request $request){
		try{
			
			$empresa=Empresa::where('rut','=',$request->rut)->first();			
			$personas=$empresa->personas;
			$habilitadas=collect([]);
			$cantHabilitados = 0;
			foreach($personas as $persona){
				$fecha=new Carbon($request->mes."-01");
				$fDesde=new Carbon($persona->pivot->fechaDesde);
				$fHasta=new Carbon($persona->pivot->fechaHasta);
				if($fecha->between($fDesde,$fHasta)){
					$habilita=collect([]);
					$habilita->push($persona);					
					$regHora=RegistroHora::where([['idEmpleado','=',$persona->pivot->id],['fecha','=',$fecha]])->first();
					if($regHora!=null){
						$habilita->push('1');
					}
					else{
						$habilita->push('0');
					}
					$pagos=Pago::where([['idEmpleado','=',$persona->pivot->id],['fecha','=',$fecha]])->get();
					
					$totalViaticos=0;
					$totalAdelantos=0;
					foreach($pagos as $p){
						
						if($p->idTipoPago==1){
							$totalViaticos+=$p->monto;
						}
						else{
							$totalAdelantos+=$p->monto;
						}
						//echo ($persona->pivot->id.' - '.$p->tipoPago.' - '.$p->monto);
					}
					
					$habilita->push($totalViaticos);
					$habilita->push($totalAdelantos);
					
					$habilitadas->push($habilita);
					$cantHabilitados ++;
				}
				
			}
			return view('contable.haberes.listaEmpleadosHaberes', ['habilitadas' => $habilitadas, 'calculo' => $request->calculo, 'fecha' => $fecha, 'cantHabilitados' => $cantHabilitados]);			
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}		
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
	/*
	---- DATOS de los EMPLEADOS -----
		"fecha" => "2018-08-01 00:00:00"
		"cantHabilitados" => "2"
		  "1idEmp" => "1"
		  "1hab" => "on"
		  "1v" => "4750"
		  "1a" => "80894"
		  "1ex" => "100"
	 */
	 //dd($request);
       try{
		   $fecha = new Carbon($request->fecha);
		   
			for ( $i = 1; $i <= $request->cantHabilitados; $i++)
			{
				
				if ($request->input($i.'idEmp') != null)
				{
					
					$idEmpleado = $request->input($i.'idEmp');
					
					$empleado = Empleado::find($idEmpleado);
					//Obtiene las horas que debe realizar por contrato
					$horasMesContrato = $this->obtenerHorasContratoMes($fecha, $empleado->id);
					//Obtiene las horas efectivamente trabajadas
					$horasMesTrabajado = $this->obtenerHorasTrabajadasMes($fecha, $empleado->id);
					//dd($horasMesTrabajado[0]);
					$horasADescuento = $this->obtenerHorasDescuentoYExtras($fecha, $horasMesContrato, $horasMesTrabajado[0]);
					
				
				
				}
			}
		
		//1- calcular hr por empleado por si tiene horas de menos o de mas
			//1.1 - descuento de las horas de menos
			//2- calculo sueldo total nominal
			//2.2 caluclar antiguedad (transporte no tiene)
			//2.3 viaticos 50% para descuentos
			//3- calculos descuentos
			//		irpf, fonasa, bps, frl, calculo deducciones VMD,tasa fija deducciones TFD,
			//4- monto no gravado (50%viaticos)
			//5-sueldo nominal - descuento + monto no gravado
			
	   }
	   catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}
	   
    }

	//Devuelve array con horas que TRABAJO el empleado en el mes indicado.
 	private function obtenerHorasTrabajadasMes ($fecha, $idEmpleado)
	{
		$empleado = Empleado::find($idEmpleado);
		$tiposHoras = TipoHora::All();
		$totalHorasPernocte = 0;
		$totalHorasNocturna = 0;
		$totalHorasEspera = 0;
		$horasTrabajadasMes = collect([]);
		$horasRealizadasMes = collect([]);
			
		for($i=1;$i<=$fecha->daysInMonth;$i++)
		{			
			$horasRealizadasDia = collect([]);
			
			foreach($tiposHoras as $th)
			{				
				$horasReg = RegistroHora::where('idEmpleado','=',$empleado->id)->where('fecha','=',$fecha->year.'-'.$fecha->month.'-'.$i)->where('idTipoHora','=',$th->id)->first();
					
				switch ($th->id)
				{		
					case 1:
					//hora común	
							$horasRealizadasDia->push($i."/".$fecha->month);
							$horasRealizadasDia->push($horasReg->cantHoras);							
						break;
					case 2:
					//hora extra							
							if ($horasReg != null)
							{
								$horasRealizadasDia->push($horasReg->cantHoras);
							}
							else	
							{
								$horasRealizadasDia->push("00:00:00");								
							}
						break;
					case 3:
					//hora espera							
							if ($horasReg != null)
							{
								$tiempoTrabajo = Carbon::createFromTimeString($horasReg->cantHoras);
								//Suma horas
								if ($tiempoTrabajo->hour > 0);
									$totalHorasEspera = $totalHorasEspera + $tiempoTrabajo->hour;
								//Suma minutos
								if ($tiempoTrabajo->minute > 15 && $tiempoTrabajo->minute <= 30)
									$totalHorasEspera = $totalHorasEspera + 0.5;
								
								if ($tiempoTrabajo->minute > 30)
									$totalHorasEspera = $totalHorasEspera + 1;
							}							
						break;
					case 4:
					//hora nocturna						
							if ($horasReg != null)	
							{
								$tiempoTrabajo = Carbon::createFromTimeString($horasReg->cantHoras);
								//Suma horas
								if ($tiempoTrabajo->hour > 0);
									$totalHorasNocturna = $totalHorasNocturna + $tiempoTrabajo->hour;
								//Suma minutos
								if ($tiempoTrabajo->minute > 15 && $tiempoTrabajo->minute <= 30)
									$totalHorasNocturna = $totalHorasNocturna + 0.5;
								
								if ($tiempoTrabajo->minute > 30)
									$totalHorasNocturna = $totalHorasNocturna + 1;									
							}
						break;
					case 5:
					//hora pernocte
							if ($horasReg != null)
							{
								$tiempoTrabajo = Carbon::createFromTimeString($horasReg->cantHoras);
								//Suma horas
								if ($tiempoTrabajo->hour > 0);
									$totalHorasPernocte = $totalHorasPernocte + $tiempoTrabajo->hour;
								//Suma minutos
								if ($tiempoTrabajo->minute > 15 && $tiempoTrabajo->minute <= 30)
									$totalHorasPernocte = $totalHorasPernocte + 0.5;
								
								if ($tiempoTrabajo->minute > 30)
									$totalHorasPernocte = $totalHorasPernocte + 1;
							}							
						break;					
				}
				
			}
			
			$horasRealizadasMes->push($horasRealizadasDia);			
		}
		
		//Asigno array de horas trabajadas a la posición cero.
		$horasTrabajadasMes->push($horasRealizadasMes);
		//Asigno total de horas de Espera/Nocturnidad/Percnote
		$horasTrabajadasMes->push($totalHorasEspera);	
		$horasTrabajadasMes->push($totalHorasNocturna);
		$horasTrabajadasMes->push($totalHorasPernocte);
		
		return $horasTrabajadasMes;
	}

	//Devuelve array con horas que DEBE realizar el empleado en el mes indicado.
	private function obtenerHorasContratoMes($fecha, $idEmpleado)
	{/*1- obtener todos los horairos del empleado
	   2- dia a dia ver si esta dentro de cada horario
	   3- agregar a una coleccion con datos*/
		$dias = Dia::All();
		$horasContratoMes = collect([]);
		$horarios = HorarioEmpleado::where('idEmpleado','=',$idEmpleado)->orderBy('id', 'desc')->get();
			
		for($i=1;$i<=$fecha->daysInMonth;$i++){
			$calendario =collect([]);
			$cargoDia=false;
			
			foreach($horarios as $hr)
			{
				$hrFechaDesde=new Carbon($hr->fechaDesde);
				$hrFechaHasta=new Carbon($hr->fechaHasta);
				$fechaActual=new Carbon($fecha->year."-".$fecha->month."-".$i);
				
				if($cargoDia==false && $fechaActual->between($hrFechaDesde,$hrFechaHasta))
				{
					foreach($dias as $dia){
						if($dia->id==$fechaActual->dayOfWeekIso)
						{
							foreach($hr->horariosPorDia as $hd)
							{
								if($dia->id==$hd->idDia)
								{
									$calendario->push($i."/".$fechaActual->month);
									$calendario->push($hd->cantHoras);
									$calendario->push($hd->idRegistro);
								}
							}
						}							
					}				
					$horasContratoMes->push($calendario);
					$cargoDia=true;
				}
			}
		}
		
		return $horasContratoMes;					
	}	

	//Devuelve la cantidad de horas comunes a descontar y horas extras dobles y 2.5 a pagar
	private function obtenerHorasDescuentoYExtras($fecha, $horasMesContrato, $horasMesTrabajado)
	{
		$cantHorasDescuento = 0;
		$cantHorasExtrasA = 0;
		$cantHorasExtrasB = 0;
		 
		$horasEmpl = collect([]);
		//dd( $horasMesTrabajado[0][1]);
		
		for($i=0;$i<$fecha->daysInMonth;$i++)
		{
			//Suma de horas a descontar por diferencia
			if ($horasMesContrato[$i][1] != $horasMesTrabajado[$i][1])
			{
				$horaContrato = Carbon::createFromTimeString($horasMesContrato[$i][1]);
				$horaReal = Carbon::createFromTimeString($horasMesTrabajado[$i][1]);
				$difHora = $horaContrato->hour - $horaReal->hour;
				
				$cantHorasDescuento = $cantHorasDescuento + $difHora;
			}
			
			$horasExtrasDia = Carbon::createFromTimeString($horasMesTrabajado[$i][2]);
			//Suma de horas Extras
			switch ($horasMesContrato[$i][2])
			{
				case 1:
						//JORNADA COMPLETA
						if ($horasExtrasDia->hour > 0) 
							$cantHorasExtrasA = $cantHorasExtrasA + $horasExtrasDia->hour;
						//Suma minutos
						if ($horasExtrasDia->minute > 15 && $horasExtrasDia->minute <= 30)
							$cantHorasExtrasA = $cantHorasExtrasA + 0.5;
						
						if ($horasExtrasDia->minute > 30)
							$cantHorasExtrasA = $cantHorasExtrasA + 1;					
					break;
				case 2:
					//MEDIO DIA
						if ($horasExtrasDia->hour >= 0 && $horasExtrasDia->hour <= 4) 
						{
							$cantHorasExtrasA = $cantHorasExtrasA + $horasExtrasDia->hour;
							
							if ($horasExtrasDia->hour < 4 )
							{//Suma minutos
								if ($horasExtrasDia->minute > 15 && $horasExtrasDia->minute <= 30)
									$cantHorasExtrasA = $cantHorasExtrasA + 0.5;
								
								if ($horasExtrasDia->minute > 30)
									$cantHorasExtrasA = $cantHorasExtrasA + 1;		
							}
							else
							{//Suma minutos
								if ($horasExtrasDia->minute > 15 && $horasExtrasDia->minute <= 30)
									$cantHorasExtrasB = $cantHorasExtrasB + 0.5;
								
								if ($horasExtrasDia->minute > 30)
									$cantHorasExtrasB = $cantHorasExtrasB + 1;	
							}
						}
						else
						{
							$cantHorasExtrasB = $cantHorasExtrasB + $horasExtrasDia->hour;
							
							//Suma minutos
							if ($horasExtrasDia->minute > 15 && $horasExtrasDia->minute <= 30)
								$cantHorasExtrasB = $cantHorasExtrasB + 0.5;
							
							if ($horasExtrasDia->minute > 30)
								$cantHorasExtrasB = $cantHorasExtrasB + 1;	
						}
					break;
				case 3:
					//DESCANSO
					
					break;
			}	
			
		}
		
		
		dd($cantHorasDescuento);
	}
	
	
	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
	}
}
