<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table="empleados";
	
	public function horasPorDia(){
		return $this->hasMany('App\Contable\hrDiaEmp','horasDiasEmp');
	}
}
