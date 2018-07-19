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
	
	public function empleados(){
		return $this->belongsToMany('App\Persona','empleados','idPersona','idEmpresa')->withPivot('idCargo','fechaDesde','fechaHasta','monto');
	}
}
