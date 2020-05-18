<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * GuestController – klasa za funkcionalnosti gosta
 *
 * @author Natalija Mitić 0085/17
 *
 * @version 1.0
 */
class GuestController extends Controller
{
    /**
     * Prikaz index (početne) strane gosta
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show()
    {
        return view("home.welcome");
    }

    /**
     * Prikaz pokedeksa
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function pokedex()
    {
        return view("home.pokedex");
    }

    /**
     * Prikaz pojedinačnog pokemona iz pokedeksa
     * 
     * @param int $id
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function pokemon(int $id)
    {
        if ($id > env("MAX_POKEMONS"))
            abort(404);

        return view("home.pokemon", [
            'id' => $id
        ]);
    }

    /**
     * Prikaz stranice za pogađanje pokemona
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function quiz()
    {
        $pokeId =  random_int(1, 251);
        $content = file_get_contents("https://pokeapi.co/api/v2/pokemon/{$pokeId}");
        $result  = json_decode($content);
        session(['quizAnswer' => $result->name]);

        $pokeImg = "https://pokeres.bastionbot.org/images/pokemon/{$pokeId}.png";
        session(['quizAnswerImg' => $pokeImg]);

        return view("home.quiz", ["pokeImg" => $pokeImg]);
    }

    /**
     * Pogađanje pokemona (provera tačnosti odgovara)
     * 
     * @param  Illuminate\Http\Request $request
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function quizGuess(Request $request)
    {

        if ($request->has('refresh'))
            return redirect()->route('home.quiz');

        $quizAnswer = strtolower($request->session()->pull('quizAnswer'));


        if ($quizAnswer == strtolower($request->input("quizGuess"))) {
            //ako je ulogovan
            if (auth()->user()) {
                auth()->user()->addPokeCash();
            }
            return redirect()->route('home.quiz')->with('right', ['Correct answer!', session()->pull('quizAnswerImg')]);
        } else
            return redirect()->route('home.quiz')->with('wrong', 'Wrong answer!');
    }
}
