<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class PageController extends Controller
{
    public function home(Request $request): View
    {
        $connection = config('database.default');
        $database = config("database.connections.{$connection}.database");

        $trace = [
            ['label' => 'Route', 'value' => 'GET / (home)'],
            ['label' => 'Controller', 'value' => 'PageController@home'],
            ['label' => 'View', 'value' => 'resources/views/welcome.blade.php'],
            ['label' => 'Server', 'value' => $request->server('SERVER_SOFTWARE', 'tidak diketahui')],
            ['label' => 'Lingkungan', 'value' => app()->environment()],
            ['label' => 'Database', 'value' => "{$connection} / {$database}", 'ok' => $this->databaseConnected()],
        ];

        $routes = [
            ['method' => 'GET', 'path' => '/', 'desc' => 'Halaman ini, dirender oleh PageController@home.'],
            ['method' => 'GET', 'path' => '/about', 'desc' => 'Alat dan folder proyek, datanya berasal dari array di route.'],
            ['method' => 'GET', 'path' => '/contact', 'desc' => 'Form pesan yang menyimpan ke tabel messages.'],
            ['method' => 'POST', 'path' => '/contact', 'desc' => 'Memvalidasi dan menyimpan pesan (PageController@store).'],
            ['method' => 'GET', 'path' => '/hello/{nama}', 'href' => '/hello/Laravel', 'desc' => 'Route parameter: nama diambil dari URL.'],
        ];

        return view('welcome', [
            'laravel' => app()->version(),
            'php' => PHP_VERSION,
            'trace' => $trace,
            'routes' => $routes,
        ]);
    }

    public function contact(): View
    {
        return view('contact', [
            'total' => Schema::hasTable('messages') ? Message::count() : null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'body' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email belum benar.',
            'email.max' => 'Email maksimal 150 karakter.',
            'body.required' => 'Pesan wajib diisi.',
            'body.min' => 'Pesan minimal 10 karakter.',
            'body.max' => 'Pesan maksimal 2000 karakter.',
        ]);

        Message::create($data);

        return redirect()
            ->route('contact')
            ->with('status', 'Pesan terkirim dan tersimpan di database.');
    }

    private function databaseConnected(): bool
    {
        try {
            DB::connection()->getPdo();

            return true;
        } catch (Throwable) {
            return false;
        }
    }
}
