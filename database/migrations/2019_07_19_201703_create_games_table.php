<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('player_one_id');
            $table->unsignedBigInteger('player_two_id')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->unsignedTinyInteger('current_player')->nullable();
            $table->jsonb('player_one_state')->nullable(); // { "selected_person": "", faces: [] }
            $table->jsonb('player_two_state')->nullable(); // { "selected_person": "", faces: [] }
            $table->timestamps();

            $table->foreign('player_one_id')->references('id')->on('users');
            $table->foreign('player_two_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('game_statuses');
            $table->foreign('subturn_id')->references('id')->on('game_subturns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
