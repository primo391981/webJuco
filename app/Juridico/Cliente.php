<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
	use SoftDeletes;
	
    protected $table = "juridico_clientes";
	protected $dates = ['deleted_at'];
	
	public function persona()
    {
        return $this->morphTo();
    }
	
	public function expedientes(){
		return $this->belongsToMany('App\Juridico\Expediente','juridico_cliente_expediente','id_cliente','id_expediente');
	}
}
