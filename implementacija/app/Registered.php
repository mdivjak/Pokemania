<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registered extends Model
{
    //veze izmedju korisnika i turnira (ne znam da li radi mozda)
    /*public function user() {
        return $this->belongsTo('App\User');
    }
    */
    protected $table = 'registered';
    
    public function tournament() {
        return $this->belongsTo('App\Tournament');
    }
}
