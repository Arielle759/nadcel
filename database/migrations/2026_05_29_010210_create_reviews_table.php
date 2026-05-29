<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('salon_id')->constrained()->onDelete('cascade');
            $table->foreignId('appointment_id')->nullable()->constrained()->onDelete('set null');
            $table->tinyInteger('rating'); // 1-5
            $table->text('comment')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
            
            $table->unique(['client_id', 'appointment_id']);
            $table->index(['salon_id', 'is_visible']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};