<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Empleado extends Pivot
{
    protected $table='contable_empleados';	
	
	public function persona() {
        return $this->belongsTo('App\Persona','idPersona');
    }

    public function empresa() {
        return $this->belongsTo('App\Empresa','idEmpresa');
    }

    public function horarios() {
        return $this->hasMany('App\Contable\HorarioEmpleado','idEmpleado'); // example relationship on a pivot model
    }
	
	public function registrosHoras(){
		return $this->hasMany('App\Contable\RegistroHora','idEmpleado');
	}
	
	public function cargo(){
		return $this->belongsTo('App\Contable\Cargo','idCargo');
	}
	
}