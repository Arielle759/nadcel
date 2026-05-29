<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->foreignId('salon_id')->constrained()->onDelete('cascade');
            $table->string('specialization')->nullable();
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            
            $table->index(['salon_id', 'is_available']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};