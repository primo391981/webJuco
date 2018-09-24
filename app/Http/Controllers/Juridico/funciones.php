<?php

	function notificacion($paso, $mensaje, $expediente){
		
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
		Mail::to($expediente->usuario->email)->send(new SendMailable($notificacion->mensaje));
		
		foreach($expediente->permisosExpedientes as $usuario){
			Mail::to($usuario->email)->send(new SendMailable($notificacion->mensaje));
		}
		// fin envío de mail
	}