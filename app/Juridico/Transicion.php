<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class Transicion extends Model
{
    protected $table = 'juridico_transicion';
	
	public function siguiente(){
		return $this->belongsTo('App\Juridico\TipoPaso','id_paso_siguiente');
	}
	
	public function inicial(){
		return $this->belongsTo('App\Juridico\TipoPaso','id_paso_inicial');
	}
}
