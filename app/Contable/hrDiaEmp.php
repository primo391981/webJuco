<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;

class hrDiaEmp extends Model
{
    protected $table="horasDiasEmp";
	
	public function dia(){
		return $this->belongsTo('App\Contable\Dia','dias');
	}
}
