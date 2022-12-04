<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'city',
    ];

    public function projectualIdea(){
        return $this->belongsToMany(ProjectualIdea::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
