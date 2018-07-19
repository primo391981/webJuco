<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    protected $table="persona";
	use softDeletes;
	
	public function cliente()
    {
        return $this->morphMany('\App\Contable\Cliente', 'persona');
    }
	
	public function tipoDoc()
	{
		return $this->belongsTo('App\tipoDoc', 'tipoDocumento');
	}
	
	public function eCivil()
	{
		return $this->belongsTo('App\EstadoCivil', 'estadoCivil');
	}
	
	public function empresas(){
		return $this->belongsToMany('App\Empresa','empleados','idPersona','idEmpresa')->withPivot('idCargo','fechaDesde','fechaHasta','monto');
	}
}
