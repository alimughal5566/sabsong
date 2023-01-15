<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_bets', function (Blueprint $table) {
            $table->id();
            $table->string('coins')->nullable();
            $table->string('player')->nullable();
            $table->string('betOdds')->nullable();
            $table->string('anyOddsCheck')->nullable();
            $table->foreignId('bet_id')->constrained('bets')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
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
        Schema::dropIfExists('place_bets');
    }
}
