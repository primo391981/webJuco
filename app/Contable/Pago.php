<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
	/*Clase que registra los pagos extras realizados por la empresa al empleado, entre ellos:
		-Viáticos
		-Adelantos
	*/
	use SoftDeletes;
	protected $table='contable_pagos';
   
	public function empleado() {
        return $this->belongsTo('App\Contable\Empleado','idEmpleado');
    }
	
	public function tiposPagos(){
		return $this->hasMany('App\Contable\TipoPago','idTipoPago');
	}
}
