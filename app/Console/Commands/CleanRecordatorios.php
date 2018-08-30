<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Juridico\Recordatorio;
use Carbon\Carbon;

class CleanRecordatorios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recordatorios:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Desactivar los recordatorios caducos de expedientes';

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
        $recordatorios = Recordatorio::where([
			['estado',0],
			['fecha_vencimiento', '<', Carbon::today()]
		])->get();
		
		foreach($recordatorios as $recordatorio){
			$recordatorio->estado = 1;
			$recordatorio->save();
			//$mensaje = $recordatorio->mensaje;
			//Mail::to('primo39@gmail.com')->send(new SendMailable($mensaje));
		}
		
    }
}
