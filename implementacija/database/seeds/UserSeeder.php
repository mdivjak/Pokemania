<?php

use Illuminate\Database\Seeder;

/**
 * UserSeeder - klasa za popunjavanje users tabele test podacima
 *
 * @author Anja Marković 0420/17
 *
 * @version 1.0
 */
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
                'email' => 'bananaijabuka@gmail.com',
                'password' => Hash::make('123456789'),
                'name' => 'banana',
                'bAdmin' => 1,
                'cntBalls' => 2,
                'cntCash' => 500,
                'cntFruits' => 2,
                'cntPokemons' => 3,
                'avatar' => 1
            ),
            array(
                'email' => 'bananaijabuka+jabuka@gmail.com',
                'password' => Hash::make('123456789'),
                'name' => 'jabuka',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 200,
                'cntFruits' => 2,
                'cntPokemons' => 6,
                'avatar' => 2
            ),
            array(
                'email' => 'bananaijabuka+kruska@gmail.com',
                'password' => Hash::make('123456789'),
                'name' => 'kruska',
                'bAdmin' => 0,
                'cntBalls' => 4,
                'cntCash' => 600,
                'cntFruits' => 3,
                'cntPokemons' => 4,
                'avatar' => 3
            ),
            array(
                'email' => 'bananaijabuka+lubenica@gmail.com',
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
                'email' => 'bananaijabuka+limun@gmail.com',
                'password' => Hash::make('123456789'),
                'name' => 'limun',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 200,
                'cntFruits' => 2,
                'cntPokemons' => 6,
                'avatar' => 5
            ),
            array(
                'email' => 'bananaijabuka+jagoda@gmail.com',
                'password' => Hash::make('123456789'),
                'name' => 'jagoda',
                'bAdmin' => 0,
                'cntBalls' => 4,
                'cntCash' => 600,
                'cntFruits' => 3,
                'cntPokemons' => 4,
                'avatar' => 6
            ),
            array(
                'email' => 'bananaijabuka+malina@gmail.com',
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
                'email' => 'bananaijabuka+tresnja@gmail.com',
                'password' => Hash::make('123456789'),
                'name' => 'tresnja',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 200,
                'cntFruits' => 2,
                'cntPokemons' => 6,
                'avatar' => 8
            ),
            array(
                'email' => 'bananaijabuka+kivi@gmail.com',
                'password' => Hash::make("123456789"),
                'name' => 'kivi',
                'bAdmin' => 0,
                'cntBalls' => 4,
                'cntCash' => 600,
                'cntFruits' => 3,
                'cntPokemons' => 4,
                'avatar' => 9
            ),
            array(
                'email' => 'bananaijabuka+dunja@gmail.com',
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
                'email' => 'bananaijabuka+kupina@gmail.com',
                'password' => Hash::make('123456789'),
                'name' => 'kupina',
                'bAdmin' => 0,
                'cntBalls' => 2,
                'cntCash' => 200,
                'cntFruits' => 2,
                'cntPokemons' => 6,
                'avatar' => 2
            ),
            array(
                'email' => 'bananaijabuka+borovnica@gmail.com',
                'password' => Hash::make('123456789'),
                'name' => 'borovnica',
                'bAdmin' => 0,
                'cntBalls' => 4,
                'cntCash' => 600,
                'cntFruits' => 3,
                'cntPokemons' => 4,
                'avatar' => 3
            ),
            array(
                'email' => 'bananaijabuka+marko@gmail.com',
                'password' => Hash::make('123456789'),
                'name' => 'marko',
                'bAdmin' => 1,
                'cntBalls' => 4,
                'cntCash' => 600,
                'cntFruits' => 3,
                'cntPokemons' => 4,
                'avatar' => 3
            )
        ));
    }
}
