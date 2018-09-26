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
            $table->integer('user_id');
            $table->tinyInteger('no_ball_count');
            $table->tinyInteger('wide_ball_count');
            $table->tinyInteger('last_man_standing');
            $table->tinyInteger('unlimited_dismissals');
            $table->integer('max_balls_per_batter');
            $table->integer('max_run_per_batter');
            $table->integer('max_balls_per_over');
            $table->integer('overs_per_innings');
            $table->integer('max_overs_per_bowler');
            $table->string('toss_won_by')->nullable();
            $table->string('elected_to')->nullable();
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
