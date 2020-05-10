<?php

use Illuminate\Database\Seeder;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pokemon')->insert(array(
            array(
                'id' => '1'
            ),
            array(
                'id' => '2'
            ),
            array(
                'id' => '3'
            ),
            array(
                'id' => '4'
            ),
            array(
                'id' => '5'
            ),
            array(
                'id' => '6'
            ),
            array(
                'id' => '7'
            ),
            array(
                'id' => '8'
            ),
        ));
    }
}
