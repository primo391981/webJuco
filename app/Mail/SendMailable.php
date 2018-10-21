<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
	public $mensaje;
	public $modulo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensaje, $modulo)
    {
        $this->mensaje = $mensaje;
		$this->modulo = $modulo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('estudiogonzalezfeola@gmail.com')->subject('Notificación de Sistema Juco')->view('juridico.mail.mail');
    }
}
