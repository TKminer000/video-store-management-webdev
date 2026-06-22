<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->integer('tape_number');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('rented_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamps();

            $table->foreign('tape_number')->references('tape_number')->on('tape')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
