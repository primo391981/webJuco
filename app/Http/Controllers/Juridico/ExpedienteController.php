<?php

namespace App\Http\Controllers\Juridico;

use App\Juridico\Expediente;
use App\Juridico\Cliente;
use App\Juridico\Transicion;
use App\Juridico\TipoExpediente;
use App\Juridico\Paso;
use App\Administracion\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SoapClient;
use SoapFault;
use Auth;
use DB;
use Carbon\Carbon;

class ExpedienteController extends Controller
{
	private function checkPermiso(){
		if(Auth::user()->hasRole('invitado')){
			return abort(403, 'Unauthorized action.');
		}
	}
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user = Auth::user();
	   
		//definir lista de expedientes de acuerdo a los permisos
		if($user->hasRole('invitado')){
			$expedientes = $user->permisosExpedientes;
		} else {
			$expedientes = Expediente::All();
		}
	
		return view('juridico.expediente.listaExpediente', ['expedientes' => $expedientes]);
		
    }
	
	//función que accede al webservice del Poder Judicial para obtener los datos del expediente
	public function search(Request $request){
		
		$this->checkPermiso();
		
		$iue = $request->iue;
		
		$exp = Expediente::where(DB::raw('REPLACE(iue, " ", "")'),str_replace(' ','',$iue))->get();
		
		if($exp->count() > 0){
			return back()->withInput()->withError('El iue ingresado ya se encuentra registrado en el sistema. Ingrese un nuevo iue.');
		}
		
		try { 
			$wsdl = "http://www.expedientes.poderjudicial.gub.uy/wsConsultaIUE.php?wsdl";    
			$client = new SoapClient($wsdl);
			$expediente = $client->ConsultaIUE($iue);
        } catch (SoapFault $e) { 
			return back()->withInput()->withError('El sistema del Poder Judicial no se encuentra disponible en este momento. Haga click <a href='.route('expediente.create.manual').'>aquí</a> para ingresar un iue de forma manual.');
		} 	
		
		if($expediente->estado === "EL EXPEDIENTE NO SE ENCUENTRA EN EL SISTEMA"){
			return back()->withInput()->withError('El expediente no se encuentra en el sistema del Poder Judicial. Haga click <a href='.route('expediente.create.manual').'>aquí</a> para ingresar un iue de forma manual.');
		} elseif($expediente->estado === "EL EXPEDIENTE MANTIENE RESERVA") {
			return back()->withInput()->withError('El expediente se encuentra bajo reserva. Haga click <a href='.route('expediente.create.manual').'>aquí</a> para ingresar un iue de forma manual.');
		} else {
			$tipoExpedientes = TipoExpediente::All();
			$clientes = Cliente::All();
			return view('juridico.expediente.agregarExpediente',['clientes' => $clientes, 'tipoExpedientes' => $tipoExpedientes, 'expediente' => $expediente]);
		}
		
		
	}

	//Creación manual de un expediente
	public function createManual()
    {
        //solo usuarios admin
		$this->checkPermiso();
		
		$tipoExpedientes = TipoExpediente::All();
		$clientes = Cliente::All();
		$expediente = new Expediente();
		return view('juridico.expediente.agregarExpediente',['clientes' => $clientes, 'tipoExpedientes' => $tipoExpedientes, 'expediente' => $expediente]);
    }
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		//solo usuarios admin
        $this->checkPermiso();
		
		return view('juridico.expediente.webserviceExpediente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//solo usuarios admin
		$this->checkPermiso();
		
		//dd($request);
		
		$request->validate([
			'IUE' => 'required|unique:juridico_expedientes',
		]);
		
		//creación del expediente
		$expediente = new Expediente();
		$expediente->iue = $request->IUE;
		$expediente->tipo_id = $request->tipoexp;
		$expediente->caratula = $request->caratula;
		$expediente->fecha_inicio = $request->fecha_inicio;
		$expediente->fecha_inicio = $request->fecha_inicio;
		$expediente->juzgado = $request->juzgado;
		$expediente->estado_id = 1;
		$expediente->user_id = Auth::user()->id;
		
		$expediente->save();
		
		//registros de los clientes del expediente
		foreach($request->clientes as $cliente){
			$expediente->clientes()->attach($cliente);
		}
		
		//Creación del paso de creación del expediente
		$paso = new Paso();
		$paso->id_expediente = $expediente->id;
		$paso->id_tipo = 1;
		$paso->id_usuario = Auth::user()->id;
		$paso->comentario = "Expediente creado";
		$paso->flujo = 0;
		$paso->fecha_fin = null;
		
		$paso->save();
		
		//se crea una notificación y se envía por mail
		$msg = Carbon::now()." - El expediente ".$expediente->iue." ha sido creado por le usuario ".Auth::user()->name.".";
		notificacion($paso, $msg, $expediente);
		
		//Creación del paso de creación del expediente
		if ($request->exists('nextExpediente')){
			return view('juridico.expediente.agregarPaso', ['expediente' => $expediente, 'numero_paso' => 1, 'nombre_paso' => "Adjuntar Demanda"])->with('success', "El expediente se creó correctamente.");
		} else {
			return redirect()->route('expediente.index')->with('success', "El expediente se creó correctamente.");
		}
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Juridico\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function show(Expediente $expediente)
    {
		//se obtiene el usuario actual
		$user = Auth::user();
		
		//se restringe el acceso a usuarios con el rol adecuado
		if($user->hasRole('invitado')){
			if(!$user->permisosExpedientes->contains($expediente)){
				return abort(403, 'Unauthorized action.');
			};
		};
		
		//array de pasos en los que se encuentra el expediente
		$pasosActuales = array();
		
		//array de pasos del expediente
		$pasos = array();
		
		foreach($expediente->pasos as $paso){
			array_push($pasos,$paso->id_tipo);
			if($paso->fecha_fin == null){
				array_push($pasosActuales,$paso->id_tipo);
			}
		}
		
		//listado de transiciones a las cuales puede seguir el expediente
		$transiciones = $expediente->tipo->transiciones->whereIn('id_paso_inicial',$pasosActuales)->whereNotIn('id_paso_siguiente',$pasos);
		
		$usuarios = User::All();
		
		return view('juridico.expediente.verExpediente', ['expediente' => $expediente, 'transiciones' => $transiciones, 'usuarios' => $usuarios]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Juridico\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function edit(Expediente $expediente)
    {
		//si el usuario actual tiene los roles adecuados
		$this->checkPermiso();
		
        $tipoExpedientes = TipoExpediente::All();
		$clientes = Cliente::All();
		return view('juridico.expediente.editarExpediente',['clientes' => $clientes, 'tipoExpedientes' => $tipoExpedientes, 'exp' => $expediente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Juridico\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expediente $expediente)
    {
		//si el usuario actual tiene los roles adecuados
        $this->checkPermiso();
		
		$expediente->tipo_id = $request->tipoexp;
		$expediente->fecha_inicio = $request->fecha_inicio;
		$expediente->user_id = Auth::user()->id;
		
		$expediente->save();
		
		//se borra la lista de usuarios y se actualiza a continuación
		$expediente->clientes()->detach();
		
		foreach($request->clientes as $cliente){
			$expediente->clientes()->attach($cliente);
		}
		
		return redirect()->route('expediente.index')->with('success', "El expediente fue modificado correctamente.");

    }

	public function addPermiso(Request $request, Expediente $expediente)
	{
		//si el usuario actual tiene los roles adecuados
		$this->checkPermiso();
		
		//Se eliminan los permisos previos del usuario
		if($expediente->permisosExpedientes->contains($request->usuario)){
			$expediente->permisosExpedientes()->detach($request->usuario);
		};
		
		//Se registran los permisos del usuario
		$expediente->permisosExpedientes()->attach($request->usuario, ['id_tipo' => $request->tipoPermiso]);

		return redirect()->back()->with('success', 'Permiso asignado correctamente');
	}
	
	public function delPermiso(Request $request, Expediente $expediente)
	{
		//si el usuario actual tiene los roles adecuados
		$this->checkPermiso();
		
		//se eliminan los permisos del usuario
		$expediente->permisosExpedientes()->detach($request->usuario);

		return redirect()->back()->with('success', 'Permiso eliminado correctamente');
	}
}
