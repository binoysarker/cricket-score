<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBattingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id');
            $table->integer('team_member_id');
            $table->tinyInteger('strike_batter')->default(0);
            $table->tinyInteger('non_strike_batter')->default(0);
            $table->integer('runs')->default(0);
            $table->integer('balls')->default(0);
            $table->integer('fours')->default(0);
            $table->integer('sixes')->default(0);
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
        Schema::dropIfExists('battings');
    }
}
