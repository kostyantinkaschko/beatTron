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
        // Schema::create('medals', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('type');
        //     $table->string('description', 3000);
        //     $table->string('difficulty');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('medals');
    }
};
