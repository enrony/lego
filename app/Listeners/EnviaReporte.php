<?php

namespace App\Listeners;

use App\Events\EnviarCorreo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Usuarios;

use Mail;

class EnviaReporte
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EnviarCorreo  $event
     * @return void
     */
    public function handle(EnviarCorreo $event)
    {
        //
        $reporte = Usuarios::selectRaw("country, count(id) as cantidad")->groupBy('country')->orderBy('country')->get();

        $data = array('reporte' => $reporte, 'email' => $event->usuarios->email, 'body' => 'Reporte de registro de usuarios por paises.');
 
        Mail::send('emails.mail_admin', $data, function($message) use ($data) {
            $message->to(config('app.administrador'))
                    ->subject('Sistema de notificaciones - LEGOPS');
            $message->from('rollower@gmail.com');
        });

    }
}
