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
            $table->foreignId('genre_id')->constrained('genres', 'id')->cascadeOnDelete();
            $table->foreignId('performer_id')->constrained('performers', 'id')->cascadeOnDelete();
            $table->foreignId('disk_id')->constrained('discography', 'id')->cascadeOnDelete();
            $table->string('name');
            $table->integer('listening_count')->default(0);
            $table->integer('year');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
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