<?php

namespace App\Http\Controllers\Contable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContableController extends Controller
{
    //
	public function index()
	{
		return view ('Contable.contable');
	}
}
