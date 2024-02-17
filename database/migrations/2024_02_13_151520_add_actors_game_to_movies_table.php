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
        Schema::table('movies', function (Blueprint $table) {
            $table->float('default_actors_game', 2, 1)->default(0)->after('plot');
            $table->float('actors_game', 2, 1)->default(0)->after('default_actors_game');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('actors_game');
            $table->dropColumn('default_actors_game');
        });
    }
};
