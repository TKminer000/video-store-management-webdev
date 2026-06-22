<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tape', function (Blueprint $table) {
            $table->integer('tape_number', true);
            $table->integer('movie_id');
            $table->enum('format', ['Beta', 'VHS']);
            $table->enum('status', ['available', 'rented'])->default('available');
            $table->foreign('movie_id')->references('movie_id')->on('movie')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tape');
    }
};
