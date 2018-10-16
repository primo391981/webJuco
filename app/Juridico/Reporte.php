<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'juridico_reportes';
	
	public function datasets(){
		return $this->hasMany('App\Juridico\Dataset','id_reporte');
	}
	
	public function usuario(){
		return $this->belongsTo('App\Administracion\User', 'user_id');
	}
}
