<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * CreateTournamentsTable - migracija za kreiranje tournaments, participates i registered tabele
 *
 * @author Anja Marković 0420/17
 *
 * @version 1.0
 */
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
            $table->id();
            $table->string('name');
            $table->integer('prize');
            $table->integer('minLevel');
            $table->integer('maxLevel');
            $table->date('endDate');
            $table->integer('entryFee');
            $table->timestamps();
        });

        Schema::create('participates', function (Blueprint $table) {
            $table->primary(['user_id', 'tournament_id']);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tournament_id');
            $table->integer('cntWin')->default(0);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('idU')
                ->on('users')
                ->onDelete('cascade');
                
            $table->foreign('tournament_id')
                ->references('id')
                ->on('tournaments')
                ->onDelete('cascade');
        });

        Schema::create('registered', function (Blueprint $table) {
            $table->primary(['user_id', 'tournament_id']);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tournament_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('idU')
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
        Schema::dropIfExists('participates');
        Schema::dropIfExists('registered');
    }
}
