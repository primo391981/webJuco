<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Empresa extends Model
{
	protected $table="empresa";
	use softDeletes;
	
	public function cliente()
    {
        return $this->morphMany('\App\Contable\Cliente', 'persona');
    }
	
	public function personas(){
		//return $this->belongsToMany('App\Persona','empleados','idPersona','idEmpresa')->withPivot('id','idCargo','fechaDesde','fechaHasta','monto','horarioCargado');
		return $this->belongsToMany('App\Persona','empleados','idEmpresa','idPersona')->using('App\Contable\Empleado')->withPivot('id','idCargo','fechaDesde','fechaHasta','monto','horarioCargado','valorHora');
	}
}
