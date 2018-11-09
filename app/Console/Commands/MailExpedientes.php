<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendMailable;
use Mail;
use Carbon\Carbon;
use App\Juridico\Recordatorio;

class MailExpedientes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:expedientes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envío de mails para información a los usuarios.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$hoy = Carbon::today();
		$recordatorios = Recordatorio::where('estado',0)->get();
		foreach($recordatorios as $recordatorio){
			$fecha_inicio = new Carbon($recordatorio->fecha_vencimiento);
			$fecha_inicio->subDays($recordatorio->cant_dias);
			if($fecha_inicio < $hoy){
				$mensaje = $recordatorio->fecha_vencimiento." ".$recordatorio->mensaje." - Recordatorio de JUCO.";
				Mail::to($recordatorio->expediente->usuario->email)->send(new SendMailable($mensaje, "Aviso de vencimiento"));
			}
		}
		
    }
}
