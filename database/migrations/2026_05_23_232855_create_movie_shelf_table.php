<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movie_shelf', function (Blueprint $table) {
            $table->integer('movie_id');
            $table->integer('shelf_id');
            $table->primary(['movie_id', 'shelf_id']);
            $table->foreign('movie_id')->references('movie_id')->on('movie')->onDelete('cascade');
            $table->foreign('shelf_id')->references('shelf_id')->on('shelf')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movie_shelf');
    }
};
