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
        Schema::create('ads_clicks', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger('ad_id');
            $table->foreignId('ads_id')->constrained('advertisements')->onDelete('cascade');
            $table->string('ip_address');
            $table->string('user_agent');
//            $table->timestamps('clicked_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_clicks');
    }
};
