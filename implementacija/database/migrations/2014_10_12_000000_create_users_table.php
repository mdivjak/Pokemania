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
            $table->id('idU');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->boolean('bAdmin')->default('0');
            $table->integer('cntPokemons')->default('0');
            $table->integer('cntBalls')->default('0');
            $table->integer('cntFruits')->default('0');
            $table->integer('cntCash')->default('0');

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('pokemon', function (Blueprint $table) {
            $table->id('id');
            $table->timestamps();
        });

        Schema::create('owns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pokemon_id');
            $table->integer('xp');
            $table->integer('level');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('idU')
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
        Schema::dropIfExists('owns');
        Schema::dropIfExists('pokemon');
    }
}
