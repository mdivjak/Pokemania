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
                'cntCash' => 20,
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
            )
        ));
    }
}
