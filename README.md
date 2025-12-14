# 🎬 SIM-TAPING UNSIA

**Sistem Informasi Manajemen Taping Video Pembelajaran**  
Universitas Siber Asia (UNSIA)

---

## 📘 Deskripsi Proyek

**SIM-Taping** adalah aplikasi berbasis web yang dirancang untuk mengelola seluruh proses produksi video pembelajaran di UNSIA — mulai dari pengajuan jadwal rekaman oleh dosen hingga publikasi video ke library universitas.

### 🎯 Tujuan Sistem

-   Meningkatkan **efisiensi penjadwalan studio** agar tidak bentrok.
-   Menjamin **transparansi status produksi** dari pengajuan sampai publikasi.
-   Menciptakan **sentralisasi manajemen video** agar arsip lebih terstruktur.

---

## 🧩 Modul Utama

### 1. Modul Dosen (Portal Pengajuan)

-   Login dosen.
-   Form pengajuan taping: pilih mata kuliah, tanggal, sesi, dan keterangan.
-   Riwayat pengajuan dengan status: **Pending**, **Approved**, **Rejected**.
-   Menu “Video Saya” untuk melihat video yang telah _Published_.

### 2. Modul Admin (Portal Studio)

-   Login admin.
-   Dashboard antrian pengajuan taping dari semua dosen.
-   Persetujuan atau penolakan pengajuan.
-   Workflow produksi:
    Pending → Approved → Taping → Editing → Ready → Published
-   Input link video (YouTube/Server) saat publish.

### 3. Video Library

-   Daftar video yang sudah _Published_.
-   Informasi ditampilkan: judul, dosen, mata kuliah, semester, prodi, dan link video.

---

## 🎨 Tema dan Tampilan

| Elemen     | Warna     | Keterangan      |
| ---------- | --------- | --------------- |
| Tema utama | `#00588a` | UNSIA Blue      |
| Pending    | 🟡 Kuning | Status menunggu |
| Approved   | 🔵 Biru   | Disetujui       |
| Editing    | 🟠 Oranye | Dalam proses    |
| Published  | 🟢 Hijau  | Selesai tayang  |

Frontend dibuat menggunakan **Tailwind CSS** dan **Font Awesome**, agar tampilan modern dan responsif di semua perangkat.

---

## ⚙️ Teknologi yang Digunakan

| Komponen          | Teknologi              |
| ----------------- | ---------------------- |
| Framework Backend | Laravel 12        |
| Frontend          | Blade + Tailwind CSS   |
| Database          | MySQL                  |
| Auth              | Laravel Auth |
| Icon              | Font Awesome           |

---

## 🧱 Struktur Database (Ringkasan)

| Tabel   | Deskripsi                           |
| ------- | ----------------------------------- |
| `users` | Menyimpan data akun dosen dan admin |

### 🔗 Relasi Utama

-   `users (1)` → `taping_requests (N)`
-   `users (1)` → `videos (N)`
-   `taping_requests (1)` → `videos (1)`
-   `courses (1)` → `taping_requests (N)`

---

## 🔧 Instalasi

1. Clone repository:

```
git clone https://github.com/username/sim-taping.git
cd sim-taping
Instal dependensi Laravel:

composer install
npm install && npm run dev
Buat file .env dan konfigurasi database:

cp .env.example .env
php artisan key:generate
Migrasi dan seeding database:

php artisan migrate --seed
Jalankan server lokal:

php artisan serve
Akses aplikasi di browser:
👉 http://localhost:8000



📸 Panduan Demo
Demo video (5–10 menit) harus menunjukkan:

Login sebagai Dosen.

Ajukan taping baru.

Login sebagai Admin.

Approve / Reject pengajuan.

Ubah status hingga Published.

Tampilkan video di Video Library.

🧭 Struktur Folder Laravel (Hanya Gambaran kasar, belum di update lagi)
app/
├── Http/
│   ├── Controllers/
│   │   │── Admin/
│   │   │  │── AdminController.php
│   │   │─ AuthController.php
│   │   │─ BookingController.php
│   │   │─ DashboardController.php
│   │   │─ DosenController.php
│   │   │─ DashboardController.php
│   │   │─ LibraryController.php
│   │   │─ WorkflowController.php
│   └── Middleware/
│   │   │─ RoleMiddleware.php
├── Models/
│   ├── Booking.php
│   ├── Matkul.php
│   ├── Prodi.php
│   ├── Studio.php
│   ├── User.php
│   ├── Video.php
database/
├── migrations/
└── seeders/
resources/
├── views/
│   ├── dosen/
│   ├── admin/
│   └── layouts/
│   └── components/
└── css/
🧩 Fitur Tambahan
📅 Panduan Taping untuk dosen (statis, berisi langkah pengajuan dan aturan).

👨‍🏫 Data Dosen untuk admin (tabel, filter berdasarkan prodi dan nama).

🔐 Role-based Access: Middleware membedakan akses Dosen dan Admin.

💡 Kontributor
Developer: Farhan Asyathry
Framework: Laravel
Instansi: SMKN 64 Jakarta × Universitas Siber Asia (UNSIA)
```
