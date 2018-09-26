<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBowlingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bowlings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('team_id');
            $table->integer('team_member_id');
            $table->tinyInteger('bowler')->default(0);
            $table->integer('overs')->default(0);
            $table->integer('maiden_overs')->default(0);
            $table->integer('runs_given')->default(0);
            $table->integer('no_ball')->default(0);
            $table->integer('wide_ball')->default(0);
            $table->integer('leg_bye')->default(0);
            $table->integer('bye')->default(0);
            $table->integer('wicket_taken')->default(0);
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
        Schema::dropIfExists('bowlings');
    }
}
