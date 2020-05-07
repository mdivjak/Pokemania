<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    public function getName() {
        $content = file_get_contents("https://pokeapi.co/api/v2/pokemon/{$this->id}");
        $result  = json_decode($content);
        return $result->name;
    }

    public function getImage() {
        return "https://pokeres.bastionbot.org/images/pokemon/{$this->id}.png";
    }
}
