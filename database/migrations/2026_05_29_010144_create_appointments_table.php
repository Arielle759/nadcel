<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 50)->unique();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('salon_id')->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->foreignId('service_id')->constrained()->onDelete('restrict');
            $table->date('appointment_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled', 'no_show'])->default('pending');
            $table->decimal('total_price', 10, 2);
            $table->text('notes')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->foreignId('cancelled_by')->nullable()->constrained('users');
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('reminder_sent_at')->nullable();
            $table->timestamps();
            
            $table->index(['appointment_date', 'status']);
            $table->index(['client_id', 'appointment_date']);
            $table->index(['salon_id', 'appointment_date']);
            $table->unique(['employee_id', 'appointment_date', 'start_time'], 'no_overlap');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};