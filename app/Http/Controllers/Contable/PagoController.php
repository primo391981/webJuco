<?php

namespace App\Http\Controllers\Contable;

use App\Contable\Pago;
use App\Persona;
use App\Empresa;
use App\Contable\Empleado;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PagoRequest;
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
		//dd($request);	
        $empresa = Empresa::where("rut","=",$request->rut)->get();
		$persona = Persona::where([["tipoDocumento",'=',$request->tipoDocId], ["documento",'=',$request->numeroDoc]])->get();
		$empleado = Empleado::where([["idEmpresa",'=',$empresa->id], ["idPersona",'=',$persona->id]])->get();
		//dd($empleado);
		
		/*new Cargo;
		$cargo->nombre = $request->nombre;
		$cargo->descripcion = $request->descripcion;
		$cargo->id_remuneracion = $request->id_remuneracion;*/
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
