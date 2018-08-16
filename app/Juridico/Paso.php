<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class Paso extends Model
{
    protected $table = 'juridico_paso_expediente';
	
	public function expediente(){
		
		return $this->belongsTo('App\Juridico\Expediente','id_expediente');
	
	}
	
	public function tipo(){
		
		return $this->belongsTo('App\Juridico\TipoPaso','id_tipo');
	
	}
	
	public function archivos(){
		
		return $this->hasMany('App\Juridico\ArchivoPaso','id_paso');
	
	}
	
	public function notas(){
		
		return $this->hasMany('App\Juridico\Nota','id_paso');
	
	}
	
	public function notificaciones(){
		
		return $this->hasMany('App\Juridico\Notificacion','id_paso');
	
	}
	
	public function permisos(){
		
		return $this->hasMany('App\Juridico\PermisoPaso','id_paso','id_expediente','id_cliente');
	
	}
	
	public function usuario(){
		
		return $this->belongsTo('App\Administracion\User','id_usuario');
	
	}
}
