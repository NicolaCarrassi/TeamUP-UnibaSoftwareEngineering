<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AbandonProjectMail extends Mailable{
    use Queueable, SerializesModels;

    public $nomeLeader;
    public $nomeTeammate;
    public $nomeProgetto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nomeLeader, $nomeTeammate, $nomeProgetto){
        $this->nomeLeader = $nomeLeader;
        $this->nomeTeammate = $nomeTeammate;
        $this->nomeProgetto = $nomeProgetto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->subject('Un utente ha abbandonato il tuo progetto' . (isset($this->nomeProgetto)? ': '.$this->nomeProgetto : ''))->view('notifications.abbandonoProgetto');
    }
}
