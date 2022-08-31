<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_artist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id');
            $table->foreignId('artist_id');
            $table->timestamps();

            $table->foreign('film_id')->references('id')->on('films');
            $table->foreign('artist_id')->references('id')->on('artists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_artist');
    }
};
