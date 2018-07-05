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
	
}
