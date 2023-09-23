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
        Schema::create('country_movies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->index()->constrained('movies')->onDelete('cascade');
            $table->foreignId('country_id')->index()->constrained('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_movies');
    }
};
