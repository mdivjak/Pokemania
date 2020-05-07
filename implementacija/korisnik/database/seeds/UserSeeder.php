<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            array(
                'email' => 'mail@gmail.com',
                'password' => '123456789',
                'nickname' => 'banana',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 500,
                'cntFruits' => 2,
                'cntPokemons' => 3
            ),
            array(
                'email' => 'mail123@gmail.com',
                'password' => '987654321',
                'nickname' => 'jabuka',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 200,
                'cntFruits' => 2,
                'cntPokemons' => 2
            ),
            array(
                'email' => 'mailmail@gmail.com',
                'password' => '123123123',
                'nickname' => 'kruska',
                'bAdmin' => 0,
                'cntBalls' => 4,
                'cntCash' => 600,
                'cntFruits' => 3,
                'cntPokemons' => 4
            ),
        ));

        DB::table('owns')->insert(array(
            array(
                'user_id' => 1,
                'pokemon_id' => 1,
                'xp' => 100,
                'level' => 3
            ),
            array(
                'user_id' => 1,
                'pokemon_id' => 2,
                'xp' => 200,
                'level' => 4
            ),
            array(
                'user_id' => 1,
                'pokemon_id' => 3,
                'xp' => 300,
                'level' => 4
            ),
            array(
                'user_id' => 2,
                'pokemon_id' => 4,
                'xp' => 100,
                'level' => 3
            ),
            array(
                'user_id' => 2,
                'pokemon_id' => 5,
                'xp' => 200,
                'level' => 4
            ),
            array(
                'user_id' => 3,
                'pokemon_id' => 6,
                'xp' => 300,
                'level' => 4
            ),
            array(
                'user_id' => 3,
                'pokemon_id' => 7,
                'xp' => 200,
                'level' => 4
            ),
            array(
                'user_id' => 3,
                'pokemon_id' => 8,
                'xp' => 300,
                'level' => 4
            ),
            array(
                'user_id' => 3,
                'pokemon_id' => 1,
                'xp' => 300,
                'level' => 4
            ),
        ));
    }
}
