<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleRecibo extends Model
{
	use SoftDeletes;
    protected $table = 'contable_detalles_recibo';
	
	public function conceptoRecibo() {
        return $this->belongsTo('App\Contable\ConceptoRecibo','idConceptoRecibo');
    }
}
