<?php

namespace App\Http\Controllers\Contable;

use App\Contable\Pago;
use App\Persona;
use App\Empresa;
use App\Contable\Empleado;
use App\Contable\RegistroHora;
use App\Http\Requests\PagoRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use \Carbon\Carbon;

class PagoController extends Controller
{
    public function index()
    {
        //
    }
	
	public function viaticos()
    {
      	$viaticos = Pago::where("idTipoPago", 1)->with('empleado')->get();
		
		return view('contable.pago.listaViaticos', ['viaticos' => $viaticos]);
    }
	
	public function viaticosInactivos()
    {
        $viaticos  = Pago::onlyTrashed()->where("idTipoPago", 1)->with('empleado')->get();
		
		return view('contable.pago.listaViaticosInactivos', ['viaticos' => $viaticos]);
    }
    
	public function adelantos()
    {
      	$adelantos = Pago::where("idTipoPago", 2)->with('empleado')->get();
		
		return view('contable.pago.listaAdelantos', ['adelantos' => $adelantos]);
    }
	
	public function adelantosInactivos()
    {
        $adelantos  = Pago::onlyTrashed()->where("idTipoPago", 2)->with('empleado')->get();
		
		return view('contable.pago.listaAdelantosInactivos', ['adelantos' => $adelantos]);
	}	
		
	public function extras()
    {
      	$extras = Pago::where("idTipoPago", 3)->with('empleado')->get();
		
		return view('contable.pago.listaExtras', ['extras' => $extras]);
    }
	
	public function extrasInactivos()
    {
        $extras  = Pago::onlyTrashed()->where("idTipoPago", 3)->with('empleado')->get();
		
		return view('contable.pago.listaExtrasInactivos', ['extras' => $extras]);
	}	
	
	public function fictos()
    {
      	$fictos = Pago::where("idTipoPago", 4)->with('empleado')->get();
		
		return view('contable.pago.listaFictos', ['fictos' => $fictos]);
    }
	
	public function fictosInactivos()
    {
        $fictos  = Pago::onlyTrashed()->where("idTipoPago", 4)->with('empleado')->get();
		
		return view('contable.pago.listaFictosInactivos', ['fictos' => $fictos]);
	}
	
