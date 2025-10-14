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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // nullable for guest comments
            $table->text('comment');
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade'); // nullable for parent comments
            $table->string('name')->nullable(); // Guest user name
            $table->string('email')->nullable(); // Guest user email
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->integer('likes_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
