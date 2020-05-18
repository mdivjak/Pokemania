<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Pokemon – model Pokemona
 *
 * @author Anja Marković 0420/17
 *
 * @version 1.0
 */
class Pokemon extends Model
{
    /**
     * Funkcija koja dohvata ime pokemona sa Pokemon API-ja
     *
     * @return String
     *
     */
    public function getName() {
        $content = file_get_contents("https://pokeapi.co/api/v2/pokemon/{$this->id}");
        $result  = json_decode($content);
        return $result->name;
    }

    /**
     * Funkcija koja dohvata sliku pokemona sa Pokemon API-ja
     *
     * @return String
     *
     */
    public function getImage() {
        return "https://pokeres.bastionbot.org/images/pokemon/{$this->id}.png";
    }
}
