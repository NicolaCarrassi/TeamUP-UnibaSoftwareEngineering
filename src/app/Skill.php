<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model{
    protected $fillable = ['user_id', 'competence_id', 'level'];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function competence(){
        return $this->belongsTo('App\Competence');
    }
}
