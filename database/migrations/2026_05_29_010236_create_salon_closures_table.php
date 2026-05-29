<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salon_closures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salon_id')->constrained()->onDelete('cascade');
            $table->date('closure_date');
            $table->string('reason')->nullable();
            $table->timestamps();
            
            $table->index(['salon_id', 'closure_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salon_closures');
    }
};