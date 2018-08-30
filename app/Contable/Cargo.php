<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{    
	use SoftDeletes;
	protected $table = 'contable_cargos';
	 
    protected $dates = ['deleted_at'];
	
	public function remuneracion(){		
		return $this->belongsTo('App\Contable\Remuneracion','id_remuneracion');
	}
	
	public function empleados(){
		return $this->hasManyThrough('App\Empresa', 'App\Empleado');		
	}
	
	public function salarios() {
        return $this->hasMany('App\Contable\SalarioMinimoCargo','idCargo');
    }
}