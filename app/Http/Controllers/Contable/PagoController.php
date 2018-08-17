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
	
		$viatico = new Pago;
		$viatico->idEmpleado = $empleado->id;
		$viatico->idTipoPago = $request->tipoPago;
		$viatico->fecha = $request->fecha;
		$viatico->monto = $request->monto;
		$viatico->descripcion = $request->descripcion;
			
		try {
			$viatico->save();
			return redirect()->route('pago.viaticos')->with('success', "El viático se cargo correctamente.");				;
		} 
		catch(Exception $e){
			return back()->withInput()->withError("El viático no se pudo registrar, intente nuevamente o contacte al administrador.");				;
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
