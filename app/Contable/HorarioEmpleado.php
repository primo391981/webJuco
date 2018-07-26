<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;

class HorarioEmpleado extends Model
{
    protected $table='horariosEmpleados';
	public function horariosPorDia(){
		return $this->hasMany('App\Contable\horarioPorDia','horariosPorDia','idHorarioEmpleado');
	}
}
