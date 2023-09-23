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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kinopoisk_id')->unique();
            $table->string('nameRu');
            $table->string('nameEn');
            $table->string('poster');
            $table->string('type');
            $table->foreignId('category_id')->index()->constrained('categories');
            $table->year('year');
            $table->integer('duration');
            $table->integer('rate');
            $table->string('slogan');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
