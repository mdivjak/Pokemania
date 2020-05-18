<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Registered - model prijave za turnir
 *
 * @author Marko Divjak 0084/2017
 *
 * @version 1.0
 */
class Registered extends Model
{
    protected $table = 'registered';
    
    public function tournament() {
        return $this->belongsTo('App\Tournament');
    }
}
