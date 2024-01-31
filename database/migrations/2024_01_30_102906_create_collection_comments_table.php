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
        Schema::create('collection_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->index()->constrained('collections')->onDelete('cascade');
            $table->string('name');
            $table->integer('rate');
            $table->string('comment');
            $table->boolean('approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_comments');
    }
};
