<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskGivenMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nomeTeammate;
    public $nomeLeader;
    public $nomeProgetto;
    public $compitoAssegnato;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nomeTeammate, $nomeLeader, $nomeProgetto, $compitoAssegnato){
        $this->nomeTeammate = $nomeTeammate;
        $this->nomeLeader = $nomeLeader;
        $this->nomeProgetto = $nomeProgetto;
        $this->compitoAssegnato = $compitoAssegnato;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->subject('Le è stato assegnato un compito nel progetto '.$this->nomeProgetto)->view('notifications.assegnazioneCompito');
    }
}
