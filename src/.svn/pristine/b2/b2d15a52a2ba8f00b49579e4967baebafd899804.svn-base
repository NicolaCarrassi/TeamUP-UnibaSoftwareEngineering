<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SanctionSendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nomeUtente;
    public $motivoSanzione;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nomeUtente, $motivoSanzione){
        $this->nomeUtente = $nomeUtente;
        $this->motivoSanzione = $motivoSanzione;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->subject('Hai ricevuto una sanzione')->view('notifications.invioSanzione');
    }
}
