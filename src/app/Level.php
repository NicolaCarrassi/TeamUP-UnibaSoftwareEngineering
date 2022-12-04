<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    private static $LIV_SCARSA = "Scarsa";
    private static $LIV_INTERMEDIA = "Intermedia";
    private static $LIV_AVANZATA = "Avanzata";

    public static function getStringLevel($number){
        if($number == 1){
            return self::$LIV_SCARSA;
        }elseif ($number == 2){
            return self::$LIV_INTERMEDIA;
        }else{
            return self::$LIV_AVANZATA;
        }
    }

    public static function getNumberLevel($string){
        if($string == self::$LIV_SCARSA){
            return 1;
        }elseif($string == self::$LIV_INTERMEDIA){
            return 2;
        }else{
            return 3;
        }
    }
}
