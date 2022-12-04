<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EndProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nomeTeammate;
    public $nomeProgetto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nomeTeammate, $nomeProgetto){
        $this->nomeTeammate = $nomeTeammate;
        $this->nomeProgetto = $nomeProgetto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->subject('Il progetto '.$this->nomeProgetto . ' è concluso!')->view('notifications.termineProgetto');
    }
}
