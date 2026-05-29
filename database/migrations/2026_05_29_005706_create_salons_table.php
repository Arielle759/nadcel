<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('address');
            $table->string('city', 100);
            $table->string('phone', 20);
            $table->string('email')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('city');
            $table->index(['is_active', 'is_verified']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salons');
    }
};