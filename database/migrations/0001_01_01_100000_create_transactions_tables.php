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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('matkul_id')->constrained('matkuls');
            $table->string('topik');
            $table->date('tanggal_taping');
            $table->string('sesi');
            $table->string('studio')->default('Studio Multimedia');
            $table->enum('status',['Pending', 'Approved', 'Rejected', 'Taping', 'Editing', 'Ready', 'Published'])->default('Pending');
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->string('judul');
            $table->string('link_video');
            $table->integer('views')->default(0);
            $table->string('semester')->default('Ganjil 2023/2024');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('videos');
    }
};
