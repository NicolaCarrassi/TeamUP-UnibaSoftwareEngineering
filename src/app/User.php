<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name','surname', 'email', 'password','avatar','birth_date','city',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];

    public function skill(){
        return $this->hasMany('App\Skill');
    }

    public function leader(){
        return $this->hasMany(Leader::class);
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

    public function feed(){
        return $this->hasMany(Feed::class);
    }

    public function task(){
        return $this->hasMany(Task::class);
    }

}
