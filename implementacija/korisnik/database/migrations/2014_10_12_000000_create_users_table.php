<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique(); 
            $table->string('nickname');
            $table->boolean('bAdmin');
            $table->integer('cntBalls');
            $table->integer('cntCash');
            $table->integer('cntFruits');
            $table->integer('cntPokemons');  
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();          
        });

        Schema::create('owns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id');
            $table->foreignId('pokemon_id');
            $table->integer('xp');
            $table->integer('level');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
                
            $table->foreign('pokemon_id')
                ->references('id')
                ->on('pokemon')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
