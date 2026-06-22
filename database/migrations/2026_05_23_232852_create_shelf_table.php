<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shelf', function (Blueprint $table) {
            $table->integer('shelf_id', true);
            $table->string('category', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shelf');
    }
};
