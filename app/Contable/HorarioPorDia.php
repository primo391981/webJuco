<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;

class HorarioPorDia extends Model
{
	protected $table='horariosPorDia';
	public function horarioEmpleado(){
		return $this->belongsTo('App\Contable\horarioEmpleado','horariosEmpleados');
	}
	public function dia(){
		return $this->belongsTo('App\Contable\Dia','dias');
	}
	public function registro(){
		return $this->belongsTo('App\Contable\Registro','registros');
	}
}
