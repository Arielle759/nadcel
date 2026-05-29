<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->morphs('schedulable'); // schedulable_id, schedulable_type
            $table->tinyInteger('day_of_week'); // 0=Dimanche, 6=Samedi
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_closed')->default(false);
            $table->timestamps();
            
            $table->index(['schedulable_type', 'schedulable_id', 'day_of_week']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};