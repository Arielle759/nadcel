<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->after('email');
            $table->enum('role', ['client', 'employee', 'manager', 'admin'])->default('client')->after('password');
            $table->foreignId('salon_id')->nullable()->constrained()->onDelete('set null')->after('role');
            $table->string('avatar')->nullable()->after('salon_id');
            $table->boolean('is_active')->default(true)->after('avatar');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['salon_id']);
            $table->dropColumn(['phone', 'role', 'salon_id', 'avatar', 'is_active']);
        });
    }
};