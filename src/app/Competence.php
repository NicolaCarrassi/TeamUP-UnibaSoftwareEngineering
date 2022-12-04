<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $fillable = ['competence'];
    public $timestamps = false;

    public function skill()
    {
        return $this->hasMany('App\Skill');
    }

    public function competencesForIdea()
    {
        return $this->hasMany(CompetencesForIdea::class);
    }

}
