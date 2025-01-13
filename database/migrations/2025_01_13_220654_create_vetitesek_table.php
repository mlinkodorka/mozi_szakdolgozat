<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vetitesek', function (Blueprint $table) {
            $table->id('vetites_id');
            $table->string('film_cime');
            $table->integer('film_evszam');
            $table->unsignedBigInteger('terem');
            $table->dateTime('kezdes_ideje');
            $table->boolean('publikus_e');
            $table->integer('jegy_ara');
            $table->integer('szabad_helyek_szama');
            $table->integer('foglalt_helyek_szama');

            $table->foreign(['film_cime','film_evszam'])->references(['film_cime','film_evszam'])->on('filmek')->onDelete('cascade');
            $table->foreign('terem')->references('terem_id')->on('termek')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vetitesek');
    }
};
