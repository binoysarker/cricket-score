<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_ball_count');
            $table->integer('wide_ball_count');
            $table->tinyInteger('last_man_standing');
            $table->tinyInteger('unlimited_dismissals');
            $table->tinyInteger('max_balls_per_batter');
            $table->tinyInteger('max_run_per_batter');
            $table->tinyInteger('max_balls_per_over');
            $table->tinyInteger('overs_per_innings');
            $table->tinyInteger('max_overs_per_bowler');
            $table->string('toss_won_by');
            $table->string('elected_to');
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
        Schema::dropIfExists('settings');
    }
}
