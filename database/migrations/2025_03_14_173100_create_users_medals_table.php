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
        // Schema::create('users_medals', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
        //     $table->foreignId('medal_id')->constrained('medals', 'id')->cascadeOnDelete();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('users_medals');
    }
};
