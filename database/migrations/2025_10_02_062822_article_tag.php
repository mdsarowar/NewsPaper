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
        Schema::create('article_tag', function (Blueprint $table) {
            $table->foreignId('article_id')
                ->constrained('articles')
                ->onDelete('cascade');

            $table->foreignId('tag_id')
                ->constrained('tags')
                ->onDelete('cascade');

            // Composite primary key - MUST HAVE for pivot tables
            $table->primary(['article_id', 'tag_id']);

            // Optional: timestamps if you want to track when relations were created
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
