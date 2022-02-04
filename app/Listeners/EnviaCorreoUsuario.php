<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Mail;

class EnviaCorreoUsuario
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
     * @param  EnviarCorreo2  $event
     * @return void
     */
    public function handle(EnviarCorreo $event)
    {
        //
        $data = array('name' => $event->usuarios->name, 'email' => $event->usuarios->email, 'body' => 'Confirmamos su registro exitoso.');
 
        Mail::send('emails.mail', $data, function($message) use ($data) {
            $message->to($data['email'])
                    ->subject('LEGOPS');
            $message->from('rollower@gmail.com');
        });
    }
}
