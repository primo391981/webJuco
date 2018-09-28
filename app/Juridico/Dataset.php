<?php

namespace App\Juridico;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    protected $table = 'juridico_datasets';
	
	public function getMaxpasoAttribute(){
		return json_decode($this->dataset);
	}
	
	public function getMinpasoAttribute(){
		return json_decode($this->dataset);
	}
}
