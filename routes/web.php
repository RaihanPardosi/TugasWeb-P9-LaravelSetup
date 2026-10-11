<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// "/" dan "/contact" ditangani PageController (hasil make:controller).
Route::get('/', [PageController::class, 'home'])->name('home');

// "/about" memakai closure: array dikirim langsung dari route ke view.
Route::get('/about', function () {
    $tools = [
        ['name' => 'Laragon', 'desc' => 'Server lokal yang membawa Apache, MySQL, phpMyAdmin, dan Composer.'],
        ['name' => 'PHP '.PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION, 'desc' => 'Bahasa pemrograman yang menjalankan Laravel.'],
        ['name' => 'Laravel '.app()->version(), 'desc' => 'Framework utama proyek ini: routing, Blade, dan Eloquent.'],
        ['name' => 'MySQL', 'desc' => 'Database yang dikelola lewat phpMyAdmin dan dikonfigurasi di file .env.'],
        ['name' => 'Tailwind CSS (CDN)', 'desc' => 'Dipakai untuk styling tanpa proses build Node.js.'],
        ['name' => 'Composer', 'desc' => 'Pengelola dependensi PHP, dipakai untuk membuat proyek ini.'],
    ];

    $folders = [
        ['path' => 'routes/web.php', 'desc' => 'Daftar semua route web, termasuk halaman ini.'],
        ['path' => 'app/Http/Controllers', 'desc' => 'Controller. PageController menangani beranda dan kontak.'],
        ['path' => 'app/Models', 'desc' => 'Model Eloquent. Model Message mewakili tabel messages.'],
        ['path' => 'database/migrations', 'desc' => 'Skema tabel database, dijalankan dengan php artisan migrate.'],
        ['path' => 'resources/views', 'desc' => 'Template Blade untuk setiap halaman dan layout bersama.'],
        ['path' => '.env', 'desc' => 'Konfigurasi lokal seperti koneksi database. Tidak ikut di-commit.'],
    ];

    return view('about', compact('tools', 'folders'));
})->name('about');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'store'])->name('contact.store');

// Bonus: route parameter.
Route::get('/hello/{nama}', function (string $nama) {
    $now = now('Asia/Jakarta');

    $salam = match (true) {
        $now->hour < 11 => 'Selamat pagi',
        $now->hour < 15 => 'Selamat siang',
        $now->hour < 18 => 'Selamat sore',
        default => 'Selamat malam',
    };

    return view('hello', [
        'nama' => $nama,
        'salam' => $salam,
        'waktu' => $now->locale('id')->translatedFormat('l, j F Y, H:i').' WIB',
        'detail' => [
            ['label' => 'Jumlah karakter', 'value' => Str::length($nama)],
            ['label' => 'Huruf kapital', 'value' => Str::upper($nama)],
            ['label' => 'Inisial', 'value' => Str::upper(Str::substr($nama, 0, 1))],
        ],
    ]);
})->where('nama', '[A-Za-z0-9_-]{1,40}')->name('hello');
