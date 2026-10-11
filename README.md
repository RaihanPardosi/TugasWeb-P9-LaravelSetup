# P9-SetupLaravel

Tugas Rutin Pertemuan 9: setup Laravel 13 di Laragon (PHP 8.4, MySQL).
Proyek ini berisi tiga route kustom (`/`, `/about`, `/contact`), satu controller, satu model dengan migration, view Blade bergaya Tailwind CDN, dan route parameter `/hello/{nama}`.

## Prasyarat

- Laragon (sudah membawa Apache, MySQL, phpMyAdmin, Composer, dan Git)
- PHP 8.4 aktif di Laragon
- Koneksi internet (Tailwind dan font dimuat dari CDN)

Cek versi di terminal Laragon:

```bash
php -v
composer -V
```

## Langkah instalasi

### 1. Buat proyek dengan Composer

Buka terminal Laragon, pindah ke folder `www`, lalu jalankan:

```bash
cd C:\laragon\www
composer create-project laravel/laravel:^13.0 P9-SetupLaravel
cd P9-SetupLaravel
```

### 2. Buat database di phpMyAdmin

1. Start semua layanan di Laragon.
2. Buka phpMyAdmin (menu Laragon > MySQL > phpMyAdmin, atau `http://localhost/phpmyadmin`).
3. Klik **New**, isi nama database `p9_setuplaravel`, collation `utf8mb4_unicode_ci`, lalu **Create**.

### 3. Konfigurasi `.env`

Buka `.env`, lalu ubah bagian berikut:

```env
APP_NAME="P9-SetupLaravel"
APP_LOCALE=id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=p9_setuplaravel
DB_USERNAME=root
DB_PASSWORD=
```

Password MySQL bawaan Laragon kosong. Sesuaikan jika Anda mengubahnya.

### 4. Buat controller dan model

Dua perintah ini dijalankan sekali saja:

```bash
php artisan make:controller PageController
php artisan make:model Message -m
```

Perintah kedua membuat model `Message` dan file migration `create_messages_table`.
Isi file-file tersebut dengan kode dari repo ini:

- `app/Http/Controllers/PageController.php`
- `app/Models/Message.php`
- `database/migrations/xxxx_create_messages_table.php` (isi bagian `up()` dan `down()`)

### 5. Jalankan migrasi

```bash
php artisan migrate
```

Perintah ini membuat tabel bawaan Laravel (users, sessions, cache, jobs) dan tabel `messages` di database MySQL.

### 6. Jalankan server

```bash
php artisan serve
```

Buka `http://127.0.0.1:8000`.
Alternatif di Laragon: aktifkan Auto Virtual Hosts, lalu buka `http://p9-setuplaravel.test`.

## Daftar route

| Method | URL | Penangan | Keterangan |
|--------|-----|----------|------------|
| GET | `/` | `PageController@home` | Halaman welcome dengan data server dinamis |
| GET | `/about` | closure di `routes/web.php` | Alat dan folder proyek (array dari route) |
| GET | `/contact` | `PageController@contact` | Form pesan |
| POST | `/contact` | `PageController@store` | Validasi dan simpan pesan ke tabel `messages` |
| GET | `/hello/{nama}` | closure di `routes/web.php` | Bonus: route parameter |

## Struktur folder

```text
P9-SetupLaravel/
├── app/
│   ├── Http/Controllers/    Controller (PageController)
│   ├── Models/              Model Eloquent (Message)
│   └── Providers/           Service provider aplikasi
├── bootstrap/               File bootstrap framework dan cache
├── config/                  File konfigurasi (app, database, session, dll.)
├── database/
│   ├── factories/           Factory untuk data uji
│   ├── migrations/          Skema tabel database
│   └── seeders/             Seeder data awal
├── public/                  Document root, berisi index.php dan aset publik
├── resources/
│   ├── css/ dan js/         Aset bawaan Vite (tidak dipakai, styling pakai Tailwind CDN)
│   └── views/               Template Blade
│       ├── layouts/app.blade.php     Layout bersama (header, nav, footer)
│       ├── partials/icon.blade.php   Ikon SVG
│       └── *.blade.php               Halaman: welcome, about, contact, hello
├── routes/
│   ├── web.php              Route web
│   └── console.php          Perintah Artisan kustom
├── storage/                 Log, cache, dan file upload
├── tests/                   Pengujian otomatis
├── vendor/                  Dependensi Composer (tidak di-commit)
├── .env                     Konfigurasi lokal (tidak di-commit)
├── artisan                  CLI Laravel
└── composer.json            Daftar dependensi PHP
```

Alur satu request: `public/index.php` menerima request, `routes/web.php` mencocokkan URL, controller menyiapkan data, lalu view Blade di `resources/views` merender HTML.

## Perintah Artisan yang dipakai

```bash
php artisan make:controller PageController
php artisan make:model Message -m
php artisan migrate
php artisan serve
php artisan route:list
```

## Screenshot

Simpan screenshot di `docs/screenshots/`.

![Terminal php artisan serve](docs/screenshots/artisan-serve.png)
![Halaman welcome](docs/screenshots/welcome.png)
![Halaman about](docs/screenshots/about.png)
![Halaman contact](docs/screenshots/contact.png)
![Route parameter](docs/screenshots/hello.png)

## Bonus

- Styling memakai Tailwind CSS lewat CDN (`resources/views/layouts/app.blade.php`).
- Route parameter `/hello/{nama}`, misalnya `/hello/Laravel`.

## Push ke GitHub

```bash
git init
git add .
git commit -m "Setup Laravel: route, controller, model, dan view"
git branch -M main
git remote add origin https://github.com/<username>/P9-SetupLaravel.git
git push -u origin main
```
