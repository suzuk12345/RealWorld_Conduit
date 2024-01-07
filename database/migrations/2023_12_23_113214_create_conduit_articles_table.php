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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 255);
            $table->string('title', 64);
            $table->string('description', 64);
            $table->string('body', 1024);
            $table->timestamps();
            $table->integer('favoriteCount')->default(0);
            $table->foreignId('user_id')->constrained(); // 著者
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conduit_articles');
    }
};