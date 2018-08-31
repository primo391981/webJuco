<?php

namespace App\Contable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BajaMotivo extends Model
{
   use SoftDeletes;
	protected $table = 'contable_baja_motivos';
}
