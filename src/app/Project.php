<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends ProjectualIdea
{

    use SoftDeletes;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fillable += ['idea_start_at', 'project_end_at'];
    }

    public function feed(){
        return $this->hasMany(Feed::class);
    }

    public function task(){
        return $this->hasMany(Task::class);
    }

}
