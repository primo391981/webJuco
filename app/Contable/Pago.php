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
	
	/*public function empresas(){
		//VER ESTO
		return $this->belongsTo('App\Empresa','contable_empleados','idPersona','idEmpresa')->using('App\Contable\Empleado')->withPivot('id','idCargo','fechaDesde','fechaHasta','monto','horarioCargado','valorHora');
	}
	*/
}
