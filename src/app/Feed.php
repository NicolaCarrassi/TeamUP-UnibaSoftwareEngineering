<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{

    protected $fillable = ['description', 'project_id', 'user_id', 'feed_date',];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

}
