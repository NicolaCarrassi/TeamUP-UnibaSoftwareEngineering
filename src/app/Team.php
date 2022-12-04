<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $fillable = ['project_id', 'teammate_id', 'join_date',];

    public $timestamps = false;

    public function teammate(){
        return $this->belongsTo(User::class);
    }

    public function projectualIdea(){
        return $this->belongsTo(ProjectualIdea::class);
    }

}
