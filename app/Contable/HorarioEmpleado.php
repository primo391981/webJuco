<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;

class HorarioEmpleado extends Model
{
    protected $table='horariosEmpleados';
	
	public function empleado(){
		return $this->belongsTo('\App\Contable\Empleado','id');
	}

	public function horariosPorDia(){
		return $this->hasMany('\App\Contable\HorarioPorDia','idHorarioEmpleado');
	}
}
