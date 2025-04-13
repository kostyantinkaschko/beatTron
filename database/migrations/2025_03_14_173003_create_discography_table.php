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
        Schema::create('discography', function (Blueprint $table) {
            $table->id();
            $table->foreignid("genre_id")->constrained("genres", "id")->cascadeOnDelete();
            $table->foreignid("performer_id")->constrained("performers", "id")->cascadeOnDelete();
            $table->string("name");
            $table->string("type");
            $table->string("description", 3000);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discography');
    }
};
