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
//            $table->id();
////            $table->bigInteger('user_id')->unsigned();
//            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
////            $table->bigInteger('category_id')->unsigned();
//            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
//            $table->string('title');
//            $table->string('slug');
//            $table->text('content');
//            $table->string('image')->nullable();
//            $table->string('meta_description')->nullable();
//            $table->string('author')->nullable();
//            $table->string('reading_time')->nullable();
//            $table->string('view_count')->nullable();
//            $table->enum('status', ['published', 'draft','archived'])->default('draft');
//            $table->boolean('is_breaking')->default(false);
//            $table->string('breaking_title')->nullable();
//            $table->timestamps();

            $table->id();

            // Foreign Keys
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');

            // Basic Content Fields
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable(); // আমার field
            $table->longText('content');

            // Images
            $table->string('image')->nullable(); // আপনার field (main image)
            $table->string('featured_image')->nullable(); // আমার field (same purpose - keep both or merge)

            // SEO & Meta
            $table->string('meta_title')->nullable(); // আমার field
            $table->string('meta_description')->nullable(); // আপনার field
            $table->string('meta_keywords')->nullable(); // আমার field

            // Author & Stats
            $table->string('author')->nullable(); // আপনার field
            $table->integer('reading_time')->nullable(); // দুজনেরই আছে
            $table->integer('view_count')->default(0); // দুজনেরই আছে

            // Publishing
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable(); // আমার field

            // Features
            $table->boolean('is_featured')->default(false); // আমার field
            $table->boolean('is_breaking')->default(false); // আপনার field
            $table->string('breaking_title')->nullable(); // আপনার field
            $table->boolean('allow_comments')->default(true); // আমার field

            $table->timestamps();
            $table->softDeletes(); // আমার field (trash functionality)

            // Indexes for better performance
            $table->index('slug');
            $table->index('status');
            $table->index('category_id');
            $table->index('user_id');
            $table->index('is_breaking');
            $table->index('is_featured');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
