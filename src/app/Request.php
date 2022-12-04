<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model{

    const IN_SOSPESO = 0;
    const ACCETTATA = 1;
    const RIFIUTATA = 2;

    public $timestamps = false;

    protected $guarded = [];


    public function teammate(){
        return $this->belongsTo(User::class);
    }

    public function project(){
        return $this->belongsTo(ProjectualIdea::class);
    }


}
