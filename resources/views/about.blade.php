@extends('layouts.app')

@section('title', 'Tentang')

@section('content')
    <section class="mx-auto max-w-5xl px-5 py-12 sm:px-8 sm:py-16">
        <h1 class="max-w-2xl font-display text-4xl font-semibold leading-[1.1] tracking-tight text-balance sm:text-5xl">Tentang proyek ini</h1>
        <p class="mt-5 max-w-xl text-base leading-relaxed text-muted sm:text-lg">
            Proyek setup Laravel untuk Tugas Rutin Pertemuan 9: instalasi lewat Composer, koneksi MySQL,
            tiga route kustom, dan tampilan Blade dengan data dinamis.
        </p>
    </section>

    <section class="border-t border-line">
        <div class="mx-auto max-w-5xl px-5 py-12 sm:px-8 sm:py-16">
            <h2 class="font-display text-2xl font-semibold tracking-tight sm:text-3xl">Alat yang dipakai</h2>
            <dl class="mt-8 grid gap-x-12 gap-y-7 sm:grid-cols-2">
                @foreach ($tools as $tool)
                    <div>
                        <dt class="font-semibold">{{ $tool['name'] }}</dt>
                        <dd class="mt-1 max-w-sm text-muted">{{ $tool['desc'] }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    <section class="border-t border-line">
        <div class="mx-auto max-w-5xl px-5 py-12 sm:px-8 sm:py-16">
            <h2 class="font-display text-2xl font-semibold tracking-tight sm:text-3xl">Folder dan file penting</h2>
            <ul class="mt-8 divide-y divide-line border-y border-line">
                @foreach ($folders as $folder)
                    <li class="grid gap-1 py-4 sm:grid-cols-[15rem_1fr] sm:items-baseline sm:gap-4">
                        <span class="break-words font-mono text-sm font-medium">{{ $folder['path'] }}</span>
                        <span class="text-muted">{{ $folder['desc'] }}</span>
                    </li>
                @endforeach
            </ul>
            <p class="mt-6 text-sm text-muted">Kedua daftar di halaman ini dikirim sebagai array dari route /about di routes/web.php.</p>
        </div>
    </section>
@endsection
