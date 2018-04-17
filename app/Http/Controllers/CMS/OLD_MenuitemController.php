<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CMS\Menuitem;

class MenuitemController extends Controller
{
    //
	public function lista()
	{
		$menuitem = Menuitem::find(1);
		dd($menuitem->contenedores);
	}
}
