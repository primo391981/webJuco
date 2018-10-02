<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;

class DetalleRecibo extends Model
{
    protected $table = 'contable_detalles_recibo';
	
	public function conceptoRecibo() {
        return $this->belongsTo('App\Contable\ConceptoRecibo','idConceptoRecibo');
    }
}
