<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReciboEmpleado extends Model
{
	use SoftDeletes;
    protected $table = 'contable_recibos_empleado';
	
	protected $dates = ['deleted_at'];
	
	public function tiposRecibos() {
        return $this->belongsTo('App\Contable\TipoRecibo','idTipoRecibo');
    }
	
	public function detallesRecibos(){
		return $this->hasMany('App\Contable\DetalleRecibo','idRecibo');
	}
}
