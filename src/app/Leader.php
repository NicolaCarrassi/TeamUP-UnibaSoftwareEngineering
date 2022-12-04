<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $fillable = ['user_id', 'project_id',];

    public function projectualIdea(){
        return $this->hasMany(ProjectualIdea::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
