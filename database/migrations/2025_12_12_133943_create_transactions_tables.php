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
        Schema::create('transactions_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('matkul_id')->constrained('matkuls');
            $table->foreignId('studio_id')->default(1)->constrained('studios');
            $table->string('topiks');
            $table->date('tanggal_tapping');
            $table->string('sesi');
            $table->enum('status',['Pending', 'Approved', 'Rejected', 'Taping', 'Editing', 'Ready', 'Published'])->default('Pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->string('judul_final');
            $table->string('link_video');
            $table->string('tahun_akademik')->default('2023/2024');
            $table->enum('semester',['Ganjil', 'Genap'])->default('Ganjil');
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions_tables');
    }
};
