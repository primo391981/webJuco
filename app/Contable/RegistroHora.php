<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;

class RegistroHora extends Model
{
  protected $table='contable_registros_horas';
  public function tipoHora(){
	  return $this->belongsTo('App\Contable\TipoHora','id');
  }
  
}
