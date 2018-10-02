<?php

namespace App\Http\Controllers\Contable;
use Illuminate\Support\Facades\DB;
use App\Contable\Cargo;
use App\Contable\Remuneracion;
use App\Http\Requests\CargoRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contable\SalarioMinimoCargo;
use App\Contable\Empleado;
use Carbon\Carbon;
use Exception;


class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::All();
		return view('contable.cargo.listaCargos', ['cargos' => $cargos]);
    }
	
	public function inactivos()
    {
        $cargos = Cargo::onlyTrashed()->get();
		
		return view('contable.cargo.listaCargosInactivos', ['cargos' => $cargos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $remuneraciones = Remuneracion::All();
		return view('contable.cargo.agregarCargos', ['remuneraciones' => $remuneraciones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CargoRequest $request)
    {
		try{
		$cargo = new Cargo;
		$cargo->nombre = $request->nombre;
		$cargo->descripcion = $request->descripcion;
		$cargo->id_remuneracion = $request->id_remuneracion;
		
			DB::beginTransaction();
			$cargo->save();
			//creo el salario nuevo vigente
			$ultimoCargo=Cargo::orderBy('id','desc')->first();
			$salarioNuevo= new SalarioMinimoCargo;
			$salarioNuevo->idCargo=$ultimoCargo->id;
			$salarioNuevo->monto=$request->monto;
			$fecha=new Carbon($request->fechaInicio);
			$salarioNuevo->fechaDesde=$fecha->year.'-'.$fecha->month.'-'.$fecha->day;
			$salarioNuevo->save();
			DB::commit();
			return redirect()->route('cargo.index')->with('success', "El cargo ".$cargo->nombre." se creó correctamente");				;
		}
		catch(Exception $e){
			return back()->withInput()->withError("El cargo no se pudo registrar, intente nuevamente o contacte al administrador.");				;
		}

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contable\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show(Cargo $cargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contable\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit(Cargo $cargo)
    {
        $subtitulo = 'Editar Cargo';
		
		$remuneraciones = Remuneracion::All();
		
		return view('contable.cargo.editarCargos', ['subtitulo' => $subtitulo, 'cargo' => $cargo, 'remuneraciones' => $remuneraciones]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contable\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(CargoRequest $request, Cargo $cargo)
    {
		$cargo->nombre = $request->nombre;
		$cargo->descripcion = $request->descripcion;
		$cargo->id_remuneracion = $request->id_remuneracion;
		//try {
			
			$salario=SalarioMinimoCargo::where('idCargo','=',$cargo->id)->orderBy('id', 'desc')->take(2)->get();
			$primero=true;
			$salarioUno=null;
			$salarioDos=null;
			foreach($salario as $s){
				if($primero){
					$salarioUno=$s;
					$primero=false;
				}
				else{
					$salarioDos=$s;
				}
			}
			
			//el segundo salario
			if($salarioDos!=null){
					if($salarioDos->fechaDesde >= $request->fechaInicio){
						return back()->withInput()->withError("Fecha de inicio invalida, ya existe un salario minimo con una fecha mayor a la ingresada.");	
					}
					else{
						
						$fechaBaja=new Carbon($request->fechaInicio);
						$fechaBaja->subDay();
						$salarioDos->fechaHasta=$fechaBaja->year.'-'.$fechaBaja->month.'-'.$fechaBaja->day;
						$salarioDos->save();	
				}
			}
			
			$salarioUno->monto=$request->monto;
			$fecha=new Carbon($request->fechaInicio);
			$salarioUno->fechaDesde=$fecha->year.'-'.$fecha->month.'-'.$fecha->day;
			$salarioUno->save();
			
			$cargo->save();
			return redirect()->route('cargo.index')->with('success', "El cargo ".$cargo->nombre." se editó correctamente");	
			
		/*} catch(Exception $e){
			return back()->withInput()->withError("El cargo no se pudo registrar, intente nuevamente o contacte al administrador.");				
		}*/

    }
	
	public function activar(Request $request)
    {
		
		$cargo = Cargo::onlyTrashed()
                ->where('id', $request->cargo_id)
                ->first();
				
		$cargo->restore();
		
		return redirect()->route('cargo.index.inactivos')->with('success', "El cargo fue restaurado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contable\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cargo $cargo)
    {
		$empleado=Empleado::where('idCargo','=',$cargo->id)->first();
		if($empleado==null){
			$cargo->delete();
			return redirect()->route('cargo.index')->with('success', "El cargo fue eliminado correctamente");
		}
		else{
			return back()->withInput()->withError("El cargo esta asociado a un empleado, no se puede eliminar.");
		}		
    }
	
	public function altaSalarioMinimo(Request $request){
		try{
			//obtengo el salario vigente y le doy de baja con la fecha nueva
			$salario=SalarioMinimoCargo::where('idCargo','=',$request->selectCargo)->orderBy('id', 'desc')->first();
			$fechaNueva=$request->fechaInicio;
			if($salario->fechaDesde >= $fechaNueva){
				return back()->withInput()->withError("La fecha de inicio debe ser mayor del vigente salario minimo nacional.");	
			}else{
				$fechaBaja=new Carbon($request->fechaInicio);
				$fechaBaja->subDay();
				$salario->fechaHasta=$fechaBaja->year.'-'.$fechaBaja->month.'-'.$fechaBaja->day;
				$salario->save();
				
				//creo el salario nuevo vigente
				$salarioNuevo= new SalarioMinimoCargo;
				$salarioNuevo->idCargo=$request->selectCargo;
				$salarioNuevo->monto=$request->monto;
				$fecha=new Carbon($request->fechaInicio);
				$salarioNuevo->fechaDesde=$fecha->year.'-'.$fecha->month.'-'.$fecha->day;
				$salarioNuevo->save();
				$cargo=Cargo::find($request->selectCargo);
				return redirect()->route('cargo.index')->with('success', "Al cargo ".$cargo->nombre." se le ingreso el nuevo SALARIO MINIMO correctamente.");
			}
			
		}
		catch(Exception $e){
			return back()->withInput()->withError("El salario minimo no se pudo registrar, intente nuevamente o contacte al administrador.");				;
		}
	}
}
