<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParametroGeneral extends Model
{
    use SoftDeletes;
	
	protected $table = 'contable_parametros_generales';
	
	protected $dates = ['deleted_at'];
}
