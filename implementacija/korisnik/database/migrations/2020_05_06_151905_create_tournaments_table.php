<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('prize');
            $table->integer('minLevel');
            $table->integer('maxLevel');
            $table->integer('entryFee');
            $table->dateTime('endDate');
            $table->timestamps();
        });

        Schema::create('participates', function (Blueprint $table) {
            $table->primary(['user_id', 'tournament_id']);
            $table->foreignId('user_id');
            $table->foreignId('tournament_id');
            $table->integer('cntWin');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
                
            $table->foreign('tournament_id')
                ->references('id')
                ->on('tournaments')
                ->onDelete('cascade');
        });

        Schema::create('registered', function (Blueprint $table) {
            $table->primary(['user_id', 'tournament_id']);
            $table->foreignId('user_id');
            $table->foreignId('tournament_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
                
            $table->foreign('tournament_id')
                ->references('id')
                ->on('tournaments')
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
        Schema::dropIfExists('tournaments');
    }
}
