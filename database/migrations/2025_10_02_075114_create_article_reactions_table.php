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
        Schema::create('article_reactions', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger('article_id');
            $table->foreignId('article_id')->constrained('articles')->onDelete('cascade');
//            $table->unsignedBigInteger('user_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('reaction_type')->nullable();
            $table->string('reaction_text')->nullable();
            $table->string('reaction_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_reactions');
    }
};
