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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // Karyawan/data yang diubah
            $table->foreignId('employee_id')
                ->nullable()
                ->constrained('employees')
                ->cascadeOnDelete();

            // User/karyawan yang melakukan perubahan
            $table->foreignId('changed_by')
                ->constrained('employees')
                ->nullOnDelete();

            $table->jsonb('old_data')->nullable();
            $table->jsonb('new_data')->nullable();

            $table->enum('action', ['create', 'update', 'delete'])->default('update');

            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
