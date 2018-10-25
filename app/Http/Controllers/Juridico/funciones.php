<?php

use \App\Juridico\Notificacion;
use \App\Ayuda;
use Carbon\Carbon;
use \App\Mail\SendMailable;

	function notificacion($paso, $mensaje, $expediente, $modulo){
		
		//se crea una notificacion
		$notificacion = new Notificacion();
		$notificacion->id_paso = $paso->id;
		$notificacion->id_user = $paso->id_usuario;
		$notificacion->id_tipo = 1; //tipo info
		$notificacion->fecha_envio = Carbon::now();
		$notificacion->estado = 1; //se envía una notificación por mail.
		$notificacion->mensaje = $mensaje;
		
		$notificacion->save();
		
		// envío de mail, notificación de modificación	
		Mail::to($expediente->usuario->email)->send(new SendMailable($notificacion->mensaje, $modulo));
		
		foreach($expediente->permisosExpedientes as $usuario){
			\Mail::to($usuario->email)->send(new SendMailable($notificacion->mensaje, $modulo));
		}
		// fin envío de mail
	}
	
	function ayuda(){
		$ayuda = Ayuda::where('ruta',Route::currentRouteName())->first();
		
		if($ayuda!=null)
			return $ayuda->texto;
		else
		//	return "Ayuda en construcción";
			return Route::currentRouteName();
	}
	
