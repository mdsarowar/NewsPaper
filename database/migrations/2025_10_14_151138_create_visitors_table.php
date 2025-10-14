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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->string('referer', 500)->nullable();
            $table->string('url', 500);
            $table->string('method', 10)->default('GET');

            // Device Detection (parsed from user agent)
            $table->string('device_type')->nullable(); // mobile, tablet, desktop
            $table->string('browser')->nullable();
            $table->string('platform')->nullable(); // Windows, Mac, Linux, Android, iOS

            // Location (from IP - optional)
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('zip')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('timezone')->nullable();
            $table->string('isp')->nullable();

            // Page Info
            $table->string('page_title')->nullable();
            $table->integer('time_spent')->default(0); // seconds

            // Session
            $table->string('session_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            // Timestamps
            $table->timestamp('visited_at');
            $table->timestamps();

            // Indexes
            $table->index('ip_address');
            $table->index('visited_at');
            $table->index('device_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
