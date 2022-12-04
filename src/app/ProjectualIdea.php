<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;

class ProjectualIdea extends Model
{

    const MIN_COMPONENTS = 2;
    const MAX_COMPONENTS = 100;
    const MIN_LENGHT_NAME_IDEA = 2;
    const MAX_LENGHT_NAME_IDEA = 50;
    const MAX_LENGHT_DESCRIPTION = 300;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'category_id', 'leader_id', 'numberOfComponentsRequired', 'numberOfComponentsActual', 'image', 'needToMeet', 'city', 'idea_proposal_at', 'teammates',
    ];

    protected $guarded = [];

    public $timestamps = false;



    public function category(){
        return $this->hasOne(Category::class);
    }

    public function leader(){
        return $this->hasOne(Leader::class);
    }

    public function competencesForIdea(){
        return $this->hasMany(CompetencesForIdea::class);
    }

    public function reportProject(){
        return $this->hasMany(ReportProject::class);
    }

    public function request(){
        return $this->hasMany(Request::class);
    }

    public function city(){
        return $this->hasOne(City::class);
    }

    public function teammate(){
        return $this->hasMany(Team::class);
    }

}
