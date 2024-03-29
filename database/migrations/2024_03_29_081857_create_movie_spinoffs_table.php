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
        Schema::create('movie_spinoffs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->nullable()->index()->constrained('movies')->onDelete('cascade');
            $table->string('spin_off')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_spinoffs');
    }
};
