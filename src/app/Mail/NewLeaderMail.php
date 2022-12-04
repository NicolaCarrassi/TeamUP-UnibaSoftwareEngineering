<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewLeaderMail extends Mailable
{
    use Queueable, SerializesModels;


    public $nomeLeader;
    public $nomeProgetto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nomeLeader, $nomeProgetto){
        $this->nomeLeader = $nomeLeader;
        $this->nomeProgetto = $nomeProgetto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->subject('Sei diventato il leader del progetto: '.$this->nomeProgetto)->view('notifications.NominaLeader');
    }
}
