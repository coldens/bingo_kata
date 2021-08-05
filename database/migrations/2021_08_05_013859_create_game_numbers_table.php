<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_numbers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('game_id');

            $table->string('letter', 1);
            $table->unsignedTinyInteger('value');

            $table->timestamps();

            $table->unique(['game_id', 'value']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_numbers');
    }
}
