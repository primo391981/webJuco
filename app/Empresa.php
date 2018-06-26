<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Empresa extends Model
{
	protected $table="empresa";
	use softDeletes;
}
