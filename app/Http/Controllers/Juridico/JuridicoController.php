<?php

namespace App\Http\Controllers\Juridico;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JuridicoController extends Controller
{
    public function index()
	{
		return view ('juridico.juridico');
	}
}
