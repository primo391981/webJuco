<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class ArchivoPaso extends Model
{
    protected $table = 'juridico_archivo';
	
	public function tipo(){
		
		return $this->belongsTo('App\Juridico\TipoArchivo','id_tipo')
	}
}
