<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    //
	use SoftDeletes;
	protected $table = 'contable_cargos';
	 
    protected $dates = ['deleted_at'];
}
