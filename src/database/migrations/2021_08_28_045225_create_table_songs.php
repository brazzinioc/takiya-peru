<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSongs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->string('slug')->unique();
            $table->text('lyrics_que');
            $table->text('lyrics_spn')->nullable();
            $table->text('lyrics_eng')->nullable();
            $table->string('image')->nullable();
            $table->text('iframe')->nullable();
            $table->unsignedBigInteger('id_genre');
            $table->unsignedBigInteger('id_author');
            $table->unsignedBigInteger('id_writer');
            $table->foreign('id_genre')->references('id')->on('music_genres');
            $table->foreign('id_author')->references('id')->on('authors');
            $table->foreign('id_writer')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
}
