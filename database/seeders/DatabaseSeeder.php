<?php

namespace Database\Seeders;

use App\Models\{User, Prodi, Matkul, Studio, Booking };
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
        // master data prodi
        $if = Prodi::create(['kode' => 'IF', 'nama' => 'Informatika']);
        $si = Prodi::create(['kode' => 'SI', 'nama' => 'Sistem Informasi']);
        $kom = Prodi::create(['kode' => 'KOM', 'nama' => 'Ilmu Komunikasi']);
        $ak = Prodi::create(['kode' => 'AK', 'nama' => 'Akuntansi']);
        $mn = Prodi::create(['kode' => 'MN', 'nama' => 'Manajemen']);

        // master data studio
        Studio::create(['nama' => 'Studio Multimedia 1 (Green Screen)']);
        Studio::create(['nama' => 'Studio Podcast']);

        // master data matkul (untuk autosearch)
        $matkuls = [
            [$if->id, 'IF101', 'Algoritma & Pemrograman'],
            [$if->id, 'IF202', 'Kecerdasan Buatan'],
            [$if->id, 'IF303', 'Pemrograman Web Lanjut'],
            [$si->id, 'SI101', 'Sistem Basis Data'],
            [$si->id, 'SI202', 'Audit Sistem Informasi'],
            [$kom->id, 'KM101', 'Pengantar Ilmu Komunikasi'],
            [$kom->id, 'KM202', 'Jurnalistik Digital'],
            [$ak->id, 'AK101', 'Akuntansi Dasar'],
            [$mn->id, 'MN101', 'Pengantar Manajemen'],
        ];

        foreach ($matkuls as $mk) {
            Matkul::create([
                'prodi_id' => $mk[0],
                'kode_matkul'  => $mk[1],
                'nama_matkul'  => $mk[2],
            ]);
        }

        // user data(admin & dosen)

        // admin
        User::create([
            'nama' => 'Admin farhan',
            'email' => 'admin@unsia.ac.id',
            'password' => Hash::make('password'), 
            'role' => 'admin',
        ]);

        // dosen infor
        $dosen1 = User::create([
            'nama' => 'Dr. farhan asyathry',
            'email' => 'farhan@unsia.ac.id',
            'password' => Hash::make('password'),
            'role' => 'dosen',
            'prodi_id' => $if->id,
            'nidn' => '0502258000'
        ]);

        // dosen ilkom
        $dosen2 = User::create([
            'nama' => 'farhan, M.I.Kom',
            'email' => 'farhan1@unsia.ac.id',
            'password' => Hash::make('password'),
            'role' => 'dosen',
            'prodi_id' => $kom->id,
            'nidn' => '0102030405'
        ]);

        // dummy data untuk booking(agar dashboard tidak kosong)
        Booking::create([
            'user_id' => $dosen1->id,
            'matkul_id' => 1, // Algoritma
            'studio_id' => 1,
            'topik' => 'Pengenalan Flowchart',
            'tanggal_taping' => now()->addDays(2), // 2 hari lagi
            'sesi' => '09:00 - 11:00',
            'status' => 'Pending'
        ]);

        Booking::create([
            'user_id' => $dosen2->id,
            'matkul_id' => 6, // Pengantar Ilkom
            'studio_id' => 1,
            'topik' => 'Teori Komunikasi Dasar',
            'tanggal_taping' => now()->subDays(1), // Kemarin
            'sesi' => '13:00 - 15:00',
            'status' => 'Approved'
        ]);
    }
}
