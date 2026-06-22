<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movie', function (Blueprint $table) {
            $table->integer('movie_id', true);
            $table->string('title', 150);
            $table->string('category', 50)->nullable();
            $table->string('director', 100)->nullable();
            $table->integer('year')->nullable();
            $table->string('image')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movie');
    }
};
