<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Pokemon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use \DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //bulbasaur carmander skvrl pikacu
        $pokemon_ids = [1, 4, 7, 25];
        $index = rand(0, 3);

        //ako pokemoni nisu u bazi pokemona, dodaj ih
        if(is_null(Pokemon::find($pokemon_ids[$index]))) {
            DB::table('pokemon')->insert(array(
                array(
                    'id' => $pokemon_ids[$index]
                )
            ));
        }

        //napravi korisnika
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cntPokemons' => 1,
            'cntBalls' => 3,
            'cntCash' => 500,
            'avatar' => $data['avatar']
        ]);

        //dodaj da korisnik poseduje tog pokemona
        DB::table('owns')->insert(array(
            array(
                'user_id' => $user->idU,
                'pokemon_id' => $pokemon_ids[$index],
                'xp' => 0,
                'level' => 1
            )
        ));

        return $user;
    }
}
