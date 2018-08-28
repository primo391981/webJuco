<?php

namespace App\Http\Controllers\Contable;

use App\Contable\Pago;
use App\Persona;
use App\Empresa;
use App\Contable\Empleado;
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
		dd($pago);
		try {
			$pago ->save();
			
			if ($pago ->idTipoPago == 1)
				return redirect()->route('pago.viaticos')->with('success', "El viático se cargo correctamente.");
			else
				return redirect()->route('pago.adelantos')->with('success', "El adelanto se cargo correctamente.");
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
		
		if ($pago->idTipoPago == 1)
			$subtitulo = 'Editar Viático';
		else
			$subtitulo = 'Editar Adelanto';
		
		return view('contable.pago.editarPagos', ['subtitulo' => $subtitulo, 'empresa' => $empresa, 'persona' => $persona, 'pago' => $pago]);	
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
		
		try {
			$pago ->save();
			
			if ($pago ->idTipoPago == 1)
				return redirect()->route('pago.viaticos')->with('success', "El viático se editó correctamente");
			else
				return redirect()->route('pago.adelantos')->with('success', "El adelanto se editó correctamente");
				
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
		else
			return redirect()->route('pago.adelantos.inactivos')->with('success', "El adelanto fue restaurado correctamente");
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
		else
			return redirect()->route('pago.adelantos')->with('success', "El adelanto fue eliminado correctamente");
    }
}
