<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportProject extends Report{


    public function project(){
        return $this->belongsTo(ProjectualIdea::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
