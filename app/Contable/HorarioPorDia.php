<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;

class HorarioPorDia extends Model
{
	protected $table='horariosPorDia';
	
	public function horarioEmpleado(){
		return $this->belongsTo('\App\Contable\HorarioEmpleado','id');
	}
	public function registro(){
		return $this->belongsTo('\App\Contable\Registro','id');
	}
	public function dia(){
		return $this->belongsTo('\App\Contable\Dia','id');
	}
	
}
