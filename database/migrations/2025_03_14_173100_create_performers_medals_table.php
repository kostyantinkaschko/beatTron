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
        Schema::create('performers_medals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performer_id')->constrained('performers');
            $table->foreignId('medal_id')->constrained('medals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performers_medals');
    }
};
