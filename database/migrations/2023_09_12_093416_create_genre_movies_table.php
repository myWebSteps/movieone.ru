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
        Schema::create('genre_movies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->index()->constrained('movies')->onDelete('cascade');
            $table->foreignId('genre_id')->index()->constrained('genres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_movies');
    }
};
