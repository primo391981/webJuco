<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\TipoDoc;
use App\Contable\TipoRecibo;
use App\Contable\Empleado;
use App\Contable\ReciboEmpleado;
use App\Contable\DetalleRecibo;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Contable\TipoPago;
use Carbon\Carbon;
use Exception;

class EmpresaController extends Controller
{
	//listado de todas las empresas activas en el sistema
    public function index()
    {
       $empresas=Empresa::All();
	   return view('contable.empresa.listaEmpresas', ['empresas' => $empresas]);
	   //este es el camino de las carpetas hasta llegar al blade correspondiente
    }
	//listado de todas las empresas inactivas en el sistema
   public function desactivada()
    {
       $empresas=Empresa::onlyTrashed()->get();
	   return view('contable.empresa.listaNoEmpresas', ['empresas' => $empresas]);
	   //este es el camino de las carpetas hasta llegar al blade correspondiente
    }

    public function create()
    {
        //return vista con FORM para add empresa
		return view('contable.empresa.agregarEmpresa',[]);
    }
	
	//guardar empresa en la BD
    public function store(EmpresaRequest $request)
    {
		try{
        $empresa = new Empresa;
		$empresa->rut=$request->input('rut');
		$empresa->razonSocial=$request->input('razonSocial');
		$empresa->nombreFantasia=$request->input('nombreFantasia');
		$empresa->domicilio=$request->input('domicilio');
		$empresa->numBps=$request->input('numBps');
		$empresa->numBse=$request->input('numBse');
		$empresa->numMtss=$request->input('numMtss');
		$empresa->grupo=$request->input('grupo');
		$empresa->subGrupo=$request->input('subGrupo');
		$empresa->email=$request->input('email');
		$empresa->telefono=$request->input('telefono');
		$empresa->nomContacto=$request->input('nomContacto');
		$empresa->save();		
		
		return redirect()->route('empresa.index');
		}
		catch(Exception $e){
			if($e->getCode()==23000){
				return back()->withInput()->withError("Ya existe un empresa con esos datos. RUT - GRUPO - SUBGRUPO");
			}else{
				return back()->withInput()->withError("La empresa no se pudo registrar, intente nuevamente o contacte al administrador.");
			}
		}
    }
	//mostrar info de la empresa segun el id
    public function show($id)
    {	
        $empresa=Empresa::find($id);
		$tiposDocumentos=TipoDoc::All();
		return view('contable.empresa.verEmpresa',['empresa'=>$empresa,'tipoDoc'=>$tiposDocumentos]);	
    }
	//editar datos de la empresa segun el id
    public function edit($id)
    {
        $empresa=Empresa::find($id);
		return view('contable.empresa.editarEmpresa',['empresa'=>$empresa]);
    }

