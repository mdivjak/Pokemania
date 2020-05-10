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
