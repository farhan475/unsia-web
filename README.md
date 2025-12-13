# 🎬 SIM-TAPING UNSIA

**Sistem Informasi Manajemen Taping Video Pembelajaran**  
Universitas Siber Asia (UNSIA)

---

## 📘 Deskripsi Proyek

**SIM-Taping** adalah aplikasi berbasis web yang dirancang untuk mengelola seluruh proses produksi video pembelajaran di UNSIA — mulai dari pengajuan jadwal rekaman oleh dosen hingga publikasi video ke library universitas.

### 🎯 Tujuan Sistem
- Meningkatkan **efisiensi penjadwalan studio** agar tidak bentrok.  
- Menjamin **transparansi status produksi** dari pengajuan sampai publikasi.  
- Menciptakan **sentralisasi manajemen video** agar arsip lebih terstruktur.

---

## 🧩 Modul Utama

### 1. Modul Dosen (Portal Pengajuan)
- Login dosen.
- Form pengajuan taping: pilih mata kuliah, tanggal, sesi, dan keterangan.
- Riwayat pengajuan dengan status: **Pending**, **Approved**, **Rejected**.
- Pembatalan pengajuan jika status masih *Pending*.
- Menu “Video Saya” untuk melihat video yang telah *Published*.

### 2. Modul Admin (Portal Studio)
- Login admin.
- Dashboard antrian pengajuan taping dari semua dosen.
- Persetujuan atau penolakan pengajuan.
- Workflow produksi:
Pending → Approved → Taping → Editing → Ready → Published
- Input link video (YouTube/Server) saat publish.
- Monitoring progres editing dan jadwal studio.

### 3. Video Library
- Daftar video yang sudah *Published*.
- Filter berdasarkan **tahun akademik**, **semester**, dan **program studi**.
- Informasi ditampilkan: judul, dosen, mata kuliah, semester, prodi, dan link video.

---

## 🎨 Tema dan Tampilan

| Elemen | Warna | Keterangan |
|---------|--------|------------|
| Tema utama | `#00588a` | UNSIA Blue |
| Pending | 🟡 Kuning | Status menunggu |
| Approved | 🔵 Biru | Disetujui |
| Editing | 🟠 Oranye | Dalam proses |
| Published | 🟢 Hijau | Selesai tayang |

Frontend dibuat menggunakan **Tailwind CSS** dan **Font Awesome**, agar tampilan modern dan responsif di semua perangkat.

---

## ⚙️ Teknologi yang Digunakan

| Komponen | Teknologi |
|-----------|------------|
| Framework Backend | Laravel 10 / 11 |
| Frontend | Blade + Tailwind CSS |
| Database | MySQL |
| Auth | Laravel Auth / Sanctum |
| Icon | Font Awesome |
| Testing | PHPUnit (Unit & Feature Testing) |

---

## 🧱 Struktur Database (Ringkasan)

| Tabel | Deskripsi |
|--------|-----------|
| `users` | Menyimpan data akun dosen dan admin |
| `taping_requests` | Data pengajuan taping (mata kuliah, tanggal, status) |
| `videos` | Metadata video (judul, prodi, semester, link, status produksi) |

### 🔗 Relasi Utama
- `users (1)` → `taping_requests (N)`  
- `users (1)` → `videos (N)`  
- `taping_requests (1)` → `videos (1)`  
- `courses (1)` → `taping_requests (N)`  

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

```
🧪 Unit Testing
Jalankan semua pengujian otomatis menggunakan PHPUnit:

php artisan test
Contoh pengujian yang dilakukan:

Login Dosen & Admin.

Pengajuan taping baru.

Pembatalan pengajuan oleh dosen.

Persetujuan & publikasi video oleh admin.

Validasi status workflow taping.

📸 Panduan Demo
Demo video (5–10 menit) harus menunjukkan:

Login sebagai Dosen.

Ajukan taping baru.

Login sebagai Admin.

Approve / Reject pengajuan.

Ubah status hingga Published.

Tampilkan video di Video Library.

🧭 Struktur Folder Laravel
pgsql
Copy code
app/
 ├── Http/
 │   ├── Controllers/
 │   │   ├── Dosen/
 │   │   │   ├── DashboardController.php
 │   │   │   ├── TapingRequestController.php
 │   │   │   └── GuideController.php
 │   │   ├── Admin/
 │   │   │   ├── DashboardController.php
 │   │   │   ├── TapingQueueController.php
 │   │   │   ├── PublishController.php
 │   │   │   └── LecturerController.php
 │   └── Middleware/
 ├── Models/
 │   ├── User.php
 │   ├── TapingRequest.php
 │   ├── Video.php
 │   └── Course.php
database/
 ├── migrations/
 └── seeders/
resources/
 ├── views/
 │   ├── dosen/
 │   ├── admin/
 │   └── layouts/
 └── css/
🧩 Fitur Tambahan
📅 Panduan Taping untuk dosen (statis, berisi langkah pengajuan dan aturan).

👨‍🏫 Data Dosen untuk admin (tabel, filter berdasarkan prodi dan nama).

🕓 Activity Log otomatis setiap aksi approve, reject, atau publish.

🔐 Role-based Access: Middleware membedakan akses Dosen dan Admin.

📄 Lisensi
Proyek ini berlisensi di bawah MIT License
Bebas digunakan untuk keperluan pembelajaran, pengembangan, dan penelitian.

💡 Kontributor
Developer: Farhan Asyathry
Framework: Laravel
Instansi: SMKN 64 Jakarta × Universitas Siber Asia (UNSIA)