<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use DB;

class HomeController extends Controller
{
    public function show()
    {
        return view("home.welcome");
    }

    public function pokedex()
    {
        $content = file_get_contents("https://pokeapi.co/api/v2/pokemon/?limit=" . env('MAX_POKEMONS'));
        $result  = json_decode($content);
        $data = $result->results;
        $pokeCnt = count($data);
        $pokemons = [];
        $pokeId = 0;

        for ($i = 0; $i < $pokeCnt; $i++) {
            $pokeId++;
            array_push($pokemons, [
                'name' => strtoupper($data[$i]->name[0]) . substr($data[$i]->name, 1),
                'id' => $pokeId,
                'img' => "https://pokeres.bastionbot.org/images/pokemon/" . ($pokeId) . ".png" //"https://img.pokemondb.net/artwork/" . $data[$i]->name . ".jpg"
            ]);
        }

        return view("home.pokedex", ["pokemons" => $pokemons]);
    }

    public function pokemon($id)
    {
        if ($id > env("MAX_POKEMONS"))
            abort(404);

        $content = file_get_contents("https://pokeapi.co/api/v2/pokemon/{$id}");
        $result  = json_decode($content);

        $name = $result->name;
        $weight = $result->weight;
        $height = $result->height;
        $moves = [];

        $movesCnt = count($result->moves);
        for ($i = 0; $i < $movesCnt && count($moves) < 8; $i++) {
            $moveInfo =  file_get_contents($result->moves[$i]->move->url);
            $moveResult  = json_decode($moveInfo);

            if ($moveResult->accuracy == null ||
            $moveResult->power == null ||  $moveResult->pp == null || $moveResult->damage_class->name == null) {
                continue;
            }
            
            array_push($moves, [
                'name' => $moveResult->name,
                'accuracy' => $moveResult->accuracy,
                'power' => $moveResult->power,
                'pp' => $moveResult->pp,
                'type' => $moveResult->type->name,
                'damage_class' => $moveResult->damage_class->name
            ]);
        }

        $types = [];

        $typesCnt = count($result->types);
        for ($i = 0; $i < $typesCnt; $i++) {
            array_push($types, [
                'name' => $result->types[$i]->type->name
            ]);
        }

        return view("home.pokemon", [
            'id' => $id,
            'name' => $name,
            'weight' => $weight,
            'height' => $height,
            'types' => $types,
            'moves' => $moves
        ]);
    }

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

    public function quizGuess(Request $request)
    {

        if ($request->has('refresh'))
            return redirect()->route('home.quiz');

        $quizAnswer = $request->session()->pull('quizAnswer');


        if ($quizAnswer == $request->input("quizGuess")) {
            //ako je ulogovan
            /*
                $user = User::where('nickname', 'klokar')->first(); //ovo izmeniti
                $user->addPokeCash(100);
            */
            return redirect()->route('home.quiz')->with('success', ['Correct answer!', session()->pull('quizAnswerImg')]);
        } else
            return redirect()->route('home.quiz')->with('wrong', 'Wrong answer! Try again');
    }
}
