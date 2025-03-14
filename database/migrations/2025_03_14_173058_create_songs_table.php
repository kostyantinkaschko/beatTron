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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id')->constrained('genres');
            $table->foreignId('performer_id')->constrained('performers');
            $table->string('name');
            $table->integer('size');
            $table->integer('rate');
            $table->integer('duration');
            $table->integer('listeningCount');
            $table->integer('year');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
