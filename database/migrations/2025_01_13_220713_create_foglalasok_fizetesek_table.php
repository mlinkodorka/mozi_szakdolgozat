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
        Schema::create('foglalasok_fizetesek', function (Blueprint $table) {
            $table->id('foglalas_fizetes_id');
            $table->unsignedBigInteger('vetites');
            $table->integer('lefoglalt_jegyek_szama');
            $table->boolean('vasarlo_foglalt_e');
            $table->string('vasarlo_email');
            $table->dateTime('lejar');
            $table->boolean('fizetve_van_e');
            $table->dateTime('kifizetes_ideje')->nullable();

            $table->foreign('vetites')->references('vetites_id')->on('vetitesek')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foglalasok_fizetesek');
    }
};