	public function create(Request $request)
    {
		$empresas = Empresa::with('personas.tipoDoc')->get();
		
		//return vista con FORM para add pago
		return view('contable.pago.agregarPago',['empresas' => $empresas, 'tipoPago' => $request->idTipo]);
	}
	

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PagoRequest $request)
    {	
	    $empresa = Empresa::where("rut","=",$request->rut)->first();
		$persona = Persona::where([["tipoDocumento",'=',$request->tipoDocId], ["documento",'=',$request->numeroDoc]])->first();
		$empleado = Empleado::where([["idEmpresa",'=',$empresa->id], ["idPersona",'=',$persona->id]])->first();
		
		$pago = new Pago;
		$pago->idEmpleado = $empleado->id;
		$pago->idTipoPago = $request->tipoPago;
		$pago->fecha = new Carbon($request->mes."-01");
		$pago->monto = $request->monto;
		
		if (isset($request->cantDias))
			$pago->cantDias = $request->cantDias;
		
		$pago->descripcion = $request->descripcion;
		
		if (!isset($request->gravado))
			$pago->gravado = 0;
		elseif ($request->gravado)
			$pago->gravado = 1;
		else
			$pago->gravado = 0;
		
		if (isset($request->porcentaje))
			$pago->porcentaje = $request->porcentaje;
			
		try {
			$pago ->save();
			
			if ($pago ->idTipoPago == 1)
				return redirect()->route('pago.viaticos')->with('success', "El viático se cargo correctamente.");
			elseif ($pago ->idTipoPago == 2)
				return redirect()->route('pago.adelantos')->with('success', "El adelanto se cargo correctamente.");
			elseif ($pago ->idTipoPago == 3)
				return redirect()->route('pago.extras')->with('success', "La partida extra se cargo correctamente.");
			else
				return redirect()->route('pago.fictos')->with('success', "El ficto se cargo correctamente.");
		} 
		catch(Exception $e){
			return back()->withInput()->withError("El pago no se pudo registrar, intente nuevamente o contacte al administrador.");				;
		};
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
		$empleado = Empleado::find($pago->idEmpleado);
		$empresa = Empresa::find($empleado->idEmpresa);
		$persona = Persona::where("id", $empleado->idPersona)->with('tipoDoc')->first();
		$pago->fecha = new Carbon($pago->fecha);
		
		return view('contable.pago.editarPagos', ['empresa' => $empresa, 'persona' => $persona, 'pago' => $pago]);	
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PagoRequest $request, Pago $pago)
    {
        $pago->fecha = new Carbon($request->mes."-01");
		$pago->monto = $request->monto;
		
		if (isset($request->cantDias))
			$pago->cantDias = $request->cantDias;
		
		$pago->descripcion = $request->descripcion;
		
		if (!isset($request->gravado))
			$pago->gravado = false;
		elseif ($request->gravado)
			$pago->gravado = true;
		else
			$pago->gravado = false;
		
		if (isset($request->porcentaje))
			$pago->porcentaje = $request->porcentaje;
		else
			$pago->porcentaje = NULL;

		try {
			$pago->save();
			
			if ($pago ->idTipoPago == 1)
				return redirect()->route('pago.viaticos')->with('success', "El viático se editó correctamente");
			elseif ($pago->idTipoPago == 2)
				return redirect()->route('pago.adelantos')->with('success', "El adelanto se editó correctamente");
			elseif ($pago->idTipoPago == 3)
				return redirect()->route('pago.extras')->with('success', "La partida extra se editó correctamente");
			else
				return redirect()->route('pago.fictos')->with('success', "El ficto extra se editó correctamente");
				
		} catch(Exception $e){
			return back()->withInput()->withError("El pago no se pudo registrar, intente nuevamente o contacte al administrador.");				;
		};
		
    }

	
	public function activar(Request $request)
    {		
		$pago = Pago::onlyTrashed()->where('id', $request->pago_id)->first();
		
		$pago->restore();
		
		if ($pago->idTipoPago == 1)
			return redirect()->route('pago.viaticos.inactivos')->with('success', "El viático fue restaurado correctamente");
		elseif ($pago->idTipoPago == 2)
			return redirect()->route('pago.adelantos.inactivos')->with('success', "El adelanto fue restaurado correctamente");
		elseif ($pago->idTipoPago == 3)
			return redirect()->route('pago.extras.inactivos')->with('success', "El pago extra fue restaurado correctamente");
		else
			return redirect()->route('pago.fictos.inactivos')->with('success', "El ficto fue restaurada correctamente");
    }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        $pago->delete();
		
		if ($pago->idTipoPago == 1)
			return redirect()->route('pago.viaticos')->with('success', "El viático fue eliminado correctamente");
		elseif ($pago->idTipoPago == 2)
			return redirect()->route('pago.adelantos')->with('success', "El adelanto fue eliminado correctamente");
		elseif ($pago->idTipoPago == 3)
			return redirect()->route('pago.extras')->with('success', "La partida extra fue eliminada correctamente");
		else
			return redirect()->route('pago.fictos')->with('success', "El ficto fue eliminado correctamente");
    }
	
	public function altaViatico(Request $request){
		$datos=0;
		try{
			$fechaPago= new Carbon($request->fecha);
			
			//Se tiene que setear datos antes del save por si ocurre un error y vuelva con los datos que ya tenia.
			$datos = $this->listaEmpleadosHaberes($request->idEmpleado,$fechaPago);
			
			$pago = new Pago;
			$pago->idEmpleado = $request->idEmpleado;
			$pago->idTipoPago = 1;
			
			$pago->fecha = $fechaPago->year.'-'.$fechaPago->month.'-01';
			$pago->monto = $request->monto;
			$pago->descripcion = $request->desc;
			
			if (isset($request->dias))
				$pago->cantDias = $request->dias;
			
			if (isset ($request->gravado)){
				$pago->gravado=1;
				$pago->porcentaje = $request->porcentaje;		
			}
			else{
				$pago->gravado=0;
			}
			
			$pago->save();						
			//todo ok vuelve con los viaticos actualizados
			$datos=$this->listaEmpleadosHaberes($request->idEmpleado,$fechaPago);
			
			return view('contable.haberes.listaEmpleadosHaberes', ['habilitadas' => $datos[0], 'calculo' => $request->calculo, 'fecha' => $fechaPago, 'cantHabilitados' => $datos[1]])->with('okMsg', 'El viatico se cargo correctamente.');
		}
		 catch(Exception $e){
			return view('contable.haberes.listaEmpleadosHaberes', ['habilitadas' => $datos[0], 'calculo' => $request->calculo, 'fecha' => $fechaPago, 'cantHabilitados' => $datos[1]])->with('errorMsg', 'Error al cargar el viatico.');
		}
	}
	public function altaPartidaExtra(Request $request){
		$datos=0;
		try{
			$fechaPago= new Carbon($request->fecha);
			//Se tiene que setear datos antes del save por si ocurre un error y vuelva con los datos que ya tenia.
			$datos=$this->listaEmpleadosHaberes($request->idEmpleado,$fechaPago);
			
			$pago = new Pago;
			$pago->idEmpleado = $request->idEmpleado;
			$pago->idTipoPago = 3;
			
			$pago->fecha = $fechaPago->year.'-'.$fechaPago->month.'-01';
			$pago->monto = $request->monto;
			$pago->descripcion = $request->desc;
			
			if (isset ($request->gravadoEx)){
				$pago->gravado=1;
				$pago->porcentaje = $request->porcentajeEx;		
			}
			else{
				$pago->gravado=0;
			}
			
			$pago->save();						
			//todo ok vuelve con los viaticos actualizados
			$datos=$this->listaEmpleadosHaberes($request->idEmpleado,$fechaPago);
			return view('contable.haberes.listaEmpleadosHaberes', ['habilitadas' => $datos[0], 'calculo' => $request->calculo, 'fecha' => $fechaPago, 'cantHabilitados' => $datos[1]])->with('okMsg', 'La partida extra se cargo correctamente.');
		}
		 catch(Exception $e){
			return view('contable.haberes.listaEmpleadosHaberes', ['habilitadas' => $datos[0], 'calculo' => $request->calculo, 'fecha' => $fechaPago, 'cantHabilitados' => $datos[1]])->with('errorMsg', 'Error al cargar la partida extra.');
		}
	}
	
	
	public function altaAdelanto(Request $request){
		$datos=0;
		try{
			$fechaPago= new Carbon($request->fecha);
			//Se tiene que setear datos antes del save por si ocurre un error y vuelva con los datos que ya tenia.
			$datos=$this->listaEmpleadosHaberes($request->idEmpleado,$fechaPago);
			
			$pago = new Pago;
			$pago->idEmpleado = $request->idEmpleado;
			$pago->idTipoPago = 2;
			
			$pago->fecha = $fechaPago->year.'-'.$fechaPago->month.'-01';
			$pago->monto = $request->monto;
			$pago->descripcion = $request->desc;
			$pago->gravado = false;
			
			$pago->save();						
			//todo ok vuelve con los adelantos actualizados
			$datos=$this->listaEmpleadosHaberes($request->idEmpleado,$fechaPago);
			return view('contable.haberes.listaEmpleadosHaberes', ['habilitadas' => $datos[0], 'calculo' => $request->calculo, 'fecha' => $fechaPago, 'cantHabilitados' => $datos[1]])->with('okMsg', 'El adelanto se cargo correctamente.');
		}
		 catch(Exception $e){
			return view('contable.haberes.listaEmpleadosHaberes', ['habilitadas' => $datos[0], 'calculo' => $request->calculo, 'fecha' => $fechaPago, 'cantHabilitados' => $datos[1]])->with('errorMsg', 'Error al cargar el adelanto.');
		}
	}
	
	public function altaFicto(Request $request){
		$datos=0;
		try{
			$fechaPago= new Carbon($request->fecha);
			//Se tiene que setear datos antes del save por si ocurre un error y vuelva con los datos que ya tenia.
			$datos=$this->listaEmpleadosHaberes($request->idEmpleado,$fechaPago);
			
			$pago = new Pago;
			$pago->idEmpleado = $request->idEmpleado;
			$pago->idTipoPago = 4;
			
			$pago->fecha = $fechaPago->year.'-'.$fechaPago->month.'-01';
			$pago->monto = $request->monto;
			$pago->descripcion = $request->desc;
			
			if (isset ($request->gravadoFi)){
				$pago->gravado=1;
				$pago->porcentaje = $request->porcentajeFi;		
			}
			else{
				$pago->gravado=0;
			}
			
			$pago->save();						
			//todo ok vuelve con los viaticos actualizados
			$datos=$this->listaEmpleadosHaberes($request->idEmpleado,$fechaPago);
			return view('contable.haberes.listaEmpleadosHaberes', ['habilitadas' => $datos[0], 'calculo' => $request->calculo, 'fecha' => $fechaPago, 'cantHabilitados' => $datos[1]])->with('okMsg', 'El ficto se cargo correctamente.');
		}
		 catch(Exception $e){
			return view('contable.haberes.listaEmpleadosHaberes', ['habilitadas' => $datos[0], 'calculo' => $request->calculo, 'fecha' => $fechaPago, 'cantHabilitados' => $datos[1]])->with('errorMsg', 'Error al cargar el ficto.');
		}
	}
	
	
	public function listaPagos($idEmpleado,$tipoPago,$fecha,$calculo){
		try{	
			$pagos =Pago::where('idEmpleado','=',$idEmpleado)->where('idTipoPago','=',$tipoPago)->where('fecha','=',$fecha->year.'-'.$fecha->month.'-01')->get();
			return $pagos;
		}
		catch(Exception $e){
			return view('contable.haberes.listaEmpleadosHaberes', ['habilitadas' => $datos[0], 'calculo' => $calculo, 'fecha' => $fecha, 'cantHabilitados' => $datos[1]])->with('errorMsg', 'Error al listar los pagos.');
		}
	}
	
	
	private function listaEmpleadosHaberes($idEmpleado,$fecha)
	{		
		$empleado = Empleado::find($idEmpleado);
		$empresa = Empresa::where('id','=',$empleado->idEmpresa)->first();			
		$personas = $empresa->personas;
		$habilitadas=collect([]);
		$cantHabilitados = 0;
		
		foreach($personas as $persona)
		{
			$fDesde = new Carbon($persona->pivot->fechaDesde);
			$fHasta = new Carbon($persona->pivot->fechaHasta);
			$fecha->day(01);
			
			if($fecha->between($fDesde,$fHasta))
			{
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
				$habilitadas->push($habilita);
				$cantHabilitados ++;
			}				
		}
		
		$datos=collect([]);
		$datos->push($habilitadas);
		$datos->push($cantHabilitados);
		
		return $datos;
	}
	
}
