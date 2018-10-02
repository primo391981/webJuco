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
use App\Contable\Feriado;
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
		
		$tiposHaberes = TipoRecibo::All();		
        return view('contable.haberes.listaEmpresasHaberes', ['empresas' => $empresas, 'tiposHaberes' => $tiposHaberes]);
    }
	
	//Lista los empleados que se encuentran con contrato para el mes/año seleccionado para el cálculo, indicndo si están habilitados con sus horas del mes ya cargadas y totales de Adelantos/Viáticos/Partidas Extras.
	public function listaEmpleados(Request $request){
		try{			
			$empresa=Empresa::where('rut','=',$request->rut)->first();			
			$habilitadas=collect([]);
			$cantHabilitados = 0;
			$hayUno=false;

			$fechaAux = new Carbon($request->mes."-01");
			
			switch ($request->calculo)
			{
				case 1:
				case 4:	
				case 5: $fecha = new Carbon($request->mes."-".$fechaAux->daysInMonth);
					break;
				case 2: $fecha=new Carbon($fechaAux->year."-05-31");
					break;
				case 3: $fecha=new Carbon($fechaAux->year."-11-30");		
					break;
			}
				
			if ($request->calculo == 5)
				$personas=$empresa->personas()->where('habilitado','=',0)->get();
			else
				$personas=$empresa->personas()->where('habilitado','=',1)->get();
			
			foreach($personas as $persona)
			{						
				$fDesde=new Carbon($persona->pivot->fechaDesde);
				$fHasta=new Carbon($persona->pivot->fechaHasta);
				//Verifica si el empleado tiene contrato vigente
				if($fecha->between($fDesde,$fHasta))
				{
					$habilita=collect([]);
					$habilita->push($persona);					
					
					switch ($request->calculo)
					{
						case 1:
								$regHora=RegistroHora::where([['idEmpleado','=',$persona->pivot->id],['fecha','=',$fecha]])->first();
						
								if($regHora!=null)
								{
									$habilita->push('1');
									$hayUno=true;
								}
								else
								{
									$habilita->push('0');
								}
								$pagos=Pago::where([['idEmpleado','=',$persona->pivot->id],['fecha','=',$fechaAux]])->get();
								
								$totalViaticos=0;
								$totalAdelantos=0;
								$totalExtras=0;
								$totalFictos=0;
								foreach($pagos as $p)
								{
									if($p->idTipoPago==1)
									{										
										$totalViaticos+=$p->monto*$p->cantDias;
									}
									else
									{
										if ($p->idTipoPago==2)
										{
											$totalAdelantos+=$p->monto;
										}
										else
										{
											if($p->idTipoPago==3){
												$totalExtras+=$p->monto;
											}
											else{
												$totalFictos+=$p->monto;
											}
											
										}
									}									
								}
								
								$habilita->push($totalViaticos);
								$habilita->push($totalAdelantos);
								$habilita->push($totalExtras);
								$habilita->push($totalFictos);
								
							break;
						case 2:
								$i = 12;
								$anio = $fecha->year - 1;
								
								while($i!=6)
								{
									$recibo = ReciboEmpleado::where([['idEmpleado','=',$persona->pivot->id],['idTipoRecibo','=',1],['fechaRecibo', '=', $anio.'-'.$i.'-01']])->first();
									
									if ($recibo != null)
									{
										$detalleNominal = $recibo->detallesRecibos->where('idConceptoRecibo','=',13)->first();
										$habilita->push($detalleNominal->monto);
									}
									else
										$habilita->push(0);
									
									if ($i == 12)
									{
										$i = 1;
										$anio ++;
									}
									else
										$i ++;									
								}
							break;
						case 3:
								$i = 6;
								$anio = $fecha->year;
								
								while($i!=12)
								{									
									$recibo = ReciboEmpleado::where([['idEmpleado','=',$persona->pivot->id],['idTipoRecibo','=',1],['fechaRecibo', '=', $anio.'-'.$i.'-01']])->first();
									
									if ($recibo != null)
									{
										$detalleNominal = $recibo->detallesRecibos->where('idConceptoRecibo','=',13)->first();
										$habilita->push($detalleNominal->monto);
									}
									else
									{
										$habilita->push(0);
									}
									
									$i ++;									
								}								
							break;
					}
					
					$habilitadas->push($habilita);
					$cantHabilitados ++;
					
				}				
			}

			switch ($request->calculo)
			{
				case 1:
						return view('contable.haberes.listaEmpleadosHaberes', ['habilitadas' => $habilitadas, 'calculo' => $request->calculo, 'fecha' => $fecha, 'cantHabilitados' => $cantHabilitados, 'hayUnoHab'=>$hayUno]);	
					break;
				case 2: 
						return view('contable.haberes.listaEmpleadosAguinaldo', ['habilitadas' => $habilitadas, 'calculo' => $request->calculo, 'fecha' => $fecha, 'cantHabilitados' => $cantHabilitados]);	
					break;
				case 3: 
						return view('contable.haberes.listaEmpleadosAguinaldo', ['habilitadas' => $habilitadas, 'calculo' => $request->calculo, 'fecha' => $fecha, 'cantHabilitados' => $cantHabilitados]);
					break;
				case 4: 
						$diaMax = $fecha->daysInMonth;
						
						return view('contable.haberes.listaEmpleadosSalVacacional', ['habilitadas' => $habilitadas, 'calculo' => $request->calculo, 'fecha' => $fecha, 'diaMax' => $diaMax,'cantHabilitados' => $cantHabilitados]);
					break;
				case 5: 
						return view('contable.haberes.listaEmpleadosLiquidacion', ['habilitadas' => $habilitadas, 'calculo' => $request->calculo, 'fecha' => $fecha, 'cantHabilitados' => $cantHabilitados]);
					break;
			}
			
		}
		catch(Exception $e)
		{ 
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
		$sueldoNominalGravado = 0;
		$sueldoNominalNoGravado = 0;
		$montoHorasFaltantes = 0;
		$montoAntiguedad = 0;

		$fecha = new Carbon($request->fecha);
		$empleadosRecibo=collect([]);
	   
		for ( $i = 1; $i <= $request->cantHabilitados; $i++)
		{//Recorre los empleados de la empresa.
			$datosRecibo = collect([]);
				
			if ($request->input($i.'hab') != null)
			{//Cálcula sueldo de cada empleado					
				$idEmpleado = $request->input($i.'hab');
				
				$empleado = Empleado::find($idEmpleado);
				
				$cargo = Cargo::find($empleado->idCargo);
				
				if ($cargo->id_remuneracion == 1 && $empleado->tipoHorario==1)
				{//El empleado es mensual y horario habitual.
					
						//Obtiene las horas que debe realizar por contrato
						$horasMesContrato = $this->obtenerHorasContratoMes($fecha, $empleado->id, $fecha->daysInMonth);
						//Obtiene las horas efectivamente trabajadas
						$horasMesTrabajado = $this->obtenerHorasTrabajadasMes($fecha, $empleado->id, $fecha->daysInMonth);
						//Obtiene las horas a descontar, Horas Extras y Horas Extras Especiales
						$horasRecibo = $this->obtenerHorasDescuentoYExtras($fecha, $fecha->daysInMonth, $cargo, $horasMesTrabajado[0], $horasMesContrato);
				} 
				else
				{
					//El empleado es mensual y horario flexible  o jornalero
					$horasMesTrabajado = $this->obtenerHorasTrabajadasMes($fecha, $empleado->id, $fecha->daysInMonth);
					$horasRecibo = $this->obtenerHorasDescuentoYExtras($fecha, $fecha->daysInMonth, $cargo, $horasMesTrabajado[0]);
				}
				
				/*Horas Recibo contiene: 
				-Horas Descuento o horas Jornal
				-Horas Extras en Día común
				-Horas  Descanso Trabajado
				-Horas Extras Descanso Trabajado*/
				//Agregar horas de nocturnidad, percnote, espera y Descanso Intermedio Trabajado.
				$horasRecibo->push($horasMesTrabajado[1]);//Horas Espera
				$horasRecibo->push($horasMesTrabajado[2]);//Horas Nocturnidad
				$horasRecibo->push($horasMesTrabajado[3]);//Horas Percnote
				$horasRecibo->push($horasMesTrabajado[4]);//Horas Trabajadas Descanso Intermedio
				$horasRecibo->push($request->input('lic'.$i));//Días de Licencia Gozados
				
				//Cálcula Antigüedad si corresponde						
				$montoAntiguedad = $this->obtenerAntiguedad($fecha, $empleado, $cargo);
				
				//Obtiene monto de Salario Nominal Gravado y no Gravado, sumando todos los conceptos (víaticos y partidas extras)
				$montoSalario = $this->obtenerMontosSalarioNominal($fecha, $empleado, $cargo, $horasRecibo, $montoAntiguedad);
				
				//Monto del salario Gravado	
				$montoSalarioGravado = $montoSalario[40];
				//Descuentos
				//Valor de BPC del mes a calcular
				$valorBPC = $this->obtenerValorActual($fecha, 'BPC');

				//Cálculo de descuento de Fonasa (porcentaje, monto)
				$valoresFonasa = $this->obtenerDescuentoFonasa($empleado, $montoSalarioGravado, $valorBPC);
				
				$porcFonasa = $valoresFonasa[0];
				$descFonasa = $valoresFonasa[1];
				$datosRecibo->push($this->obtenerDetalle(15,$descFonasa,$porcFonasa));
				
				//Cálculo de descuento de BPS
				$porcBPS = $this->obtenerValorActual($fecha, 'BPS');
				$descBPS = $montoSalarioGravado * ($porcBPS / 100);
				$datosRecibo->push($this->obtenerDetalle(14,$descBPS,$porcBPS));
				
				//Cálculo de descuento de FRL
				$porcFRL = $this->obtenerValorActual($fecha, 'FRL');
				$descFRL = $montoSalarioGravado * ($porcFRL / 100);
				$datosRecibo->push($this->obtenerDetalle(18,$descFRL,$porcFRL));
				
				//Obtener Salario Vacacional del mes y sumarlo al Salario para cálculo de IRPF
				$montoSalVacacional = $this->obtenerMontoSalVacaional($fecha,$empleado);
				$datosRecibo->push($this->obtenerDetalle(24,$montoSalVacacional,'NA'));
				
				//Subtotal No Gravado
				$montoSalario[43] += $montoSalVacacional;
				//Subtotal Nominal
				$montoSalario[46] += $montoSalVacacional;
				
				//Monto del salario SubTotal Nominal
				$montoSubTotalNominal = $montoSalario[46];
	
				//Carga Detalles del recibo
				$cant=count($montoSalario);					
				for($j=0;$j<$cant;$j++){
					$detalle=collect([]);						
					$cantParam=$montoSalario[$j];
					
					for($x=1;$x<=$cantParam;$x++){
						$detalle->push($montoSalario[$j+$x]);
					}
					$j=$j+$cantParam;
					$datosRecibo->push($detalle);
				}
				
				//Sumar 6% si Salario Nominal Gravado + SalarioVacacional supera 10 BPC
				if ($montoSubTotalNominal >= (10 * $valorBPC))
					$montoSubTotalNominal = $montoSubTotalNominal * 1.06;
				
				//Cálculo de descuento de IRPF Primario
				$descIRPFPrimario = $this->obtenerDescuentoIRPFPrimario($fecha, $empleado, $montoSubTotalNominal, $valorBPC);
				
				//Cálculo de deducciones de IRPF
				$aportesSegSoc = $descFonasa + $descBPS + $descFRL;
				$deducionesIRPF = $this->obtenerDeduccionesIRPF($fecha, $empleado, $montoSubTotalNominal, $valorBPC, $aportesSegSoc);
				
				//IRPF final a pagar
				$descIRPF = $descIRPFPrimario - $deducionesIRPF;
				
				if ($descIRPF < 0){
					$descIRPFPrimario=0;
					$deducionesIRPF=0;
				}
				
				$datosRecibo->push($this->obtenerDetalle(16,$descIRPFPrimario,'NA'));
				$datosRecibo->push($this->obtenerDetalle(17,$deducionesIRPF,'NA'));
				
				//Adelantos de empleado
				$montoAdelanto=$this->obtenerPagos($fecha,$empleado,2);
				$datosRecibo->push($this->obtenerDetalle(19,$montoAdelanto,'NA'));
				
				//Viaticos empleado
				$montoViatico=$this->obtenerPagos($fecha,$empleado,1);
				$datosRecibo->push($this->obtenerDetalle(10,$montoViatico,'NA'));
				
				//Suma de descuentos
				$sumaDescuentos=$aportesSegSoc + $descIRPF + $montoAdelanto;
				$datosRecibo->push($this->obtenerDetalle(20,$sumaDescuentos,'NA'));
				
				//Cálculo Sueldo Luíqido
				$sueldoLiquido = $montoSalario[46] - $sumaDescuentos - $montoViatico;//Agregar Fictos
				$datosRecibo->push($this->obtenerDetalle(21,$sueldoLiquido,'NA'));
				
				//Guarda encabezado del recibo
				$recibo = new ReciboEmpleado;
				$recibo->idEmpleado = $empleado->id;
				$recibo->idTipoRecibo = 1; //Sueldo
				$hoy = Carbon::today();

				$recibo->fechaRecibo = $fecha->year.'-'.$fecha->month.'-01';
				$recibo->fechaPago = $hoy->year.'-'.$hoy->month.'-'.$hoy->day;
				
				$existe = ReciboEmpleado::where([['idEmpleado','=',$empleado->id],['idTipoRecibo','=',$request->calculo], ['fechaRecibo','=',$recibo->fechaRecibo]])->first();
		
				if ($existe == null)
					$recibo->save();
				else
				{
					$dt = DetalleRecibo::where('idRecibo','=',$existe->id)->delete();
					$existe->delete();
					
					$recibo->save();
				}
				
				$UltimoReciboEmpleado = ReciboEmpleado::where([['idEmpleado','=',$empleado->id],['idTipoRecibo','=',$request->calculo], ['fechaRecibo','=',$recibo->fechaRecibo]])->first();
				
				//Guarda detalles del recibo
				foreach($datosRecibo as $dtr)
				{
					if ($dtr[0]!=0)
					{
						$detalleRecibo = new DetalleRecibo;
						/*$table->integer('idConceptoRecibo')->unsigned();
						$table->decimal('cantDias', 4, 1);
						$table->decimal('cantHoras', 4, 1);
						$table->decimal('monto', 8, 2);
						$table->decimal('porcentaje', 8, 2);
						*/
						$detalleRecibo->idConceptoRecibo=$dtr[0];
						if($dtr[0]==9)
						{//Días de Licencia Gozada
							$detalleRecibo->cantDias = $dtr[2];
						}
						else
							$detalleRecibo->cantDias = 0;
						
						if(($dtr[0]>=2 && $dtr[0]<=7) || $dtr[0]==22)
						{
							$detalleRecibo->cantHoras=$dtr[2];
						}
						else{
							$detalleRecibo->cantHoras=0;							
						}						
						
						$detalleRecibo->monto=$dtr[1];	
						
						if($dtr[0]==14 || $dtr[0]==15 || $dtr[0]==18)
						{//BPS/Fonasa/FRL
								$detalleRecibo->porcentaje=$dtr[2];						
						}
						$detalleRecibo->idRecibo=$UltimoReciboEmpleado->id;
						
						$detalleRecibo->save();	
					}
				}
				
				$empleadosRecibo->push($UltimoReciboEmpleado);
			}
		}
		$tipoRecibo = TipoRecibo::find($request->calculo);
		
		return view('contable.haberes.listaEmpleadosRecibos', ['empleadosRecibo' => $empleadosRecibo,'fechaMes'=>$fecha->month,'fechaAnio'=>$fecha->year,'calculo'=>$tipoRecibo]);
				
    }

	//Guarda los datos del cálculo de aguinaldos con los detalles correspondientes al recibo del mismo.
    public function calculoAguinaldo(Request $request)
    {
		$fecha = new Carbon($request->fecha);
		$empleadosRecibo=collect([]);
		
		for ( $i = 1; $i <= $request->cantHabilitados; $i++)
		{//Recorre los empleados de la empresa.
			$datosRecibo = collect([]);
	
			if ($request->input($i.'hab') != null)
			{//Cálcula aguinaldo de cada empleado		
				$idEmpleado = $request->input($i.'hab');
					
				$empleado = Empleado::find($idEmpleado);
				//Suma del monto total de sueldos percibidos el empleado para el cálculo del aguinaldo
				$montoTotal = 0;
				
				switch ($request->calculo)
				{
					case 2:
							$i = 12;
							$anio = $fecha->year - 1;
							
							while($i!=6)
							{
								$recibo = ReciboEmpleado::where([['idEmpleado','=',$empleado->id],['idTipoRecibo','=',1],['fechaRecibo', '=', $anio.'-'.$i.'-01']])->first();
								
								if ($recibo != null)
								{
									$detalleNominal = $recibo->detallesRecibos->where('idConceptoRecibo','=',13)->first();
									$montoTotal += $detalleNominal->monto;
								}
								
								if ($i == 12)
								{
									$i = 1;
									$anio ++;
								}
								else
									$i ++;									
							}
						break;
					case 3:
							$i = 6;
								
							while($i!=12)
							{
								$recibo = ReciboEmpleado::where([['idEmpleado','=',$empleado->id],['idTipoRecibo','=',1],['fechaRecibo', '=', $fecha->year.'-'.$i.'-01']])->first();
								
								if ($recibo != null)
								{
									$detalleNominal = $recibo->detallesRecibos->where('idConceptoRecibo','=',13)->first();
									$montoTotal += $detalleNominal->monto;
								}
									
								$i ++;									
							}
						break;
				}
				//Monto del aguinaldo.
				$montoAguinaldo = $montoTotal / 12;
				//Aguinaldo
				$datosRecibo->push($this->obtenerDetalle(23,$montoAguinaldo,'NA'));
				//Totales
				$datosRecibo->push($this->obtenerDetalle(11,$montoAguinaldo,'NA'));
				$datosRecibo->push($this->obtenerDetalle(12,0,'NA'));
				$datosRecibo->push($this->obtenerDetalle(13,$montoAguinaldo,'NA'));
				
				//Cálculo de Descuentos
				//Valor de BPC del mes a calcular
				$valorBPC = $this->obtenerValorActual($fecha, 'BPC');

				//Cálculo de descuento de Fonasa (porcentaje, monto)
				$valoresFonasa = $this->obtenerDescuentoFonasa($empleado, $montoAguinaldo, $valorBPC);
				
				$porcFonasa = $valoresFonasa[0];
				$descFonasa = $valoresFonasa[1];
				$datosRecibo->push($this->obtenerDetalle(15,$descFonasa,$porcFonasa));
				
				//Cálculo de descuento de BPS
				$porcBPS = $this->obtenerValorActual($fecha, 'BPS');
				$descBPS = $montoAguinaldo * ($porcBPS / 100);
				$datosRecibo->push($this->obtenerDetalle(14,$descBPS,$porcBPS));
				
				//Cálculo de descuento de FRL
				$porcFRL = $this->obtenerValorActual($fecha, 'FRL');
				$descFRL = $montoAguinaldo * ($porcFRL / 100);
				$datosRecibo->push($this->obtenerDetalle(18,$descFRL,$porcFRL));
				
				//Cálculo de aportes Seguridad Social
				$aportesSegSoc = $descFonasa + $descBPS + $descFRL;
				
				//Suma de descuentos
				$datosRecibo->push($this->obtenerDetalle(20,$aportesSegSoc,'NA'));
				
				//Cálculo Aguinaldo Luíqido
				$aguinaldoLiquido = $montoAguinaldo - $aportesSegSoc;
				$datosRecibo->push($this->obtenerDetalle(21,$aguinaldoLiquido,'NA'));
				
				//Guarda encabezado del recibo
				$recibo = new ReciboEmpleado;
				$recibo->idEmpleado = $empleado->id;
				$recibo->idTipoRecibo = $request->calculo;
				$hoy = Carbon::today();
				
				$fecha->addDay();
				$recibo->fechaRecibo = $fecha->year.'-'.$fecha->month.'-'.$fecha->day;
				$recibo->fechaPago = $hoy->year.'-'.$hoy->month.'-'.$hoy->day;
				
				$existe = ReciboEmpleado::where([['idEmpleado','=',$empleado->id],['idTipoRecibo','=',$request->calculo], ['fechaRecibo','=',$recibo->fechaRecibo]])->first();
				
				if ($existe == null)
					$recibo->save();
				else
				{
					$dt = DetalleRecibo::where('idRecibo','=',$existe->id)->delete();
					$existe->delete();
					
					$recibo->save();
				}
				//Obtengo último recibo guardado
				$UltimoReciboEmpleado = ReciboEmpleado::where([['idEmpleado','=',$empleado->id],['idTipoRecibo','=',$request->calculo], ['fechaRecibo','=',$recibo->fechaRecibo]])->first();
					
				//Guarda detalles del recibo
				foreach($datosRecibo as $dtr)
				{
					if ($dtr[0]!=0)
					{
						$detalleRecibo = new DetalleRecibo;
						/*$table->integer('idConceptoRecibo')->unsigned();
						$table->decimal('cantDias', 4, 1);
						$table->decimal('cantHoras', 4, 1);
						$table->decimal('monto', 8, 2);
						$table->decimal('porcentaje', 8, 2);
						*/
						$detalleRecibo->idConceptoRecibo=$dtr[0];
							
						$detalleRecibo->monto=$dtr[1];	
						
						if($dtr[0]==14 || $dtr[0]==15 || $dtr[0]==18)
						{//BPS/Fonasa/FRL
							$detalleRecibo->porcentaje=$dtr[2];						
						}
						
						$detalleRecibo->idRecibo = $UltimoReciboEmpleado->id;
						
						$detalleRecibo->save();	
					}
				}
				
				$empleadosRecibo->push($UltimoReciboEmpleado);
			}
		}
		$tipoRecibo = TipoRecibo::find($request->calculo);
		
		return view('contable.haberes.listaEmpleadosRecibos', ['empleadosRecibo' => $empleadosRecibo,'fechaMes'=>$fecha->month,'fechaAnio'=>$fecha->year,'calculo'=>$tipoRecibo]);
	}
	
	
	//Guarda los datos del cálculo de Salario Vacacional con los detalles correspondientes al recibo del mismo.
    public function calculoSalVacacional(Request $request)
    {
		$fecha = new Carbon($request->fecha);
		$empleadosRecibo=collect([]);
		
		for ( $i = 1; $i <= $request->cantHabilitados; $i++)
		{//Recorre los empleados de la empresa.
			$datosRecibo = collect([]);
	
			if ($request->input($i.'hab') != null)
			{//Cálcula salario vacacional de cada empleado		
				$idEmpleado = $request->input($i.'hab');
					
				$empleado = Empleado::find($idEmpleado);
				//Obtiene cantidad de días de licencia a usufructuar.
				$diasLicencia = $request->input('lic'.$i);
				
				//Obtener monto del salario Nominal
				$salarioNominal = $empleado->monto;
					
				//Cálculo de Descuentos
				//Valor de BPC del mes a calcular
				$valorBPC = $this->obtenerValorActual($fecha, 'BPC');
				//Cálculo de descuento de Fonasa (porcentaje, monto)
				$valoresFonasa = $this->obtenerDescuentoFonasa($empleado, $salarioNominal, $valorBPC);
				
				$porcFonasa = $valoresFonasa[0];
				$descFonasa = $valoresFonasa[1];
				$datosRecibo->push($this->obtenerDetalle(15,0,$porcFonasa));
				
				//Cálculo de descuento de BPS
				$porcBPS = $this->obtenerValorActual($fecha, 'BPS');
				$descBPS = $salarioNominal * ($porcBPS / 100);
				$datosRecibo->push($this->obtenerDetalle(14,0,$porcBPS));
				
				//Cálculo de descuento de FRL
				$porcFRL = $this->obtenerValorActual($fecha, 'FRL');
				$descFRL = $salarioNominal * ($porcFRL / 100);
				$datosRecibo->push($this->obtenerDetalle(18,0,$porcFRL));
				
				//Aportes Seguridad Social
				$aportesSegSoc = $descFonasa + $descBPS + $descFRL;
					
				//Calcular el monto del Salario Vacacional: Mensual=(Sueldo Líq/30)*diasLicencia, Jornalero=Jornal Líq*diasLicenecia
				if ($empleado->cargo->remuneracion->id == 1)
					$salVacacional = (($salarioNominal - $aportesSegSoc) / 30) * $diasLicencia;
				else
					$salVacacional = ($salarioNominal - $aportesSegSoc) * $diasLicencia;
				
				$datosRecibo->push($this->obtenerDetalle(24,$salVacacional,'NA'));
				$datosRecibo->push($this->obtenerDetalle(12,$salVacacional,'NA'));
				$datosRecibo->push($this->obtenerDetalle(13,$salVacacional,'NA'));
				$datosRecibo->push($this->obtenerDetalle(21,$salVacacional,'NA'));
				
				//Guarda encabezado del recibo
				$recibo = new ReciboEmpleado;
				$recibo->idEmpleado = $empleado->id;
				$recibo->idTipoRecibo = $request->calculo;
				$hoy = Carbon::today();
					
					
				$recibo->fechaRecibo = $fecha->year.'-'.$fecha->month.'-'.$request->input('diac'.$i);
				$recibo->fechaPago = $hoy->year.'-'.$hoy->month.'-'.$hoy->day;
				
				$existe = ReciboEmpleado::where([['idEmpleado','=',$empleado->id],['idTipoRecibo','=',$request->calculo], ['fechaRecibo','=',$recibo->fechaRecibo]])->first();
				
				if ($existe == null)
					$recibo->save();
				else
				{
					$dt = DetalleRecibo::where('idRecibo','=',$existe->id)->delete();
					$existe->delete();
					
					$recibo->save();
				}
				//Obtengo último recibo guardado
				$UltimoReciboEmpleado = ReciboEmpleado::where([['idEmpleado','=',$empleado->id],['idTipoRecibo','=',$request->calculo], ['fechaRecibo','=',$recibo->fechaRecibo]])->first();
					
				//Guarda detalles del recibo
				foreach($datosRecibo as $dtr)
				{
					if ($dtr[0]!=0)
					{
						$detalleRecibo = new DetalleRecibo;
						$detalleRecibo->idConceptoRecibo=$dtr[0];
							
						$detalleRecibo->monto=$dtr[1];	
						
						if($dtr[0]==14 || $dtr[0]==15 || $dtr[0]==18)
						{//BPS/Fonasa/FRL
							$detalleRecibo->porcentaje=$dtr[2];						
						}
						
						$detalleRecibo->idRecibo = $UltimoReciboEmpleado->id;
						
						$detalleRecibo->save();	
					}
				}
				
				$empleadosRecibo->push($UltimoReciboEmpleado);
			}
		}
		$tipoRecibo = TipoRecibo::find($request->calculo);
		
		return view('contable.haberes.listaEmpleadosRecibos', ['empleadosRecibo' => $empleadosRecibo,'fechaMes'=>$fecha->month,'fechaAnio'=>$fecha->year,'calculo'=>$tipoRecibo]);
	}
	
	
	//Guarda los datos del cálculo de liquidacion de haberes con los detalles correspondientes al recibo del mismo.
    public function calculoLiquidacion(Request $request)
    {
		$fecha = new Carbon($request->fecha);
		$empleadosRecibo=collect([]);
		
		for ( $i = 1; $i <= $request->cantHabilitados; $i++)
		{//Recorre los empleados de la empresa.
			$datosRecibo = collect([]);
	
			if ($request->input($i.'hab') != null)
			{//Cálcula Liquidación de Haberes de cada empleado		
				$idEmpleado = $request->input($i.'hab');
					
				$empleado = Empleado::find($idEmpleado);

				//Calcular Sueldo del mes
				$cargo = Cargo::find($empleado->idCargo);
				$fechaBaja = new Carbon($empleado->fechaBaja);
				
				if ($cargo->id_remuneracion == 1 && $empleado->tipoHorario==1)
				{//El empleado es mensual y horario habitual.					
						//Obtiene las horas que debe realizar por contrato						
						$horasMesContrato = $this->obtenerHorasContratoMes($fecha, $empleado->id, $fechaBaja->day);
						//Obtiene las horas efectivamente trabajadas
						$horasMesTrabajado = $this->obtenerHorasTrabajadasMes($fecha, $empleado->id, $fechaBaja->day);
						//Obtiene las horas a descontar, Horas Extras y Horas Extras Especiales
						$horasRecibo = $this->obtenerHorasDescuentoYExtras($fecha, $fechaBaja->day, $cargo, $horasMesTrabajado[0], $horasMesContrato);
				} 
				else{
					//El empleado es mensual y horario flexible o jornalero
					$horasMesTrabajado = $this->obtenerHorasTrabajadasMes($fecha, $empleado->id, $fechaBaja->day);
					$horasRecibo = $this->obtenerHorasDescuentoYExtras($fecha, $fechaBaja->day, $cargo, $horasMesTrabajado[0]);
				}
				
				/*Horas Recibo contiene: 
				-Horas Descuento o horas Jornal
				-Horas Extras en Día común
				-Horas  Descanso Trabajado
				-Horas Extras Descanso Trabajado*/
				//Agregar horas de nocturnidad, percnote, espera y Descanso Intermedio Trabajado.
				$horasRecibo->push($horasMesTrabajado[1]);//Horas Espera
				$horasRecibo->push($horasMesTrabajado[2]);//Horas Nocturnidad
				$horasRecibo->push($horasMesTrabajado[3]);//Horas Percnote
				$horasRecibo->push($horasMesTrabajado[4]);//Horas Trabajadas Descanso Intermedio
				$horasRecibo->push($request->input('lic'.$i));//Días de Licencia Gozados
				
				//Cálcula Antigüedad si corresponde						
				$montoAntiguedad = $this->obtenerAntiguedad($fecha, $empleado, $cargo);
				
				//Obtiene monto de Salario Nominal Gravado y no Gravado, sumando todos los conceptos (víaticos y partidas extras)
				$montoSalario = $this->obtenerMontosSalarioNominal($fecha, $empleado, $cargo, $horasRecibo, $montoAntiguedad);
					
				//Calcular Aguinaldo
				//Suma del monto total de sueldos percibidos el empleado para el cálculo del aguinaldo
				$montoTotalSueldos = 0;
				
				if($fechaBaja->month < 6 || $fechaBaja->month == 12)
				{
					$x = 12;
					$anio = $fecha->year - 1;
					
					while($x!=6)
					{
						$recibo = ReciboEmpleado::where([['idEmpleado','=',$empleado->id],['idTipoRecibo','=',1],['fechaRecibo', '=', $anio.'-'.$x.'-01']])->first();
						
						if ($recibo != null)
						{
							$detalleNominal = $recibo->detallesRecibos->where('idConceptoRecibo','=',13)->first();
							$montoTotalSueldos += $detalleNominal->monto;
						}
						
						if ($x == 12)
						{
							$x = 1;
							$anio ++;
						}
						else
							$x ++;									
					}
				}
				else
				{
					$x = 6;
						
					while($x!=12)
					{
						$recibo = ReciboEmpleado::where([['idEmpleado','=',$empleado->id],['idTipoRecibo','=',1],['fechaRecibo', '=', $fecha->year.'-'.$x.'-01']])->first();
						
						if ($recibo != null)
						{
							$detalleNominal = $recibo->detallesRecibos->where('idConceptoRecibo','=',13)->first();
							$montoTotalSueldos += $detalleNominal->monto;
						}
							
						$x ++;									
					}
				}
				
				//Monto del aguinaldo.
				$montoAguinaldo = $montoTotalSueldos / 12;
				//Aguinaldo
				$datosRecibo->push($this->obtenerDetalle(23,$montoAguinaldo,'NA'));
				
				//Monto del salario Gravado
				$montoSalario[40] += $montoAguinaldo;
				$montoSalarioGravado = $montoSalario[40];
				
				//Descuentos
				//Valor de BPC del mes a calcular
				$valorBPC = $this->obtenerValorActual($fecha, 'BPC');

				//Cálculo de descuento de Fonasa (porcentaje, monto)
				$valoresFonasa = $this->obtenerDescuentoFonasa($empleado, $montoSalarioGravado, $valorBPC);
				
				$porcFonasa = $valoresFonasa[0];
				$descFonasa = $valoresFonasa[1];
				$datosRecibo->push($this->obtenerDetalle(15,$descFonasa,$porcFonasa));
				
				//Cálculo de descuento de BPS
				$porcBPS = $this->obtenerValorActual($fecha, 'BPS');
				$descBPS = $montoSalarioGravado * ($porcBPS / 100);
				$datosRecibo->push($this->obtenerDetalle(14,$descBPS,$porcBPS));
				
				//Cálculo de descuento de FRL
				$porcFRL = $this->obtenerValorActual($fecha, 'FRL');
				$descFRL = $montoSalarioGravado * ($porcFRL / 100);
				$datosRecibo->push($this->obtenerDetalle(18,$descFRL,$porcFRL));
				
				//Calcular Licencia No Gozada
				if ($cargo->id_remuneracion == 1)
				{
					$montoLicNoGozadaPrimer = (($empleado->monto/30) * $request->input('licpri'.$i));
					$montoLicNoGozadaSegundo = (($empleado->monto/30) * $request->input('licseg'.$i));
				}
				else
				{
					$montoLicNoGozadaPrimer = $empleado->monto * $request->input('licpri'.$i);
					$montoLicNoGozadaSegundo = $empleado->monto * $request->input('licseg'.$i);
				}
				
				$montoLicNoGozada = $montoLicNoGozadaPrimer + $montoLicNoGozadaSegundo;
				
				if ($montoLicNoGozada > 0)
					$datosRecibo->push($this->obtenerDetalle(26,$montoLicNoGozada,$request->input('licpri'.$i)+$request->input('licseg'.$i)));
				
				//Calcular Salario Vacacional
				//Obtiene cantidad de días de licencia a usufructuar.
				$diasLicencia = $request->input('lic'.$i);
				
				//Obtener monto del salario Nominal
				$salarioNominalSV = $empleado->monto;
					
				//Cálculo de Descuentos
				//Cálculo de descuento de Fonasa (porcentaje, monto)
				$valoresFonasaSV = $this->obtenerDescuentoFonasa($empleado, $salarioNominalSV, $valorBPC);
				
				$descFonasaSV = $valoresFonasaSV[1];
					
				//Cálculo de descuento de BPS
				$descBPSSV = $salarioNominalSV * ($porcBPS / 100);
					
				//Cálculo de descuento de FRL
				$descFRLSV = $salarioNominalSV * ($porcFRL / 100);
					
				//Aportes Seguridad Social
				$aportesSegSocSV = $descFonasaSV + $descBPSSV + $descFRLSV;
					
				//Calcular el monto del Salario Vacacional: Mensual=(Sueldo Líq/30)*diasLicencia, Jornalero=Jornal Líq*diasLicenecia
				if ($empleado->cargo->remuneracion->id == 1)
					$salVacacional = (($salarioNominalSV - $aportesSegSocSV) / 30) * $diasLicencia;
				else
					$salVacacional = ($salarioNominalSV - $aportesSegSocSV) * $diasLicencia;
				
				$datosRecibo->push($this->obtenerDetalle(24,$salVacacional,'NA'));
				
				//Salario Vacacional se suma al Monto Salario No Gravado para cálculo de IRPF
				$montoSalario[43] += ($montoLicNoGozadaPrimer + $montoLicNoGozadaSegundo + $salVacacional);
				$montoSalario[46] += ($montoLicNoGozadaPrimer + $montoLicNoGozadaSegundo + $salVacacional);
				//Monto	Subtotal Nominal
				$montoSalarioNominal = $montoSalario[46];
				
				//Sumar 6% si Salario Nominal Gravado + SalarioVacacional supera 10 BPC
				if ($montoSalarioNominal >= (10 * $valorBPC))
					$montoSalarioNominal = $montoSalarioNominal * 1.06;
				
				//Cálculo de descuento de IRPF Primario
				$descIRPFPrimario = $this->obtenerDescuentoIRPFPrimario($fecha, $empleado, $montoSalarioNominal, $valorBPC);
				
				//Cálculo de deducciones de IRPF
				$aportesSegSoc = $descFonasa + $descBPS + $descFRL;
				$deducionesIRPF = $this->obtenerDeduccionesIRPF($fecha, $empleado, $montoSalarioNominal, $valorBPC, $aportesSegSoc);
				
				//IRPF final a pagar
				$descIRPF = $descIRPFPrimario - $deducionesIRPF;
				
				if ($descIRPF < 0){
					$descIRPFPrimario=0;
					$deducionesIRPF=0;
				}
				
				$datosRecibo->push($this->obtenerDetalle(16,$descIRPFPrimario,'NA'));
				$datosRecibo->push($this->obtenerDetalle(17,$deducionesIRPF,'NA'));
	
				//IPD - Indemnización por despido
				$montoIPD = 0;
				
				if ($empleado->idMotivo == 2)
				{
					$fechaDesde = new Carbon($empleado->fechaDesde);
					
					if ($fechaDesde->diffInDays($fechaBaja) > 90)
					{
						$salarioIPD = $empleado->monto + $empleado->monto/12 + (($empleado->monto/30) * 1.66);
						
						if ($fechaDesde->diffInYears($fechaBaja) > 1 && $fechaDesde->diffInYears($fechaBaja) < 6)
							$montoIPD = $salarioIPD * $fechaDesde->diffInYears($fechaBaja);							
						elseif ($fechaDesde->diffInYears($fechaBaja) >= 6)
							$montoIPD = $salarioIPD * 6;	
						else
							$montoIPD = $salarioIPD;
						
						$datosRecibo->push($this->obtenerDetalle(25,$montoIPD,'NA'));
					}
				}					
			
				//Monto de IPD se suma al Monto Salario No Gravado y al Subtotal Nominal
				$montoSalario[43] += $montoIPD;
				$montoSalario[46] += $montoIPD;
			
				//Carga Detalles
				$cant=count($montoSalario);					
				for($j=0;$j<$cant;$j++){
					$detalle=collect([]);						
					$cantParam=$montoSalario[$j];
					
					for($x=1;$x<=$cantParam;$x++){
						$detalle->push($montoSalario[$j+$x]);
					}
					$j=$j+$cantParam;
					$datosRecibo->push($detalle);
				}
			
				//Adelantos de empleado
				$montoAdelanto=$this->obtenerPagos($fecha,$empleado,2);
				$datosRecibo->push($this->obtenerDetalle(19,$montoAdelanto,'NA'));
				
				//Viaticos empleado
				$montoViatico=$this->obtenerPagos($fecha,$empleado,1);
				$datosRecibo->push($this->obtenerDetalle(10,$montoViatico,'NA'));
				
				//Suma de descuentos
				$sumaDescuentos = $aportesSegSoc + $descIRPF + $montoAdelanto;
				$datosRecibo->push($this->obtenerDetalle(20,$sumaDescuentos,'NA'));
				
				//Cálculo Sueldo Luíqido
				$sueldoLiquido = $montoSalario[46] - $sumaDescuentos - $montoViatico;//Agregar Fictos
				$datosRecibo->push($this->obtenerDetalle(21,$sueldoLiquido,'NA'));
				
				//Guarda encabezado del recibo
				$recibo = new ReciboEmpleado;
				$recibo->idEmpleado = $empleado->id;
				$recibo->idTipoRecibo = $request->calculo;
				$hoy = Carbon::today();
					
				$recibo->fechaRecibo = $fechaBaja->year.'-'.$fechaBaja->month.'-'.$fechaBaja->day;
				$recibo->fechaPago = $hoy->year.'-'.$hoy->month.'-'.$hoy->day;
				
				$existe = ReciboEmpleado::where([['idEmpleado','=',$empleado->id],['idTipoRecibo','=',$request->calculo], ['fechaRecibo','=',$recibo->fechaRecibo]])->first();
				
				if ($existe == null)
					$recibo->save();
				else
				{
					$dt = DetalleRecibo::where('idRecibo','=',$existe->id)->delete();
					$existe->delete();
					
					$recibo->save();
				}
				//Obtengo último recibo guardado
				$UltimoReciboEmpleado = ReciboEmpleado::where([['idEmpleado','=',$empleado->id],['idTipoRecibo','=',$request->calculo], ['fechaRecibo','=',$recibo->fechaRecibo]])->first();
					
				//Guarda detalles del recibo
				foreach($datosRecibo as $dtr)
				{
					if ($dtr[0]!=0)
					{
						$detalleRecibo = new DetalleRecibo;
						/*$table->integer('idConceptoRecibo')->unsigned();
						$table->decimal('cantDias', 4, 1);
						$table->decimal('cantHoras', 4, 1);
						$table->decimal('monto', 8, 2);
						$table->decimal('porcentaje', 8, 2);
						*/
						$detalleRecibo->idConceptoRecibo=$dtr[0];
						if($dtr[0]==9 || $dtr[0]==26 ||($dtr[0]== 1 && $cargo->id_remuneracion == 2))
						{//Días de Licencia Gozada
							$detalleRecibo->cantDias = $dtr[2];
						}
						else
							$detalleRecibo->cantDias = 0;
						
						if(($dtr[0]>=2 && $dtr[0]<=7) || $dtr[0]==22)
						{
							$detalleRecibo->cantHoras=$dtr[2];
						}
						else
						{
							$detalleRecibo->cantHoras=0;							
						}						
						
						$detalleRecibo->monto=$dtr[1];	
						
						if($dtr[0]==14 || $dtr[0]==15 || $dtr[0]==18)
						{//BPS/Fonasa/FRL
							$detalleRecibo->porcentaje=$dtr[2];						
						}
						$detalleRecibo->idRecibo=$UltimoReciboEmpleado->id;
						
						$detalleRecibo->save();		
					}
				}
				
				$empleadosRecibo->push($UltimoReciboEmpleado);		
			}
		}	
		$tipoRecibo = TipoRecibo::find($request->calculo);
		
		return view('contable.haberes.listaEmpleadosRecibos', ['empleadosRecibo' => $empleadosRecibo,'fechaMes'=>$fecha->month,'fechaAnio'=>$fecha->year,'calculo'=>$tipoRecibo]);		
	}
	
	
	//Devuelve array con horas que TRABAJO el empleado en el mes indicado.
 	private function obtenerHorasTrabajadasMes ($fecha, $idEmpleado, $cantDias)
	{
		$empleado = Empleado::find($idEmpleado);
		$tiposHoras = TipoHora::All();
		$totalHorasPernocte = 0;
		$totalHorasNocturna = 0;
		$totalHorasEspera = 0;
		$totalHorasDescansoInterm = 0;
		$horasTrabajadasMes = collect([]);
		$horasRealizadasMes = collect([]);
			
		for($i=1;$i<=$cantDias;$i++)
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
							if($horasReg->tipoDia==null){
								$horasRealizadasDia->push($horasReg->cantHoras);
							}
							else{
								$horasRealizadasDia->push($horasReg->tipoDia);
								$horasRealizadasDia->push($horasReg->cantHoras);								
							}
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
					case 6:
					//Trabajo Descanso Intermedio
							if ($horasReg != null)
								$totalHorasDescansoInterm += 0.5;
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
		$horasTrabajadasMes->push($totalHorasDescansoInterm);
		
		return $horasTrabajadasMes;
	}

	//Devuelve array con horas que DEBE realizar el empleado en el mes indicado.
	private function obtenerHorasContratoMes($fecha, $idEmpleado, $cantDias)
	{/*1- obtener todos los horairos del empleado
	   2- dia a dia ver si esta dentro de cada horario
	   3- agregar a una coleccion con datos*/
		$dias = Dia::All();
		$horasContratoMes = collect([]);
		$horarios = HorarioEmpleado::where('idEmpleado','=',$idEmpleado)->orderBy('id', 'desc')->get();
			
		for($i=1;$i<=$cantDias;$i++){
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
									if($this->diaFeriado($fechaActual)){
										$calendario->push("00:00:00");
										$calendario->push(3);
									}
									else{
										$calendario->push($hd->cantHoras);
										$calendario->push($hd->idRegistro);
									}									
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
	private function obtenerHorasDescuentoYExtras($fecha, $cantDias, $cargo, $horasMesTrabajado, $horasMesContrato=null)
	{
		$cantHoras = 0;
		$cantHorasExtras = 0;
		$cantHorasDescansoTrabajado = 0;
		$cantHoraExtraDescansoTrabajado = 0;
		
		$horasEmpl = collect([]);
			
		for($i=0;$i<$cantDias;$i++)
		{
			$horasExtrasDia = 0;
			
			if($horasMesContrato!=null){
				//Suma de horas a descontar por diferencia
				if ($horasMesContrato[$i][1] > $horasMesTrabajado[$i][1])
				{
					$horaContrato = Carbon::createFromTimeString($horasMesContrato[$i][1]);
					$horaReal = Carbon::createFromTimeString($horasMesTrabajado[$i][1]);
					$difHora = $horaContrato->hour - $horaReal->hour;
					
					$cantHoras = $cantHoras - $difHora;
				}
				
				//Suma horas de Descanso Trabajado para días Descanso y Medio Día.
				if($horasMesContrato[$i][2] != 1 && $horasMesContrato[$i][1] < $horasMesTrabajado[$i][1])
				{
					$horaContrato = Carbon::createFromTimeString($horasMesContrato[$i][1]);
					$horaReal = Carbon::createFromTimeString($horasMesTrabajado[$i][1]);
					$difHora = $horaReal->hour - $horaContrato->hour;
					
					$cantHorasDescansoTrabajado += $difHora;
				}
				$horasExtrasDia = Carbon::createFromTimeString($horasMesTrabajado[$i][2]);
				$valorSwitch=$horasMesContrato[$i][2];
			}
			else{				
					//suma horas a descontar de diferencias y horas de Descanso Trabajado para días Descanso y Medio Día empleado mensual felxible
					switch($horasMesTrabajado[$i][1]){
						case 'c':
								if($cargo->id_remuneracion == 1){
									$horaReal = Carbon::createFromTimeString($horasMesTrabajado[$i][2]);
									$difHora = 8 - $horaReal->hour;								
									$cantHoras = $cantHoras - $difHora;
								}
								else{
									//suma cantidad de horas comunes del empleado jornalero
									$hr=Carbon::createFromTimeString($horasMesTrabajado[$i][2]);
									$cantHoras = $cantHoras+$hr->hour;
								}
								$valorSwitch=1;
							break;
						case 'm':
								$horaReal = Carbon::createFromTimeString($horasMesTrabajado[$i][2]);
								$difHora = 4 - $horaReal->hour;
								if($difHora>0){
									$cantHoras = $cantHoras - $difHora;
								}
								else{
									$cantHorasDescansoTrabajado = $cantHorasDescansoTrabajado - $difHora;
								}
								$valorSwitch=2;
							break;
						case 'd':
								if($cargo->id_remuneracion == 1){
									$horaReal = Carbon::createFromTimeString($horasMesTrabajado[$i][2]);
									$cantHorasDescansoTrabajado = $cantHorasDescansoTrabajado + $horaReal->hour;
								}
								else{
									//suma cantidad de horas comunes del empleado jornalero en dia descanso
									$cantHorasDescansoTrabajado += Carbon::createFromTimeString($horasMesTrabajado[$i][2])->hour;
								}
								$valorSwitch=3;
							break;
					}
				
				
				$horasExtrasDia = Carbon::createFromTimeString($horasMesTrabajado[$i][3]);
			}
			
			//Suma de horas Extras
			
			switch ($valorSwitch)
			{
				case 1:
						//JORNADA COMPLETA
						if ($horasExtrasDia->hour > 0) 
							$cantHorasExtras = $cantHorasExtras + $horasExtrasDia->hour;
						//Suma minutos
						if ($horasExtrasDia->minute > 15 && $horasExtrasDia->minute <= 30)
							$cantHorasExtras = $cantHorasExtras + 0.5;
						
						if ($horasExtrasDia->minute > 30)
							$cantHorasExtras = $cantHorasExtras + 1;					
					break;
				case 2:
					//MEDIO DIA
						if ($horasExtrasDia->hour > 0) 
						{
							$cantHoraExtraDescansoTrabajado = $cantHoraExtraDescansoTrabajado + $horasExtrasDia->hour;
						}
						else
						{
							if ($horasExtrasDia->minute > 15 && $horasExtrasDia->minute <= 30)
								$cantHoraExtraDescansoTrabajado = $cantHoraExtraDescansoTrabajado + 0.5;
							
							if ($horasExtrasDia->minute > 30)
								$cantHoraExtraDescansoTrabajado = $cantHoraExtraDescansoTrabajado + 1;		
						}							
					break;
				case 3:
					//DESCANSO
						if ($horasExtrasDia->hour > 0) 
						{
							$cantHoraExtraDescansoTrabajado = $cantHoraExtraDescansoTrabajado + $horasExtrasDia->hour;
						}
						else
						{
							if ($horasExtrasDia->minute > 15 && $horasExtrasDia->minute <= 30)
								$cantHoraExtraDescansoTrabajado = $cantHoraExtraDescansoTrabajado + 0.5;
							
							if ($horasExtrasDia->minute > 30)
								$cantHoraExtraDescansoTrabajado = $cantHoraExtraDescansoTrabajado + 1;		
						}		
					break;
			}			
		}
		
		$horasEmpl->push($cantHoras);
		$horasEmpl->push($cantHorasExtras);
		$horasEmpl->push($cantHorasDescansoTrabajado);
		$horasEmpl->push($cantHoraExtraDescansoTrabajado);
		
		return $horasEmpl;
	}
	
	//Obtiene el monto de la antiguedad del empleado
	private function obtenerAntiguedad($fecha, $empleado, $cargo)
	{/*Empresas Grupo:11.
		- 19 meses = 1,25 x SMN x años (1 años y 7 meses)
		- 60 meses = 2,25 x SMN x años (5 años)
		-120 meses = 2,5  x SMN x años (10 años)
		-180 meses en adelante: 
			tope = 2,5 x SMN x 15	
	*/	
		$valorAntiguedad = 0;
		
		if ($empleado->empresa->grupo == 11)
		{
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
			
			$fecha->subMonth();
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
			if ($empleado->habilitado == 0)
			{
				$fechaBaja = new Carbon($empleado->fechaBaja);
				$salNominalGravado = ($empleado->monto/30) * $fechaBaja->day;
			}
			else
				$salNominalGravado = $empleado->monto;
			//Sueldo nominal
			$salarios->push(2);
			$salarios->push(1);
			$salarios->push($salNominalGravado);
			
			//Descuento por faltas
			$salarios->push(3);
			if ($horasRecibo[0] < 0)
			{//Resta de valor por faltas
				$salarios->push(22);
			}
			else
				$salarios->push(0);
			
			$salNominalGravado += ($empleado->valorHora) * $horasRecibo[0];
			$salarios->push(($empleado->valorHora) * $horasRecibo[0]);
			$salarios->push($horasRecibo[0]);
			
		}
		else
		{//empleado jornalero
			//Horas del mes
			$salNominalGravado = $empleado->valorHora * $horasRecibo[0];
			//Sueldo Jornal
			$salarios->push(2);
			$salarios->push(1);
			$salarios->push($salNominalGravado);
			
			//Jornalero no tiene descuento por faltas
			$salarios->push(3);
			$salarios->push(0);
			$salarios->push(0);
			$salarios->push(0);
		}
		
		$salarios->push(3);
		if ($horasRecibo[8] > 0)
		{//Suma el valor de Días de Licencia Gozadas en el mes
			$salarios->push(9);
		}
		else			
			$salarios->push(0);				
		
		if ($cargo->id_remuneracion == 1)
		{//El empleado es mensual.		
			$salNominalGravado += ($empleado->monto / 30) * $horasRecibo[8];
			$salarios->push(($empleado->monto / 30) * $horasRecibo[8]);
			$salarios->push($horasRecibo[8]);//Cant. Días de licencia
			
			//Descanso Semanal Trabajado
			$salNominalGravado += ($empleado->valorHora) * $horasRecibo[2];
			
			$salarios->push(3);
			$salarios->push(2);
			$salarios->push(($empleado->valorHora) * $horasRecibo[2]);
			$salarios->push($horasRecibo[2]);
		}
		else
		{//El empleado es jornalero.		
			$salNominalGravado += $empleado->monto * $horasRecibo[8];
			$salarios->push(($empleado->monto) * $horasRecibo[8]);
			$salarios->push($horasRecibo[8]);//Cant. Días de licencia
			
			//Descanso Semanal Trabajado
			$salNominalGravado += ($empleado->valorHora * 2) * $horasRecibo[2];
			
			$salarios->push(3);
			$salarios->push(2);
			$salarios->push(($empleado->valorHora * 2) * $horasRecibo[2]);
			$salarios->push($horasRecibo[2]);
		}
					
			//Horas extras
			$salNominalGravado += ($empleado->valorHora * 2) * $horasRecibo[1];
			
			$salarios->push(3);
			$salarios->push(3);
			$salarios->push(($empleado->valorHora * 2) * $horasRecibo[1]);
			$salarios->push($horasRecibo[1]);
			
			//Horas Extras Descanso Trabajado
			$salNominalGravado += ($empleado->valorHora * 2.5) * $horasRecibo[3];
			
			$salarios->push(3);
			$salarios->push(4);
			$salarios->push(($empleado->valorHora * 2.5) * $horasRecibo[3]);			
			$salarios->push($horasRecibo[3]);
			
			//Horas Espera/Nocturna/Percnote
			$salNominalGravado += ($empleado->valorHora * 2 * 0.175) * $horasRecibo[4];
			
			$salarios->push(3);
			$salarios->push(5);
			$salarios->push(($empleado->valorHora * 2 * 0.175) * $horasRecibo[4]);
			$salarios->push($horasRecibo[4]);
			
			$salNominalGravado += ($empleado->valorHora * 0.20) * $horasRecibo[5];
			
			$salarios->push(3);
			$salarios->push(6);
			$salarios->push(($empleado->valorHora * 0.20) * $horasRecibo[5]);
			$salarios->push($horasRecibo[5]);
			
			$salNominalGravado += ($empleado->valorHora * 2 * 0.175) * $horasRecibo[6];
			
			$salarios->push(3);
			$salarios->push(7);
			$salarios->push(($empleado->valorHora * 2 * 0.175) * $horasRecibo[6]);
			$salarios->push($horasRecibo[6]);
			
			//Antigüedad
			$salNominalGravado += $montoAntiguedad;
			
			$salarios->push(2);
			$salarios->push(8);
			$salarios->push($montoAntiguedad);
			
			//Obtiene los pagos Viáticos/Partidas Extras/Fictos			
			$pagos=Pago::where([['idEmpleado','=',$empleado->id],['fecha','=',$fecha]])->get();
			//Recorre Pagos
			foreach($pagos as $p)
			{
				if($p->idTipoPago != 2)
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
		
		$salarios->push(2);
		$salarios->push(11);
		$salarios->push($salNominalGravado);
		
		$salarios->push(2);
		$salarios->push(12);
		$salarios->push($salNominalNoGravado);
		
		$salarios->push(2);
		$salarios->push(13);
		$salarios->push($salNominalNoGravado+$salNominalGravado);
	
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
		if( $montoSalario <= (15 * $valorBPC))
			$valorDeducciones = $sumaDeducciones * 0.1;
		else
			$valorDeducciones = $sumaDeducciones * 0.08;
		
		return ($valorDeducciones);
	}
	
	private function obtenerDetalle($idConcepto,$descuento,$porcentaje){
		$detalle=collect([]);
		
		$detalle->push($idConcepto);
		
		if(is_numeric($descuento))		
			$detalle->push($descuento);
		
		if($porcentaje!='NA')
			$detalle->push($porcentaje);
		
		return $detalle;
	}
	
	private function obtenerPagos($fecha,$empleado,$idTipoPago){
		$valor=0;
		//Obtiene los pagos
		$pagos=Pago::where([['idEmpleado','=',$empleado->id],['fecha','=',$fecha],['idTipoPago','=',$idTipoPago]])->get();
		//Recorre Pagos
		foreach($pagos as $p)
		{	
			$valor += $p->monto;
		}
		return $valor;
	}
	
	private function obtenerMontoSalVacaional($fecha,$empleado){
		
		$fechaDesde=$fecha->year."-".$fecha->month."-01";
		$fechaHasta=$fecha->year."-".$fecha->month."-".$fecha->daysInMonth;
		$recibosSalVac=ReciboEmpleado::where("idEmpleado",'=',$empleado->id)->where("idTipoRecibo",'=',4)->whereBetween('fechaRecibo', [$fechaDesde, $fechaHasta])->get();
		$monto=0;
		foreach($recibosSalVac as $recibo){
			$detalleNominal = $recibo->detallesRecibos->where('idConceptoRecibo','=',21)->first();
			$monto+= $detalleNominal->monto;
		}
		return $monto;
	}
	
	private function diaFeriado($fecha){
		$feriados=Feriado::All();
		$esFeriado=false;
		foreach($feriados as $fer){
			if($fer->dia == $fecha->day && $fer->mes==$fecha->month){
				$esFeriado=true;
			}
		}
		return $esFeriado;
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
