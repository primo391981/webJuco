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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
		
		//dd($viaticos=);
		return view('contable.pago.listaViaticosInactivos', ['viaticos' => $viaticos]);
    }
    
	public function create()
    {
		$empresas = Empresa::with('personas.tipoDoc')->get();
		//return vista con FORM para add viatico
		return view('contable.pago.agregarViatico',['empresas' => $empresas]);
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
		$pago ->idEmpleado = $empleado->id;
		$pago ->idTipoPago = $request->tipoPago;
		$pago ->fecha = $request->fecha;
		$pago ->monto = $request->monto;
		$pago ->descripcion = $request->descripcion;
			
		try {
			$pago ->save();
			
			if ($pago ->idTipoPago == 1)
				return redirect()->route('pago.viaticos')->with('success', "El viático se cargo correctamente.");				;
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
		//dd($pago);
		$empleado = Empleado::find($pago->idEmpleado);
		$empresa = Empresa::find($empleado->idEmpresa);
		$persona = Persona::where("id", $empleado->idPersona)->with('tipoDoc')->first();
		
		//dd($persona);
		if ($pago ->idTipoPago == 1)
		{
			$subtitulo = 'Editar Viático';
			return view('contable.pago.editarViaticos', ['subtitulo' => $subtitulo, 'empresa' => $empresa, 'persona' => $persona, 'pago' => $pago]);
		}
		else
		{
			$subtitulo = 'Editar Adelanto';
		}		
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
        $pago ->fecha = $request->fecha;
		$pago ->monto = $request->monto;
		$pago ->descripcion = $request->descripcion;
		
		try {
			$pago ->save();
			
			if ($pago ->idTipoPago == 1)
				return redirect()->route('pago.viaticos')->with('success', "El viático se editó correctamente");
			//else
			//	return redirect()->route('pago.adelantos')->with('success', "El adelanto se editó correctamente");
				
		} catch(Exception $e){
			return back()->withInput()->withError("El pago no se pudo registrar, intente nuevamente o contacte al administrador.");				;
		};
    }

	
	public function activar(Request $request)
    {		
		$pago = Pago::onlyTrashed()->where('id', $request->pago_id)->first();
		
		$pago->restore();
		
		if ($pago ->idTipoPago == 1)
			return redirect()->route('pago.viaticos.inactivos')->with('success', "El viático fue restaurado correctamente");
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
		
		if ($pago ->idTipoPago == 1)
			return redirect()->route('pago.viaticos')->with('success', "El viáticoo fue eliminado correctamente");
    }
}
