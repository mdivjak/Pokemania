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
                'cntPokemons' => 3
            ),
            array(
                'email' => 'mail123@gmail.com',
                'password' => Hash::make('987654321'),
                'name' => 'jabuka',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 200,
                'cntFruits' => 2,
                'cntPokemons' => 2
            ),
            array(
                'email' => 'mailmail@gmail.com',
                'password' => Hash::make('123123123'),
                'name' => 'kruska',
                'bAdmin' => 0,
                'cntBalls' => 4,
                'cntCash' => 600,
                'cntFruits' => 3,
                'cntPokemons' => 4
            ),
        ));
    }
}