	//guardar datos actualizados de la empresa segun el id
    public function update(EmpresaRequest $request, $id)
    {
		try{
		$empresa=Empresa::find($id);
		$empresa->rut=$request->input('rut');
		$empresa->razonSocial=$request->input('razonSocial');
		$empresa->nombreFantasia=$request->input('nombreFantasia');
		$empresa->domicilio=$request->input('domicilio');
		$empresa->numBps=$request->input('numBps');
		$empresa->numBse=$request->input('numBse');
		$empresa->numMtss=$request->input('numMtss');
		$empresa->grupo=$request->input('grupo');
		$empresa->subGrupo=$request->input('subGrupo');
		$empresa->email=$request->input('email');
		$empresa->telefono=$request->input('telefono');
		$empresa->nomContacto=$request->input('nomContacto');
		$empresa->save();
		return redirect()->route('empresa.index');
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
    }

	//eliminado logico de empresa por id
    public function destroy($id)
    {
		try{
			$empresa=Empresa::find($id);
			$personasAsociados=$empresa->personas;
			$encontre=false;
			
			foreach($personasAsociados as $persona){
				if($persona->pivot->habilitado==true){
					$encontre=true;
				}
			}		
			if($encontre){
				return back()->withInput()->withError("Debe desvincular todos los empleados de la empesa antes de eliminarla.");
			}
			else{
				$empresa->delete();
				return redirect()->route('empresa.index')->with('success', "La empresa se eliminio correctamente.");			
			}		
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
    }
	
	public function restaurar($id)
    {
		try{
		$empresa= Empresa::onlyTrashed()->where('id',$id);			
		$empresa->restore();
		return redirect()->route('empresa.index');
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
	}
	
	/*REPORTES*/
	//retornaa la vista con los listado de reportes de contable 
	public function listadoReportes(){
		try{
			$empresas=Empresa::All();
			$tiposRecibo=TipoRecibo::All();
			return view('contable.reporte.listaReportes', ['empresas' => $empresas,'tiposRecibo'=>$tiposRecibo]);
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
	}
	
	//pasa los datos necesarios para arma grafico de contable 
	public function reporte(Request $request){
		try{
			$empresa=Empresa::find($request->empresa);
			$empleados=$empresa->personas()->where('habilitado',1)->get();
			
			$fecha=$this->formatoFecha($request->fecha,$request->tiporec);
			$montos=$this->montosRecibo($empleados,$request->tiporec,$fecha);
			
			$montoTotal=0;		
			foreach($montos as $m){
				$montoTotal=$montoTotal+$m;
			}
			$data= [
				'labels'=>$empleados->pluck('documento'),
				'datasets'=> [[
					'label'=>'Monto total: '.$montoTotal,
					'data'=> $montos,
					'backgroundColor'=>$this->poolColors($empleados->count()),
					'borderColor'=> [],
					'borderWidth'=> 1
				]]
			];		
			$jsonArmado=json_encode($data);
			$titulo=$request->titulo.' / Fecha: '.$fecha;
			return view('contable.reporte.grafico', ['jsonArmado' => $jsonArmado,'tipografico'=>$request->tipografico,'titulo'=>$titulo]);		
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
	}

	//reporte de aportes por empresa en un mes/ anio
	public function aporteSueldos(Request $request){
		try{
			$empresa=Empresa::find($request->empresa);
			$empleados=$empresa->personas()->where('habilitado',1)->get();
			
			$fecha=$this->formatoFecha($request->fecha,1);
			$montos=$this->montosAportes($empleados,1,$fecha);
			
			$totalaportes=0;
			foreach($montos as $m){
				$totalaportes=$totalaportes+$m;
			}		
			$data= [
				'labels'=>['BPS - $'.$montos[0],'FONASA - $'.$montos[1],'IRPF PRIMARIO - $'.$montos[2],'IRPF DEDUCCIONES - $'.$montos[3],'FRL - $'.$montos[4]],
				'datasets'=> [[
					'label'=>'APORTES :'.$totalaportes,
					'data'=>[$montos[0],$montos[1],$montos[2],$montos[3],$montos[4]],
					'backgroundColor'=> $this->poolColors($montos->count()),
					'borderColor'=> [],
					'borderWidth'=> 1
				]]
			];		
			$jsonArmado=json_encode($data);
			$faux=new Carbon($fecha);
			$titulo=$request->titulo.' / Fecha: '.$faux->year.'-'.$faux->month;
			return view('contable.reporte.grafico', ['jsonArmado' => $jsonArmado,'tipografico'=>$request->tipografico,'titulo'=>$titulo]);
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
	}
		
		
	//funcion de armado de pdf de recibos paraimprimir
	public function imprimirRecibos(Request $request){
		try{
			$empresa=Empresa::find($request->empresa);
			$tipoRecibo=TipoRecibo::find($request->tiporec);
			$empleados=$empresa->personas()->where('habilitado',1)->get();
			
			$fecha=$this->formatoFecha($request->fecha,$request->tiporec);
			$recibos = collect([]);
			foreach($empleados as $emp){		
				
				if($tipoRecibo->id ==5||$tipoRecibo->id ==4 ){
					$finicio=$fecha.'-01';
					$faux=new Carbon($fecha);
					$ffin=$faux->year.'-'.$faux->month.'-'.$faux->daysInMonth;
					$recibo=ReciboEmpleado::where('idEmpleado','=',$emp->pivot->id)->where('idTipoRecibo','=',$tipoRecibo->id)->whereBetween('fechaRecibo', [$finicio,$ffin])->first();
				}
				else{
					$recibo=ReciboEmpleado::where('idEmpleado','=',$emp->pivot->id)->where('idTipoRecibo','=',$tipoRecibo->id)->where('fechaRecibo','=',$fecha)->first();
				}
				
				if($recibo!=null){
					
					$empleadoPago = collect([]);				
					$empleadoPago->push($recibo);				
					$tipoPago = TipoPago::All();
					$faux=new Carbon($fecha);
					
					if($recibo->idTipoRecibo==1||$recibo->idTipoRecibo==5){
						foreach($tipoPago as $tp)
						{
							$empleadoPago->push($recibo->empleado->pagos()->where([['fecha','=',$faux->year.'-'.$faux->month.'-01'], ['idTipoPago','=',$tp->id]])->get());
						}
					}
					$recibos->push($empleadoPago);
				}
			}
			
			$datos=['recibos'=>$recibos,'tipoRecibo'=>$tipoRecibo,'fecha'=>$fecha,'empresaNombre'=>$empresa->razonSocial];
			$pdf=PDF::loadView('contable.reporte.imprimir',$datos);//imprimir es el nombre de la vista
			
			return $pdf->download("RECIBOS ".$tipoRecibo->nombre." ".$empresa->razonSocial." ".$fecha.".pdf");
		}
		catch(Exception $e){
			return back()->withInput()->withError("Error en el sistema");
		}
	}
	
	//devuelve una fecha formateada segun el tipo de recibo elegido
	private function formatoFecha($fecha,$tiporec){
		switch($tiporec){
			case 1:
				$faux=$fecha."-01";
				break;
			case 2:
				$faux=$fecha.'-06-01';
				break;
			case 3:
				$faux=$fecha.'-12-01';
				break;
			case 4:
				$faux=$fecha;
				break;
			case 5:
				$faux=$fecha;
				break;
		}
		
		return $faux;
	}
	//devuele un array por empleado de los montos liquidos a cobrar
	private function montosRecibo($empleados,$idTipoRecibo,$fecha){
		$montos = collect([]);
		foreach($empleados as $emp){
			if($idTipoRecibo ==5||$idTipoRecibo ==4 ){
				$finicio=$fecha.'-01';
				$faux=new Carbon($fecha);
				$ffin=$faux->year.'-'.$faux->month.'-'.$faux->daysInMonth;
				$recibo=ReciboEmpleado::where('idEmpleado','=',$emp->pivot->id)->where('idTipoRecibo','=',$idTipoRecibo)->whereBetween('fechaRecibo', [$finicio,$ffin])->first();
			}
			else{
				$recibo=ReciboEmpleado::where('idEmpleado','=',$emp->pivot->id)->where('idTipoRecibo','=',$idTipoRecibo)->where('fechaRecibo','=',$fecha)->first();
			}
			
			if($recibo==null){
				$montos->push("0");
			}
			else{
				$detalle=DetalleRecibo::where('idRecibo','=',$recibo->id)->where('idConceptoRecibo','=',27)->first();
				$montos->push($detalle->monto);				
			}
		}
		return $montos;
		
	}

		//calcula la suma total de aportes por empresa segun el tipo de recibo y fecha
	private function montosAportes($empleados,$idTipoRecibo,$fecha){
		$montos = collect([]);
		$totalbps=0;
		$totalfonasa=0;
		$totalirpfprimario=0;
		$totalirpfdeducciones=0;
		$totalfrl=0;
		foreach($empleados as $emp){
			$recibo=ReciboEmpleado::where('idEmpleado','=',$emp->pivot->id)->where('idTipoRecibo','=',$idTipoRecibo)->where('fechaRecibo','=',$fecha)->first();
			if($recibo!=null){
				$detalle=DetalleRecibo::where('idRecibo','=',$recibo->id)->where('idConceptoRecibo','=',20)->first();
				$totalbps=$totalbps+$detalle->monto;
				$detalle=DetalleRecibo::where('idRecibo','=',$recibo->id)->where('idConceptoRecibo','=',21)->first();
				$totalfonasa=$totalfonasa+$detalle->monto;
				$detalle=DetalleRecibo::where('idRecibo','=',$recibo->id)->where('idConceptoRecibo','=',22)->first();
				$totalirpfprimario=$totalirpfprimario+$detalle->monto;
				$detalle=DetalleRecibo::where('idRecibo','=',$recibo->id)->where('idConceptoRecibo','=',23)->first();
				$totalirpfdeducciones=$totalirpfdeducciones+$detalle->monto;
				$detalle=DetalleRecibo::where('idRecibo','=',$recibo->id)->where('idConceptoRecibo','=',24)->first();
				$totalfrl=$totalfrl+$detalle->monto;
			}		
		}
		
		
		$montos->push($totalbps);
		$montos->push($totalfonasa);
		$montos->push($totalirpfprimario);
		$montos->push($totalirpfdeducciones);
		$montos->push($totalfrl);
		
		return $montos;
	
	}
	
	//devuleve un color rgb
	private function dynamicColors() {
		$r = rand (0,255);
		$g = rand (0,255);
		$b = rand (0,255);
		$rgb="rgba(".$r.",".$g.",".$b.", 0.5)";
		return $rgb;
	}
	//devuelve una coleccion de colores
	private function poolColors($a) {
            $pool = collect([]);
            for($i=0;$i<$a;$i++){
               $pool->push($this->dynamicColors());}
            return $pool;
       }		
}
