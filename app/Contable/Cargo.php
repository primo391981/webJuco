<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    //
	use SoftDeletes;
	protected $table = 'contable_cargos';
	 
    protected $dates = ['deleted_at'];
	
	public function remuneracion(){
		
		return $this->belongsTo('App\Contable\Remuneracion','id_remuneracion');
	}
	public function empresas(){
		return $this->hasMany('App\Empresa','empleados','idCargo');		
	}
	
}
