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
        for($i = 1; $i <= 251; $i++) {
            DB::table('pokemon')->insert(array(
                array(
                    'id' => $i
                )
                ));
        }

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
            ),
            array(
                'id' => '4',
                'user_id' => '2',
                'pokemon_id' => '2',
                'xp' => '12',
                'level' => '5',
                'created_at' => null,
                'updated_at' => null
            ),
            array(
                'id' => '5',
                'user_id' => '2',
                'pokemon_id' => '4',
                'xp' => '12',
                'level' => '5',
                'created_at' => null,
                'updated_at' => null
            ),
            array(
                'id' => '6',
                'user_id' => '3',
                'pokemon_id' => '3',
                'xp' => '12',
                'level' => '5',
                'created_at' => null,
                'updated_at' => null
            ),
            array(
                'id' => '7',
                'user_id' => '3',
                'pokemon_id' => '5',
                'xp' => '12',
                'level' => '5',
                'created_at' => null,
                'updated_at' => null
            ),
            array(
                'id' => '8',
                'user_id' => '3',
                'pokemon_id' => '7',
                'xp' => '12',
                'level' => '5',
                'created_at' => null,
                'updated_at' => null
            ),
            array(
                'id' => '9',
                'user_id' => '3',
                'pokemon_id' => '8',
                'xp' => '12',
                'level' => '5',
                'created_at' => null,
                'updated_at' => null
            ),
            array(
                'id' => '10',
                'user_id' => '2',
                'pokemon_id' => '1',
                'xp' => '12',
                'level' => '3',
                'created_at' => null,
                'updated_at' => null
            ),
            array(
                'id' => '11',
                'user_id' => '2',
                'pokemon_id' => '3',
                'xp' => '17',
                'level' => '4',
                'created_at' => null,
                'updated_at' => null
            ),
            array(
                'id' => '12',
                'user_id' => '2',
                'pokemon_id' => '5',
                'xp' => '12',
                'level' => '3',
                'created_at' => null,
                'updated_at' => null
            ),
            array(
                'id' => '13',
                'user_id' => '2',
                'pokemon_id' => '6',
                'xp' => '17',
                'level' => '4',
                'created_at' => null,
                'updated_at' => null
            ),
        ));
    }
}
