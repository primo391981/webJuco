<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Empleado extends Pivot
{
    protected $table='empleados';
	
	
	public function persona() {
        return $this->belongsTo('App\Persona');
    }

    public function empresa() {
        return $this->belongsTo('App\Empresa');
    }

    public function horarios() {
        return $this->hasMany('App\Contable\HorarioEmpleado','idEmpleado'); // example relationship on a pivot model
    }
	
	
}