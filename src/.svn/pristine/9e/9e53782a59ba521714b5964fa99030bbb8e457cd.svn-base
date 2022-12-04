<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeamAcceptanceMail extends Mailable{

    use Queueable, SerializesModels;

    public $nomeTeammate;
    public $nomeIdea;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nomeTeammate, $nomeIdea){
        $this->nomeTeammate = $nomeTeammate;
        $this->nomeIdea = $nomeIdea;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->subject('Sei parte del team'.(isset($this->nomeIdea)? ': '.$this->nomeIdea : ''))->view('notifications.accettazioneTeam');
    }
}
