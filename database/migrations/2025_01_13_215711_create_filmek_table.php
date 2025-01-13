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
        Schema::create('filmek', function (Blueprint $table) {
            $table->string('film_cime');
            $table->integer('film_evszam');
            $table->boolean('szinkronos-e');
            $table->boolean('hagyományos-e');
            $table->string('film_nyelve');
            $table->integer('film_hossza');

            $table->primary(['film_cime', 'film_evszam']);
            $table->foreign('film_nyelve')->references('nyelvkod')->on('nyelvek')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filmek');
    }
};
