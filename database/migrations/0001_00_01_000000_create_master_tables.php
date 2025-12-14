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
        Schema::create('prodis', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10);
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('matkuls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodi_id')->constrained('prodis')->cascadeOnDelete();
            $table->string('kode_mk', 20);
            $table->string('nama_mk');
            $table->timestamps();
        });

        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->default('Studio Multimedia'); // contoh: "Studio Multimedia 1"
            $table->string('kode')->nullable(); 
            $table->integer('kapasitas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studios');
        Schema::dropIfExists('matkuls');
        Schema::dropIfExists('prodis');
    }
};
