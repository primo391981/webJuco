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
use App\Contable\Cargo;
use App\Contable\HorarioEmpleado;
use App\Contable\SalarioMinimoCargo;
use App\Contable\ParametroGeneral;
use App\Contable\ReciboEmpleado;
use App\Contable\ConceptoRecibo;
use App\Contable\DetalleRecibo;
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
	
	//Lista los empleados que se encuentran con contrato para el mes/año seleccionado para el cálculo, indicndo si están habilitados con sus horas del mes ya cargadas y totales de Adelantos/Viáticos/Partidas Extras.
	public function listaEmpleados(Request $request){
		try{			
			$empresa=Empresa::where('rut','=',$request->rut)->first();			
			$personas=$empresa->personas;
			$habilitadas=collect([]);
			$cantHabilitados = 0;
			
			foreach($personas as $persona)
			{
				$fecha=new Carbon($request->mes."-01");
				$fDesde=new Carbon($persona->pivot->fechaDesde);
				$fHasta=new Carbon($persona->pivot->fechaHasta);
				if($fecha->between($fDesde,$fHasta))
				{
					$habilita=collect([]);
					$habilita->push($persona);					
					$regHora=RegistroHora::where([['idEmpleado','=',$persona->pivot->id],['fecha','=',$fecha]])->first();
					if($regHora!=null)
					{
						$habilita->push('1');
					}
					else
					{
						$habilita->push('0');
					}
					$pagos=Pago::where([['idEmpleado','=',$persona->pivot->id],['fecha','=',$fecha]])->get();
					
					$totalViaticos=0;
					$totalAdelantos=0;
					$totalExtras=0;
					
					foreach($pagos as $p)
					{
						if($p->idTipoPago==1)
						{
							$totalViaticos+=$p->monto;
						}
						else
						{
							if ($p->idTipoPago==2)
							{
								$totalAdelantos+=$p->monto;
							}
							else
							{
								$totalExtras+=$p->monto;
							}
						}
						
					}
					
					$habilita->push($totalViaticos);
					$habilita->push($totalAdelantos);
					$habilita->push($totalExtras);
					
					$habilitadas->push($habilita);
					//dd($habilitadas);
					$cantHabilitados ++;
				}
				
			}
			return view('contable.haberes.listaEmpleadosHaberes', ['habilitadas' => $habilitadas, 'calculo' => $request->calculo, 'fecha' => $fecha, 'cantHabilitados' => $cantHabilitados]);			
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}		
	}

  
    public function create()
    {
        //
    }

	//Guarda los datos del cálculo de sueldos con los detalles correspondientes al recibo del mismo.
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
		//try{
		   $sueldoNominalGravado = 0;
		   $sueldoNominalNoGravado = 0;
		   $montoHorasFaltantes = 0;
		   $montoAntiguedad = 0;
		   
		   $fecha = new Carbon($request->fecha);
		   
			for ( $i = 1; $i <= $request->cantHabilitados; $i++)
			{//Recorre los empleados de la empresa.
				$datosRecibo = collect([]);
					
				if ($request->input($i.'idEmp') != null)
				{//Cálcula sueldo de cada empleado					
					$idEmpleado = $request->input($i.'idEmp');
					
					$empleado = Empleado::find($idEmpleado);
					
					$cargo = Cargo::find($empleado->idCargo);
					
					if ($cargo->id_remuneracion == 1)
					{//El empleado es mensual.
						//Obtiene las horas que debe realizar por contrato
						$horasMesContrato = $this->obtenerHorasContratoMes($fecha, $empleado->id);
						//Obtiene las horas efectivamente trabajadas
						$horasMesTrabajado = $this->obtenerHorasTrabajadasMes($fecha, $empleado->id);
						//Obtiene las horas a descontar, Horas Extras y Horas Extras Especiales
						$horasRecibo = $this->obtenerHorasDescuentoYExtras($fecha, $horasMesContrato, $horasMesTrabajado[0]);
						//Agregar horas de nocturnidad, percnote y espera.
						$horasRecibo->push($horasMesTrabajado[1]);//Horas Espera
						$horasRecibo->push($horasMesTrabajado[2]);//Horas Nocturnidad
						$horasRecibo->push($horasMesTrabajado[3]);//Horas Percnote
							
						//Cálcula Antigüedad si corresponde						
						$montoAntiguedad = $this->obtenerAntiguedad($fecha, $empleado, $cargo);
					}
					//Obtiene monto de Salario Nominal Gravado y no Gravado, sumando todos los conceptos (víaticos y partidas extras)
					$montoSalario = $this->obtenerMontosSalarioNominal($fecha, $empleado, $cargo, $horasRecibo, $montoAntiguedad);
					//Carga Detalles
					$total=collect([]);
					$cant=count($montoSalario);
					
					for($j=0;$j<$cant;$j++){
						$detalle=collect([]);						
						$cantParam=$montoSalario[$j];
						
						for($x=1;$x<=$cantParam;$x++){
							$detalle->push($montoSalario[$j+$x]);
						}
						$j=$j+$cantParam;
						$total->push($detalle);
					}
					
					dd($total);
					
					//Descuentos
					//Valor de BPC del mes a calcular
					$valorBPC = $this->obtenerValorActual($fecha, 'BPC');
	
					//Cálculo de descuento de Fonasa (porcentaje, monto)
					$valoresFonasa = $this->obtenerDescuentoFonasa($empleado, $montoSalario[28], $valorBPC);
					
					$porcFonasa = $valoresFonasa[0];
					$descFonasa = $valoresFonasa[1];
					
					//Cálculo de descuento de BPS
					$porcBPS = $this->obtenerValorActual($fecha, 'BPS');
					
					$descBPS = $montoSalario[28] * ($porcBPS / 100);
					
					//Cálculo de descuento de FRL
					$porcFRL = $this->obtenerValorActual($fecha, 'FRL');

					$descFRL = $montoSalario[28] * ($porcFRL / 100);
					
					//Sumar 6% si Salario Nominal Gravado supera 10 BPC
					if ($montoSalario[28] >= (10 * $valorBPC))
						$montoSalario[28] = $montoSalario[28] * 1.06;
					
					//Cálculo de descuento de IRPF Primario
					$descIRPFPrimario = $this->obtenerDescuentoIRPFPrimario($fecha, $empleado, $montoSalario[28], $valorBPC);
					//Cálculo de deducciones de IRPF
					$aportesSegSoc = $descFonasa + $descBPS + $descFRL;
					
					$deducionesIRPF = $this->obtenerDeduccionesIRPF($fecha, $empleado, $montoSalario[28], $valorBPC, $aportesSegSoc);
					//IRPF final a pagar
					$descIRPF = $descIRPFPrimario - $deducionesIRPF;
					
					if ($descIRPF < 0)
						$descIRPF = 0;
										
					//Cálculo Sueldo Luíqido
					$sueldoLiquido = $empleado->monto - $aportesSegSoc - $descIRPF;
					
					//Guarda encabezado del recibo
					$recibo = new ReciboEmpleado;
					$recibo->idEmpleado = $empleado->id;
					$recibo->idTipoRecibo = 1; //Sueldo
					$hoy = Carbon::today();
					$recibo->fechaRecibo = $hoy->year.'-'.$hoy->month.'-'.$hoy->day;
					$recibo->fechaPago = $hoy->year.'-'.$hoy->month.'-'.$hoy->day;
					
					$recibo->save();
					
					$UltimoReciboEmpleado = ReciboEmpleado::where('idEmpleado','=',$empleado->id)->orderBy('id','desc')->first();
					
					//Guarda detalles del recibo
					$detalleRecibo = new DetalleRecibo;
					
						
				
				dd($montoSalario[28].' '.$descBPS.' '.$descFonasa.' '.$descFRL.' Suma: '.($descBPS+$descFonasa+$descFRL).' Deducciones '.$deducionesIRPF.' IRPF Primario '.$descIRPFPrimario.' DescIRPF: '.$descIRPF.' Sueldo Liq:'.$sueldoLiquido);
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
			
	  /* }
	   catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema.");
		}
	   */
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
			
		for($i=0;$i<$fecha->daysInMonth;$i++)
		{
			//Suma de horas a descontar por diferencia
			if ($horasMesContrato[$i][1] != $horasMesTrabajado[$i][1])
			{
				$horaContrato = Carbon::createFromTimeString($horasMesContrato[$i][1]);
				$horaReal = Carbon::createFromTimeString($horasMesTrabajado[$i][1]);
				$difHora = $horaContrato->hour - $horaReal->hour;
				
				$cantHorasDescuento = $cantHorasDescuento - $difHora;
			}
			//dd($cantHorasDescuento);
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
							$cantHorasExtrasA = $cantHorasExtrasA + 4;
							
							$cantHorasExtrasB = $cantHorasExtrasB + ($horasExtrasDia->hour - 4);
							
							//Suma minutos
							if ($horasExtrasDia->minute > 15 && $horasExtrasDia->minute <= 30)
								$cantHorasExtrasB = $cantHorasExtrasB + 0.5;
							
							if ($horasExtrasDia->minute > 30)
								$cantHorasExtrasB = $cantHorasExtrasB + 1;	
						}
					break;
				case 3:
					//DESCANSO
						if ($horasExtrasDia->hour >= 0 && $horasExtrasDia->hour <= 8) 
						{
							$cantHorasExtrasA = $cantHorasExtrasA + $horasExtrasDia->hour;
							
							if ($horasExtrasDia->hour < 8 )
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
							$cantHorasExtrasA = $cantHorasExtrasA + 8;
							$cantHorasExtrasB = $cantHorasExtrasB + ($horasExtrasDia->hour - 8);
							
							//Suma minutos
							if ($horasExtrasDia->minute > 15 && $horasExtrasDia->minute <= 30)
								$cantHorasExtrasB = $cantHorasExtrasB + 0.5;
							
							if ($horasExtrasDia->minute > 30)
								$cantHorasExtrasB = $cantHorasExtrasB + 1;	
						}
					break;
			}			
		}
			
		$horasEmpl->push($cantHorasDescuento);
		$horasEmpl->push($cantHorasExtrasA);
		$horasEmpl->push($cantHorasExtrasB);
			
		return $horasEmpl;
	}
	
	//Obtiene el monto de la antiguedad del empleado
	private function obtenerAntiguedad($fecha, $empleado, $cargo)
	{/*Precondicion: Empleado con cargo mensual.
	Antigüedad:
		- 19 meses = 1,25 x SMN x años (1 años y 7 meses)
		- 60 meses = 2,25 x SMN x años (5 años)
		-120 meses = 2,5  x SMN x años (10 años)
		-180 meses en adelante: 
			tope = 2,5 x SMN x 15	
	*/	
		$valorAntiguedad = 0;
		
		$salarioMinimos = SalarioMinimoCargo::where("idCargo", "=", $cargo->id)->orderBy('id', 'desc')->get();
	
		//Obtiene SMN correspondiente a la fecha de cálculo para el cargo del empleado
		foreach ($salarioMinimos as $smn)
		{
			$fechaInicio = new Carbon($smn->fechaDesde);
			
			if ($smn->fechaHasta == null)
			{
				if ($fechaInicio <= $fecha)
				{
					$salMin = $smn->monto;
					$break;
				}
			}
			else
			{
				$fechaFin = new Carbon($smn->fechaHasta);
				
				if ($fechaInicio <= $fecha && $fechaFin >= $fecha)
				{
					$salMin = $smn->monto;
					$break;
				}					
			}
		}
			
		$fecha->addMonth();
		$fechaInicio = new Carbon($empleado->fechaDesde);
		 
		$meses = $fechaInicio->diffInMonths($fecha);

		if ($meses >= 19 && $meses < 60)
			$valorAntiguedad = $salMin * 0.0125 * (intval($meses / 12));
		else
		{
			if ($meses >= 60 && $meses < 120)
				$valorAntiguedad = $salMin * 0.0225 * (intval($meses / 12));
			else
			{
				if ($meses >= 120 && $meses < 180)
					$valorAntiguedad = $salMin * 0.025 * (intval($meses / 12));
				else
				{
					if ($meses >= 180)
						$valorAntiguedad = $salMin * 0.025 * 15;
				}
			}
		}
		
		return $valorAntiguedad;
	}
	
	//Obtiene los montos de Salario Nominal Gravado y no Gravado.
	private function obtenerMontosSalarioNominal($fecha, $empleado, $cargo, $horasRecibo, $montoAntiguedad)
	{
		$salNominalGravado = 0;
		$salNominalNoGravado = 0;
		$salarios = collect([]);
		
		if ($cargo->id_remuneracion == 1)
		{//El empleado es mensual.
			//Horas del mes
			if ($horasRecibo[0] == 0)
			{
				$salNominalGravado = $empleado->monto;
			}
			else
			{
				$salNominalGravado = $empleado->monto - ($empleado->valorHora * $horasRecibo[0]); 
			}
			$salarios->push(2);
			$salarios->push(1);
			$salarios->push($salNominalGravado);
			
			//Horas extras
			$salNominalGravado += ($empleado->valorHora * 2) * $horasRecibo[1];
			
			$salarios->push(3);
			$salarios->push(2);
			$salarios->push(($empleado->valorHora * 2) * $horasRecibo[1]);
			$salarios->push($horasRecibo[1]);
			
			$salNominalGravado += ($empleado->valorHora * 2.5) * $horasRecibo[2];
			
			$salarios->push(3);
			$salarios->push(3);
			$salarios->push(($empleado->valorHora * 2.5) * $horasRecibo[2]);
			$salarios->push($horasRecibo[2]);
			
			//Horas Espera/Nocturna/Percnote
			$salNominalGravado += ($empleado->valorHora * 2 * 0.175) * $horasRecibo[3];
			
			$salarios->push(3);
			$salarios->push(11);
			$salarios->push(($empleado->valorHora * 2 * 0.175) * $horasRecibo[3]);
			$salarios->push($horasRecibo[3]);
			
			$salNominalGravado += ($empleado->valorHora * 0.20) * $horasRecibo[4];
			
			$salarios->push(3);
			$salarios->push(12);
			$salarios->push(($empleado->valorHora * 0.20) * $horasRecibo[4]);
			$salarios->push($horasRecibo[4]);
			
			$salNominalGravado += ($empleado->valorHora * 2 * 0.175) * $horasRecibo[5];
			
			$salarios->push(3);
			$salarios->push(13);
			$salarios->push(($empleado->valorHora * 2 * 0.175) * $horasRecibo[5]);
			$salarios->push($horasRecibo[5]);
			
			//Antigüedad
			$salNominalGravado += $montoAntiguedad;
			
			$salarios->push(2);
			$salarios->push(19);
			$salarios->push($montoAntiguedad);
			
			//Obtiene los pagos
			$pagos=Pago::where([['idEmpleado','=',$empleado->id],['fecha','=',$fecha]])->get();
			//Recorre Pagos
			foreach($pagos as $p)
			{
				if($p->idTipoPago==1 || $p->idTipoPago==3)
				{
					if($p->gravado == 1)
					{
						$salNominalGravado += $p->monto * ($p->porcentaje / 100);
						$salNominalNoGravado += $p->monto * (1 - $p->porcentaje / 100);
					}
					else
						$salNominalNoGravado += $p->monto;
				}				
			}
		}
		
		$salarios->push(2);
		$salarios->push(4);
		$salarios->push($salNominalGravado);
		
		$salarios->push(2);
		$salarios->push(5);
		$salarios->push($salNominalNoGravado);
		
		return $salarios;
	}
	
	//Devuelve el valor del parametro vigente en la fecha indicada.
	private function obtenerValorActual($fecha, $nombreParam)
	{
		$valor = 0;
		
		$valores = ParametroGeneral::where('nombre','=',$nombreParam)->orderBy('id','desc')->get();
		
		foreach ($valores as $bp)
		{
			if ( $bp->fecha_fin == null && $bp->fecha_desde <= $fecha)
			{
				$valor = $bp->valor;
				$break;
			}
			else
			{				
				if ($bp->fecha_desde <= $fecha &&  $bp->fecha_fin >= $fecha)
				{
					$valor = $bp->valor;
					$break;
				}			
			}
		}
		
		return $valor;
	}
	
		
	//Devuelve el porcentaje de descuento Fonasa y el valor del mismo para el empleado
	private function obtenerDescuentoFonasa($empleado, $montoSalario, $valorBPC)
	{
		$montoBPC = $valorBPC * 2.5;
		$porcentaje = 0;
		$montoFonasa = 0;
		$nombre = "";
		$descFonasa = collect([]);
			
		if($empleado->persona->estadoCivil == 2 || $empleado->persona->estadoCivil == 3)
		{
			if($montoSalario <= $montoBPC)
			{
				if ($empleado->persona->cantHijos > 0)
				{
					$nombre = "FONASA4";
				}
				else
					$nombre = "FONASA3";
			}
			else
			{
				if ($empleado->persona->cantHijos > 0)
					$nombre = "FONASA8";
				else
					$nombre = "FONASA7";
			}
		}
		else
		{
			if($montoSalario <= $montoBPC)
			{
				if ($empleado->persona->cantHijos > 0)
					$nombre = "FONASA2";
				else
					$nombre = "FONASA1";
			}
			else
			{
				if ($empleado->persona->cantHijos > 0)
					$nombre = "FONASA6";
				else
					$nombre = "FONASA5";
			}
		}
		
		$fonasa = ParametroGeneral::where('nombre','=',$nombre)->first();
		
		$porcentaje = $fonasa->valor;
		$montoFonasa = $montoSalario * ($fonasa->valor / 100);
		
		$descFonasa->push($porcentaje);
		$descFonasa->push($montoFonasa);
		$descFonasa->push($fonasa->nombre);
		
		return $descFonasa;
	}
	
	//Devuelve monto de IRPF Primario
	private function obtenerDescuentoIRPFPrimario($fecha, $empleado, $montoSalario, $valorBPC)
	{
		$franjasIRPF = collect([]);
		$montoIRPF = 0;
		
		for ($i=1; $i <= 8; $i++)
		{
			$valores = ParametroGeneral::where('nombre','=','IRPF'.$i)->orderBy('id','desc')->get();
		
			foreach ($valores as $irpf)
			{
				if ( $irpf->fecha_fin == null && $irpf->fecha_desde <= $fecha)
				{
					$franjasIRPF->push($irpf);
					$break;
				}
				else
				{				
					if ($irpf->fecha_desde <= $fecha &&  $irpf->fecha_fin >= $fecha)
					{
						$franjasIRPF->push($irpf);
						$break;
					}			
				}
			}			
		}
		$encontre = false;
		$j=0;
		$montoDiferencia = 0;
		
		while (!$encontre)
		{
			$montoMin = $franjasIRPF[$j]->minimo * $valorBPC;
			
			if ($franjasIRPF[$j]->maximo <> NULL)
			{
				$montoMax = $franjasIRPF[$j]->maximo * $valorBPC;
			
				if ($montoSalario <= $montoMax)
				{
					$montoIRPF += ($montoSalario - $montoDiferencia) * ($franjasIRPF[$j]->valor / 100);
					$encontre = true;
				}
				else
				{
					$montoIRPF += ($montoMax - $montoDiferencia) * ($franjasIRPF[$j]->valor / 100);
					$montoDiferencia = $montoMax;
				}
			}
			else
			{
				$montoIRPF += ($montoSalario - $montoDiferencia) * ($franjasIRPF[$j]->valor / 100);
				$encontre = true;
			}
			
			$j++;
		}
		
		return($montoIRPF);
	}
	
	//Devuelve monto de deducciones IRPF
	private function obtenerDeduccionesIRPF($fecha, $empleado, $montoSalario, $valorBPC, $aportesSegSoc)
	{
		$valorDeducciones = 0;
		
		//VMD1 = 13*VALOR BPC/12
		$vmd1 = $this->obtenerValorActual($fecha, 'VMD1');
		$hijosMenores = $vmd1 * $empleado->persona->cantHijos;
		
		//VMD2 = 26*VALOR BPC/12
		$vmd2 = $this->obtenerValorActual($fecha, 'VMD2');
		$conDiscapacidad = $vmd2 * $empleado->persona->conDiscapacidad;
		
		$sumaDeducciones = $aportesSegSoc + $hijosMenores + $conDiscapacidad;
	
		//Tasa de Deducción
		if( $sumaDeducciones <= (15 * $valorBPC))
			$valorDeducciones = $sumaDeducciones * 0.1;
		else
			$valorDeducciones = $sumaDeducciones * 0.08;
		
		return ($valorDeducciones);
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
