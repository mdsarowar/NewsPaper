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
//        Schema::create('categories', function (Blueprint $table) {
//            $table->id();
//            $table->string('name');
//            $table->string('slug')->unique();
////            $table->unsignedBigInteger('parent_id');
//            $table->foreignId('parent_id')->constrained('categories')->onDelete('cascade');
//            $table->string('image')->nullable();
//            $table->tinyInteger('status')->default(1);
//            $table->integer('display_order')->default(0);
//            $table->timestamps();
//        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->text('description')->nullable(); // ✅ Added - SEO description

            // ✅ Fixed - parent_id can be NULL for main categories
            $table->foreignId('parent_id')
                ->nullable() // ⭐ Important: Main categories er parent nai
                ->constrained('categories')
                ->onDelete('cascade'); // Sub-category delete hole children o delete

            $table->string('image', 255)->nullable();

            // ✅ Better - enum or string for status
            // Option 1: Using enum (Recommended)
            $table->enum('status', ['active', 'inactive'])->default('active');

            // Option 2: Using tinyInteger (if you prefer)
            // $table->tinyInteger('status')->default(1)->comment('1=active, 0=inactive');

            $table->integer('display_order')->default(0);

            // ✅ Indexes for better performance
            $table->index('slug');
            $table->index('parent_id');
            $table->index('status');
            $table->index('display_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
