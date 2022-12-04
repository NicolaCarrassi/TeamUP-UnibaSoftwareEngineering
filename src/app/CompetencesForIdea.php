<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetencesForIdea extends Model
{

    use SoftDeletes;

    protected $fillable = ['competence_id', 'project_id', 'level',];

    public function competence(){
        return $this->belongsTo(Competence::class);
    }

    public function project(){
        return $this->belongsTo(ProjectualIdea::class);
    }
}
