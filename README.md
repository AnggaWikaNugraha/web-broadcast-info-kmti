# Web Broadcast Info KMTI

Sistem informasi dan broadcast WhatsApp berbasis web untuk organisasi mahasiswa **KMTI** (Keluarga Mahasiswa Teknik Informatika). Dibangun menggunakan framework **Laravel 8** dengan pola arsitektur **MVC**.

---

## Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Fitur Utama](#fitur-utama)
- [Tech Stack](#tech-stack)
- [Struktur Database](#struktur-database)
- [Struktur Folder](#struktur-folder)
- [Peran Pengguna](#peran-pengguna)
- [Prasyarat](#prasyarat)
- [Instalasi](#instalasi)
- [Konfigurasi Environment](#konfigurasi-environment)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Rute Aplikasi](#rute-aplikasi)
- [Screenshot](#screenshot)

---

## Tentang Proyek

Proyek ini merupakan tugas akhir yang membangun sistem informasi berbasis web untuk mendukung kegiatan operasional KMTI. Sistem ini memungkinkan pengurus untuk menyebarkan informasi (broadcast) melalui WhatsApp secara terarah kepada anggota, mengelola data mahasiswa, divisi, dan event, serta menyimpan riwayat broadcast ke dalam database.

### Analisa Kebutuhan

Berdasarkan hasil wawancara dengan klien, kebutuhan sistem yang diidentifikasi adalah:

- Sistem dapat melakukan broadcast melalui perantara pesan WhatsApp.
- Sistem dapat menyampaikan broadcast secara spesifik kepada audiens yang dituju (per divisi, per angkatan, atau seluruh anggota).
- Pesan broadcast dapat tercatat dan tersimpan pada database.
- Laporan kegiatan dan laporan keuangan pada event dapat dikelola dalam sistem.

---

## Fitur Utama

### Admin / Pengurus
- **Dashboard** — ringkasan statistik anggota, event, dan broadcast.
- **Manajemen Pengguna** — CRUD data akun user beserta data mahasiswa; import massal via file Excel.
- **Manajemen Divisi** — CRUD divisi/bidang organisasi beserta anggota per divisi.
- **Manajemen Event** — CRUD event dengan status (*belum mulai*, *berjalan*, *selesai*, *cancel*); laporan kegiatan dan keuangan.
- **Broadcast WhatsApp** — kirim pesan ke seluruh anggota, per divisi, atau per angkatan melalui Wablas API; riwayat broadcast tersimpan otomatis.

### Mahasiswa / User
- **Dashboard** — tampilan informasi terkini.
- **Lihat Divisi** — informasi divisi dan anggotanya.
- **Lihat Event** — daftar dan detail event yang sedang atau akan berlangsung.
- **Lihat Broadcast** — riwayat pesan broadcast yang diterima.
- **Profil** — edit data diri dan nomor WhatsApp.

### Publik (tanpa login)
- **Halaman Utama** — menampilkan event aktif dan daftar divisi.
- **Detail Event** — informasi lengkap event.
- **Detail Divisi** — profil dan anggota divisi.

---

## Tech Stack

| Lapisan | Teknologi |
|---|---|
| Backend | PHP 7.3+ / 8.0+, Laravel 8 |
| Frontend | Bootstrap 4.6, jQuery 3.6, Blade Template |
| Database | MySQL |
| Build Tool | Laravel Mix (Webpack) |
| WhatsApp API | [Wablas](https://wablas.com/) |
| HTTP Client | Guzzle 7 |
| DataTable | Yajra Laravel DataTables |
| Excel | Maatwebsite Excel 3.1 |
| Auth | Laravel UI |

---

## Struktur Database

```
users               — Akun pengguna (email, password, roles)
mahasiswa           — Data mahasiswa (nim, no_wa, angkatan, divisi, dll)
kmti (divisi)       — Data divisi/bidang organisasi
events              — Data event/kegiatan
info                — Pesan broadcast
broadcast           — Pivot: info ↔ mahasiswa (riwayat pengiriman)
pengurus            — Pivot: divisi ↔ mahasiswa (keanggotaan)
password_resets     — Token reset password
failed_jobs         — Antrian gagal
```

### Relasi Utama

- `Mahasiswa` **many-to-many** `Info` — via tabel `broadcast`
- `Mahasiswa` **many-to-many** `Divisi` — via tabel `pengurus`
- `Info` **belongs-to** `Divisi` — broadcast dapat ditargetkan ke divisi tertentu

---

## Struktur Folder

```
web-broadcast-info-kmti/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Controller admin (event, divisi, info, user)
│   │   │   ├── Auth/           # Controller autentikasi
│   │   │   ├── User/           # Controller halaman mahasiswa
│   │   │   ├── HomeController.php
│   │   │   ├── MahasiswaController.php
│   │   │   └── WablasController.php
│   │   └── Middleware/
│   ├── Imports/
│   │   └── UsersImport.php     # Import Excel mahasiswa
│   └── Models/
│       ├── Divisi.php
│       ├── DivisiMahasiswa.php
│       ├── Event.php
│       ├── Info.php
│       ├── InfoMahasiswa.php
│       ├── Mahasiswa.php
│       └── User.php
├── database/
│   ├── migrations/             # 23 file migrasi
│   └── seeders/                # Seeder admin & contoh data
├── resources/
│   ├── views/
│   │   ├── admin/              # Tampilan halaman admin
│   │   ├── user/               # Tampilan halaman mahasiswa
│   │   ├── auth/               # Tampilan login & register
│   │   └── layouts/            # Layout utama
│   ├── js/
│   └── sass/
├── routes/
│   ├── web.php                 # Rute utama aplikasi
│   └── api.php
├── .env.example
├── composer.json
├── package.json
└── webpack.mix.js
```

---

## Peran Pengguna

| Peran | Akses |
|---|---|
| `superadmin` | Akses penuh termasuk hapus user dan semua fitur admin |
| `admin` | Kelola event, divisi, broadcast, dan user; submit laporan event |
| `user` | Lihat divisi, event, broadcast; edit profil sendiri |

---

## Prasyarat

Pastikan perangkat Anda memiliki:

- **PHP** >= 7.3 atau >= 8.0
- **Composer** (manajer paket PHP)
- **Node.js** >= 14 dan **npm**
- **MySQL** >= 5.7
- Akun dan token **Wablas API** (untuk fitur broadcast WhatsApp)

---

## Instalasi

### 1. Clone Repositori

```bash
git clone https://github.com/<username>/web-broadcast-info-kmti.git
cd web-broadcast-info-kmti
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Salin File Environment

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Konfigurasi Database

Edit file `.env` dan sesuaikan nilai berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_anda
DB_PASSWORD=password_anda
```

### 6. Konfigurasi Wablas API

Tambahkan kredensial Wablas ke file `.env`:

```env
WABLASS_BRODCAST=https://...   # URL endpoint broadcast Wablas
WABLASS_TOKEN=your_token_here  # Token autentikasi Wablas
WABLASS_TRACKING=https://...   # URL endpoint tracking Wablas
```

### 7. Jalankan Migrasi Database

```bash
php artisan migrate
```

### 8. (Opsional) Jalankan Seeder

Mengisi data awal: akun administrator dan contoh data.

```bash
php artisan db:seed
```

### 9. Install Dependensi Frontend

```bash
npm install
```

### 10. Build Aset Frontend

```bash
# Mode development
npm run dev

# Mode production (dioptimasi)
npm run production

# Mode watch (auto-rebuild saat ada perubahan)
npm run watch
```

---

## Konfigurasi Environment

Berikut daftar lengkap variabel environment yang diperlukan:

```env
APP_NAME="Web Broadcast KMTI"
APP_ENV=local
APP_KEY=                        # Di-generate otomatis via artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

# Wablas WhatsApp API (WAJIB untuk fitur broadcast)
WABLASS_BRODCAST=
WABLASS_TOKEN=
WABLASS_TRACKING=

# Cache & Session
BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Mail (opsional)
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```

---

## Menjalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`.

---

## Rute Aplikasi

### Publik

| Method | URL | Deskripsi |
|---|---|---|
| GET | `/` | Halaman utama |
| GET | `/event/{id}` | Detail event |
| GET | `/divisi/{id}` | Detail divisi |
| GET | `/login` | Halaman login |
| GET | `/register` | Halaman register |

### Admin (memerlukan login + role admin/superadmin)

| Method | URL | Deskripsi |
|---|---|---|
| GET | `/admin/dashboard` | Dashboard admin |
| GET/POST | `/admin/manage-users` | Daftar & tambah user |
| GET/POST | `/admin/manage-event` | Daftar & tambah event |
| GET/POST | `/admin/manage-divisi` | Daftar & tambah divisi |
| GET/POST | `/admin/manage-info` | Daftar & kirim broadcast |

### Mahasiswa (memerlukan login)

| Method | URL | Deskripsi |
|---|---|---|
| GET | `/user/dashboard` | Dashboard mahasiswa |
| GET | `/user/divisi` | Daftar divisi |
| GET | `/user/event` | Daftar event |
| GET | `/user/info` | Riwayat broadcast |
| GET/POST | `/user/profile` | Profil mahasiswa |

---

## Screenshot

![Dashboard Admin](https://user-images.githubusercontent.com/37723902/147527795-89f8c394-1aea-4ede-8e25-c5fd7f16da14.png)
![Manajemen Event](https://user-images.githubusercontent.com/37723902/147527802-39dd4f4b-7a40-42d4-a604-4dd4cb59ef5a.png)
![Broadcast WhatsApp](https://user-images.githubusercontent.com/37723902/147527826-72a303bc-5972-45cf-9956-d4e37fda140f.png)

---

> Dikembangkan sebagai Tugas Akhir — Sistem Informasi Broadcast KMTI berbasis Laravel MVC.
