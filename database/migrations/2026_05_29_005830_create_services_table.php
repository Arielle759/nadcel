<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salon_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('duration'); // en minutes
            $table->string('category', 100);
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['salon_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};