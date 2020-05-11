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
        DB::table('owns')->insert(array(
            array(
                'id' => '1',
                'user_id' => '1',
                'pokemon_id' => '1',
                'xp' => '12',
                'level' => '5',
                'created_at' => null,
                'updated_at' => null
            ),
            array(
                'id' => '2',
                'user_id' => '1',
                'pokemon_id' => '6',
                'xp' => '12',
                'level' => '5',
                'created_at' => null,
                'updated_at' => null
            ),
            array(
                'id' => '3',
                'user_id' => '1',
                'pokemon_id' => '69',
                'xp' => '12',
                'level' => '5',
                'created_at' => null,
                'updated_at' => null
            )
        ));

        DB::table('pokemon')->insert(array(
            array(
                'id' => '1'
            ),
            array(
                'id' => '6'
            ),
            array(
                'id' => '69'
            )
        ));
    }
}
