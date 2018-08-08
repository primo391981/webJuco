<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;

class HorarioEmpleado extends Model
{
    protected $table='contable_horarios_empleados';
	
	public function empleado(){
		return $this->belongsTo('\App\Contable\Empleado','id');
	}

	public function horariosPorDia(){
		return $this->hasMany('\App\Contable\HorarioPorDia','idHorarioEmpleado');
	}
}
