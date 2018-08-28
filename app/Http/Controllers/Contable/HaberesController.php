<?php

namespace App\Http\Controllers\Contable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empresa;
use App\Contable\Empleado;
use App\Contable\TipoRecibo;
use App\Contable\RegistroHora;
use App\Contable\Pago;
use Exception;
use \Carbon\Carbon;
////////////////////////
//use App\Contable\Pago;
//use App\Persona;
//use App\Contable\Empleado;
//use App\Http\Requests\PagoRequest;
////////////////////////

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
				}
				
			}
			return view('contable.haberes.listaEmpleadosHaberes', ['habilitadas' => $habilitadas,'calculo'=>$request->calculo,'fecha'=>$fecha]);			
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
       try{
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
