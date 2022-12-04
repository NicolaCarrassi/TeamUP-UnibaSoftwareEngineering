<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PartecipationRequestMail extends Mailable{
    use Queueable, SerializesModels;

    public $nomeLeader;
    public $nomeTeammate;
    public $nomeIdea;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nomeLeader, $nomeTeammate, $nomeIdea){
        $this->nomeLeader = $nomeLeader;
        $this->nomeTeammate = $nomeTeammate;
        $this->nomeIdea = $nomeIdea;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->subject('Richiesta di partecipazione per la tua idea' . (isset($this->nomeIdea)? ': '.$this->nomeIdea : ''))->view('notifications.richiestaPartecipazione');
    }
}
