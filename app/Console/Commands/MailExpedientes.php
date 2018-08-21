<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendMailable;
use Mail;

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
        $mensaje = "mail de prueba de juco";
        Mail::to('primo39@gmail.com')->send(new SendMailable($mensaje));
    }
}
