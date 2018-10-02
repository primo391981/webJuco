<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;

class ReciboEmpleado extends Model
{
	protected $table = 'contable_recibos_empleado';
	
	protected $dates = ['deleted_at'];
	
	public function tiposRecibos() {
        return $this->belongsTo('App\Contable\TipoRecibo','idTipoRecibo');
    }
	
	public function detallesRecibos(){
		return $this->hasMany('App\Contable\DetalleRecibo','idRecibo');
	}
	
	public function empleado(){
		return $this->belongsTo('App\Contable\Empleado','idEmpleado');
	}
}
