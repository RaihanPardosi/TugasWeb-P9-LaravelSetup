@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="mx-auto grid max-w-5xl gap-10 px-5 py-12 sm:px-8 sm:py-16 lg:grid-cols-[1fr_1.05fr] lg:items-center lg:gap-14 lg:py-24">
        <div>
            <h1 class="font-display text-4xl font-semibold leading-[1.08] tracking-tight text-balance sm:text-5xl lg:text-[3.4rem]">
                Laravel {{ $laravel }} berjalan di PHP {{ $php }}.
            </h1>
            <p class="mt-5 max-w-md text-base leading-relaxed text-muted sm:text-lg">
                Halaman ini dirender oleh PageController lewat route <span class="font-mono text-ink">/</span>.
                Nilai di panel diambil dari server saat halaman dibuka, bukan teks tetap.
            </p>
            <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-3">
                <a href="{{ route('about') }}" class="inline-flex items-center rounded-lg bg-ink px-5 py-3 text-sm font-semibold text-white transition-colors hover:bg-black">Lihat tentang proyek</a>
                <a href="{{ route('hello', 'Laravel') }}" class="text-sm font-semibold underline decoration-line decoration-2 underline-offset-4 hover:decoration-brand">Coba route parameter</a>
            </div>
        </div>

        <div class="rounded-xl bg-night font-mono text-sm text-[#e8eae6]">
            <div class="flex items-center justify-between gap-4 border-b border-white/10 px-5 py-3.5">
                <span class="font-medium">GET /</span>
                <span class="inline-flex items-center gap-1.5 text-[#5fd39a]">
                    @include('partials.icon', ['name' => 'check', 'class' => 'size-4'])
                    200 OK
                </span>
            </div>
            <dl class="divide-y divide-white/10">
                @foreach ($trace as $row)
                    <div class="grid gap-1 px-5 py-3.5 sm:grid-cols-[7.5rem_1fr] sm:gap-4">
                        <dt class="text-[#9aa4ac]">{{ $row['label'] }}</dt>
                        <dd class="flex min-w-0 flex-wrap items-center gap-x-3 gap-y-1">
                            <span class="min-w-0 break-words">{{ $row['value'] }}</span>
                            @isset($row['ok'])
                                <span class="inline-flex items-center gap-1 {{ $row['ok'] ? 'text-[#5fd39a]' : 'text-[#ff9b92]' }}">
                                    @include('partials.icon', ['name' => $row['ok'] ? 'check' : 'x-mark', 'class' => 'size-4'])
                                    {{ $row['ok'] ? 'terhubung' : 'tidak terhubung' }}
                                </span>
                            @endisset
                        </dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    <section class="border-t border-line">
        <div class="mx-auto max-w-5xl px-5 py-12 sm:px-8 sm:py-16">
            <h2 class="font-display text-2xl font-semibold tracking-tight sm:text-3xl">Rute yang tersedia</h2>
            <p class="mt-2 max-w-xl text-muted">Semua rute didaftarkan di routes/web.php.</p>

            <ul class="mt-8 divide-y divide-line border-y border-line">
                @foreach ($routes as $item)
                    <li class="grid gap-1 py-4 sm:grid-cols-[5rem_13rem_1fr] sm:items-baseline sm:gap-4">
                        <span class="font-mono text-xs font-medium text-muted">{{ $item['method'] }}</span>
                        @if ($item['method'] === 'GET')
                            <a href="{{ url($item['href'] ?? $item['path']) }}" class="font-mono text-sm font-medium text-brand underline-offset-4 hover:underline">{{ $item['path'] }}</a>
                        @else
                            <span class="font-mono text-sm font-medium">{{ $item['path'] }}</span>
                        @endif
                        <span class="text-muted">{{ $item['desc'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
