<?php

namespace App\Http\Controllers\Contable;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Contable\Empleado;
use App\Persona;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PersonaRequest;

class EmpleadoController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function altaAsociacion($idempresa,$idpersona)
    {
        $empleado=new Empleado;
		$empleado->idpersona=$idpersona;
		$empleado->idempresa=$idempresa;
		$empleado->save();		
		return redirect()->route('persona.index');
    }
	
	public function altaEmpleadoEmpresa(PersonaRequest $request)
	{
		$persona=new Persona;	
		switch($request->input('tipoDocumento'))
        {
            case "CEDULA":
                $persona->tipoDoc=1;
                break;
            case "DNI" :
                $persona->tipoDoc=2;
                break;
			case "PASAPORTE" :
                $persona->tipoDoc=3;
                break;
			case "OTROS" :
                $persona->tipoDoc=4;
                break;            
        }		
		$persona->documento=$request->input('documento');
		$persona->nombre=$request->input('nombre');
		$persona->apellido=$request->input('apellido');
		$persona->domicilio=$request->input('domicilio');
		$persona->telefono=$request->input('telefono');
		$persona->email=$request->input('email');
		$persona->cantHijos=$request->input('cantHijos');		
		$persona->estadoCivil=$request->input('estadoCivil');
		$persona->save();		
		
		/*tengo que traer desde la bd el id de la persona que guardo e insertar en empleado*/
		$perBD = DB::table('persona')->where('documento', '=',$request->input('documento'))->first();
		$empleado=new Empleado;
		$empleado->idpersona=$perBD->id;
		$empleado->idempresa=$request->idemp;
		$empleado->save();		
		
		return redirect()->route('persona.index');
			
		
	}
	
    public function store(PersonaRequest $request)
    {
		
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
		/*si una persona va trabajar en dos lugares a la vez tendria que hacer un where por el idempresa*/
	/*	$idTabla = DB::table('empleados')
			->where('idpersona', '=',$id)
			->whereNull('empleados.deleted_at')
			->first();
	
		$emp=Empleado::find($idTabla->id);
		$emp->delete();
	
		return redirect()->route('persona.index');*/
    }
}
