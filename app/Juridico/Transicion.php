<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class Transicion extends Model
{
    protected $table = 'juridico_transicion';
	
	public function siguiente(){
		return $this->hasMany('App\Juridico\Paso')
		
	}
}
