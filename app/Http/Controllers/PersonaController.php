<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Persona;
use App\Empresa;
use App\Contable\Empleado;
use App\TipoDoc;
use App\EstadoCivil;

use App\Http\Requests\PersonaRequest;
use App\Http\Controllers\Controller;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas=Persona::All();
		$empleados = DB::table('empleados')
			->join('empresa','empleados.idempresa','=','empresa.id')
            ->whereNull('empleados.deleted_at')
            ->select('empleados.*','empresa.*')
            ->get();		
		return view('contable.persona.listaPersonas', ['personas' => $personas,'empleados'=>$empleados]);
    }
	
	public function desactivado()
    {
       $personas=Persona::onlyTrashed()->get();
	   return view('contable.persona.listaNoPersonas', ['personas' => $personas]);
	   //este es el camino de las carpetas hasta llegar al blade correspondiente
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$tiposDocumentos=TipoDoc::All();
		$estados = EstadoCivil::All();
		return view('contable.persona.agregarPersona',['tiposdoc'=>$tiposDocumentos, 'estados'=>$estados]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaRequest $request)
    {   
	
		$persona=new Persona;
		
		$persona->tipoDocumento = $request->input('tipodoc');		
		$persona->documento=$request->input('documento');
		$persona->nombre=$request->input('nombre');
		$persona->apellido=$request->input('apellido');
		$persona->domicilio=$request->input('domicilio');
		$persona->telefono=$request->input('telefono');
		$persona->email=$request->input('email');
		$persona->cantHijos=$request->input('cantHijos');		
		$persona->estadoCivil=$request->input('estadoCivil');		
		$persona->save();		
		return redirect()->route('persona.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$empleado = DB::table('empleados')->where([
			['idpersona', '=', $id],
			['deleted_at', '=', null],			
		])->first();
		//con first devulve uno solo, con get una coleccion de datos
		
        $persona=Persona::find($id);
		$empresas=Empresa::All();
		return view('contable.persona.verPersona',['persona'=>$persona,'empresas'=>$empresas,'empleado'=>$empleado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona=Persona::find($id);
		$tiposDocumentos=TipoDoc::All();
		$estados = EstadoCivil::All();
		
		return view('contable.persona.editarPersona',['persona'=>$persona, 'tiposdoc'=>$tiposDocumentos, 'estados'=>$estados]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonaRequest $request, $id)
    {
        $persona=Persona::find($id);		
		$persona->documento=$request->input('documento');
		$persona->nombre=$request->input('nombre');
		$persona->apellido=$request->input('apellido');
		$persona->domicilio=$request->input('domicilio');
		$persona->telefono=$request->input('telefono');
		$persona->email=$request->input('email');
		$persona->cantHijos=$request->input('cantHijos');		
		$persona->estadoCivil=$request->input('estadoCivil');		
		$persona->save();
		return redirect()->route('persona.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona=Persona::find($id);
		$persona->delete();
		
		return redirect()->route('persona.index');
    }
	public function restaurar($id)
    {
		$persona= Persona::onlyTrashed()->where('id',$id);			
		$persona->restore();
		return redirect()->route('persona.index');
    }
}
