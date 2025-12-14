<?php

namespace Database\Seeders;

use App\Models\{User, Prodi, Matkul, Studio, Booking};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $if = Prodi::create(['kode' => 'IF', 'nama' => 'Informatika']);
        $si = Prodi::create(['kode' => 'SI', 'nama' => 'Sistem Informasi']);

        $mk1 = Matkul::create([
            'prodi_id' => $if->id,
            'kode_mk'  => 'IF101',
            'nama_mk'  => 'Pemrograman Web',
        ]);

        $mk2 = Matkul::create([
            'prodi_id' => $if->id,
            'kode_mk'  => 'IF202',
            'nama_mk'  => 'Kecerdasan Buatan',
        ]);

        User::create([
            'nama'     => 'Admin Farhan',
            'email'    => 'admin@unsia.ac.id',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        $dosen = User::create([
            'nama'     => 'Dr. Farhan',
            'email'    => 'farhan@unsia.ac.id',
            'password' => Hash::make('password'),
            'role'     => 'dosen',
            'prodi_id' => $if->id,
        ]);

        Booking::create([
            'user_id'        => $dosen->id,
            'matkul_id'      => $mk1->id,
            'topik'          => 'Pengenalan Laravel Blade',
            'tanggal_taping' => now(),
            'sesi'           => '09:00 - 11:00',
            'studio'         => 'Studio Multimedia',
            'status'         => 'Pending',
        ]);
        $studio = Studio::create([
            'nama'      => 'Studio Multimedia 1',
            'kode'      => 'ST1',
            'kapasitas' => 3,
        ]);
    }
}
