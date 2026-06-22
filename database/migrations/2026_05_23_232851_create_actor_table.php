<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actor', function (Blueprint $table) {
            $table->integer('actor_id', true);
            $table->string('name', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actor');
    }
};
