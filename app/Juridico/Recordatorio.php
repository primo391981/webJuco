<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    protected $table = 'juridico_recordatorio';
	
	public function expediente(){
		return $this->belongsTo('App\Juridico\Expediente','id_expediente');
	}
}
