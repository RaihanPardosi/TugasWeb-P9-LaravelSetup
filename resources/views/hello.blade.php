@extends('layouts.app')

@section('title', 'Hello '.$nama)

@section('content')
    <section class="mx-auto max-w-5xl px-5 py-12 sm:px-8 sm:py-16">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-medium text-muted hover:text-ink">
            @include('partials.icon', ['name' => 'arrow-left', 'class' => 'size-4'])
            Kembali ke beranda
        </a>

        <p class="mt-10 text-muted">{{ $waktu }}</p>
        <h1 class="mt-2 break-words font-display text-4xl font-semibold leading-[1.1] tracking-tight sm:text-6xl">
            {{ $salam }}, {{ $nama }}.
        </h1>
        <p class="mt-5 max-w-xl text-base leading-relaxed text-muted sm:text-lg">
            Nama ini diambil dari bagian <span class="font-mono text-ink">{nama}</span> pada URL
            <span class="font-mono text-ink">/hello/{nama}</span>. Ganti URL-nya dan halaman ini ikut berubah.
        </p>

        <dl class="mt-10 max-w-xl divide-y divide-line border-y border-line">
            @foreach ($detail as $row)
                <div class="grid gap-1 py-3.5 sm:grid-cols-[10rem_1fr] sm:gap-4">
                    <dt class="text-muted">{{ $row['label'] }}</dt>
                    <dd class="break-words font-mono text-sm font-medium">{{ $row['value'] }}</dd>
                </div>
            @endforeach
        </dl>

        <form id="hello-form" class="mt-10 max-w-md">
            <label for="nama-baru" class="block text-sm font-semibold">Coba nama lain</label>
            <div class="mt-1.5 flex flex-col gap-3 sm:flex-row">
                <input id="nama-baru" name="nama" type="text" maxlength="40" required placeholder="Contoh: Budi"
                       class="block w-full rounded-lg border border-line bg-white px-3.5 py-2.5 text-base text-ink">
                <button type="submit" class="inline-flex shrink-0 items-center justify-center rounded-lg bg-ink px-5 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-black">Sapa</button>
            </div>
            <p class="mt-2 text-sm text-muted">Spasi diganti tanda hubung. Simbol lain dihapus.</p>
        </form>
    </section>

    <script>
        document.getElementById('hello-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const nama = this.nama.value.trim().replace(/\s+/g, '-').replace(/[^A-Za-z0-9_-]/g, '');
            if (nama) {
                window.location.href = @json(url('/hello')) + '/' + nama;
            }
        });
    </script>
@endsection
