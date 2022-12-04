<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{


    const SPORT_LABEL = "Sport e Fitness";
    const TECH_LABEL = "Tecnologia" ;
    const MUSIC_LABEL = "Musica";
    const PHOTO_LABEL = "Foto e video";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'category',
    ];

    public function project(){
        return $this->hasMany(ProjectualIdea::class);
    }


    /**
     * La funzione permette di ottenere la label della categoria richiesta
     *
     * @param $number valore numerico associato categoria
     * @return $res Stringa contenente la label della categoria asscoiata ad un numero
     */
    public static function getLabelFromNuber($number){

        switch ($number){
            case 1:
                $res = self::SPORT_LABEL;
                break;
            case 2:
                $res = self::TECH_LABEL;
                break;
            case 3:
                $res = self::MUSIC_LABEL;
                break;
            default:
                $res = self::PHOTO_LABEL;
        }
        return $res;
    }

}
