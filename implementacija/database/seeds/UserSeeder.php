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
                'password' => Hash::make('123456789'),
                'name' => 'banana',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 500,
                'cntFruits' => 2,
                'cntPokemons' => 3,
                'avatar' => 1
            ),
            array(
                'email' => 'mail123@gmail.com',
                'password' => Hash::make('987654321'),
                'name' => 'jabuka',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 200,
                'cntFruits' => 2,
                'cntPokemons' => 6,
                'avatar' => 2
            ),
            array(
                'email' => 'mailmail@gmail.com',
                'password' => Hash::make('123123123'),
                'name' => 'kruska',
                'bAdmin' => 0,
                'cntBalls' => 4,
                'cntCash' => 600,
                'cntFruits' => 3,
                'cntPokemons' => 4,
                'avatar' => 3
            ),
            array(
                'email' => 'email@gmail.com',
                'password' => Hash::make('123456789'),
                'name' => 'lubenica',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 500,
                'cntFruits' => 2,
                'cntPokemons' => 3,
                'avatar' => 4
            ),
            array(
                'email' => 'limun@gmail.com',
                'password' => Hash::make('987654321'),
                'name' => 'limun',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 200,
                'cntFruits' => 2,
                'cntPokemons' => 6,
                'avatar' => 5
            ),
            array(
                'email' => 'jagoda@gmail.com',
                'password' => Hash::make('123123123'),
                'name' => 'jagoda',
                'bAdmin' => 0,
                'cntBalls' => 4,
                'cntCash' => 600,
                'cntFruits' => 3,
                'cntPokemons' => 4,
                'avatar' => 6
            ),
            array(
                'email' => 'malina@gmail.com',
                'password' => Hash::make('123456789'),
                'name' => 'malina',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 500,
                'cntFruits' => 2,
                'cntPokemons' => 3,
                'avatar' => 7
            ),
            array(
                'email' => 'tresnja@gmail.com',
                'password' => Hash::make('987654321'),
                'name' => 'tresnja',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 200,
                'cntFruits' => 2,
                'cntPokemons' => 6,
                'avatar' => 8
            ),
            array(
                'email' => 'kivi@gmail.com',
                'password' => Hash::make('123123123'),
                'name' => 'kivi',
                'bAdmin' => 0,
                'cntBalls' => 4,
                'cntCash' => 600,
                'cntFruits' => 3,
                'cntPokemons' => 4,
                'avatar' => 9
            ),
            array(
                'email' => 'dunja@gmail.com',
                'password' => Hash::make('123456789'),
                'name' => 'dunja',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 500,
                'cntFruits' => 2,
                'cntPokemons' => 3,
                'avatar' => 1
            ),
            array(
                'email' => 'kupina@gmail.com',
                'password' => Hash::make('987654321'),
                'name' => 'kupina',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 200,
                'cntFruits' => 2,
                'cntPokemons' => 6,
                'avatar' => 2
            ),
            array(
                'email' => 'borovnica@gmail.com',
                'password' => Hash::make('123123123'),
                'name' => 'borovnica',
                'bAdmin' => 0,
                'cntBalls' => 4,
                'cntCash' => 600,
                'cntFruits' => 3,
                'cntPokemons' => 4,
                'avatar' => 3
            ),
        ));
    }
}
