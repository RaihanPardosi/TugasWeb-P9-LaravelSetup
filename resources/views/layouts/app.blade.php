<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=bricolage-grotesque:600,700|ibm-plex-sans:400,500,600|ibm-plex-mono:400,500&display=swap" rel="stylesheet">

    {{-- Tailwind via CDN (bonus tugas), tidak perlu npm atau Vite --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @verbatim
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'IBM Plex Sans', ui-sans-serif, system-ui, sans-serif;
            --font-display: 'Bricolage Grotesque', 'IBM Plex Sans', ui-sans-serif, system-ui, sans-serif;
            --font-mono: 'IBM Plex Mono', ui-monospace, SFMono-Regular, Menlo, monospace;
            --color-paper: #f3f4f1;
            --color-ink: #161a1d;
            --color-night: #161a1d;
            --color-muted: #5b6670;
            --color-line: #d9dcd6;
            --color-brand: #c4271c;
        }
        @layer base {
            html { background-color: var(--color-paper); }
            :focus-visible { outline: 2px solid var(--color-brand); outline-offset: 3px; }
        }
    </style>
    @endverbatim
</head>
<body class="flex min-h-screen flex-col bg-paper font-sans text-ink antialiased">
    @php
        $links = [
            ['route' => 'home', 'label' => 'Beranda', 'match' => 'home'],
            ['route' => 'about', 'label' => 'Tentang', 'match' => 'about'],
            ['route' => 'contact', 'label' => 'Kontak', 'match' => 'contact*'],
        ];
    @endphp

    <a href="#konten" class="sr-only focus:not-sr-only focus:absolute focus:left-3 focus:top-3 focus:z-50 focus:rounded-md focus:bg-ink focus:px-3 focus:py-2 focus:text-sm focus:text-white">Lewati ke konten</a>

    <header class="border-b border-line">
        <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-x-6 gap-y-3 px-5 py-4 sm:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 font-display text-lg font-semibold tracking-tight">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-7" aria-hidden="true">
                    <rect width="24" height="24" rx="6" fill="#161a1d" />
                    <path d="M7 16.5h4.5a3 3 0 0 0 3-3V10.5" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" />
                    <circle cx="7" cy="16.5" r="1.6" fill="#fff" />
                    <circle cx="14.5" cy="9" r="1.6" fill="#e5483d" />
                </svg>
                {{ config('app.name') }}
            </a>

            <nav aria-label="Navigasi utama" class="flex items-center gap-1 text-sm font-medium">
                @foreach ($links as $link)
                    @php $active = request()->routeIs($link['match']); @endphp
                    <a href="{{ route($link['route']) }}"
                       @if ($active) aria-current="page" @endif
                       @class([
                           'rounded-md px-3 py-2 transition-colors',
                           'bg-ink text-white' => $active,
                           'text-muted hover:text-ink' => ! $active,
                       ])>{{ $link['label'] }}</a>
                @endforeach
            </nav>
        </div>
    </header>

    <main id="konten" class="flex-1">
        @yield('content')
    </main>

    <footer class="border-t border-line">
        <div class="mx-auto flex max-w-5xl flex-wrap justify-between gap-2 px-5 py-6 text-sm text-muted sm:px-8">
            <span>Tugas Rutin 9: Setup Laravel</span>
            <span>Laravel {{ app()->version() }}</span>
        </div>
    </footer>
</body>
</html>
