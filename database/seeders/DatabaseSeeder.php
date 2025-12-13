<?php

namespace Database\Seeders;

use App\Models\{User, Prodi, Matkul, Studio, Booking };
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Master Data
        $informatika = Prodi::create();
    }
}
