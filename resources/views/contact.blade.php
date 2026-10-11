@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
    <section class="mx-auto grid max-w-5xl gap-10 px-5 py-12 sm:px-8 sm:py-16 lg:grid-cols-5 lg:gap-16">
        <div class="lg:col-span-2">
            <h1 class="font-display text-4xl font-semibold leading-[1.1] tracking-tight sm:text-5xl">Kirim pesan</h1>
            <p class="mt-5 text-base leading-relaxed text-muted sm:text-lg">
                Isi form di samping. Pesan divalidasi di PageController, lalu disimpan lewat model Message ke tabel messages.
            </p>
            <p class="mt-6 border-t border-line pt-6 text-sm text-muted">
                @if (is_null($total))
                    Tabel messages belum ada. Jalankan <span class="font-mono text-ink">php artisan migrate</span> dulu.
                @else
                    Saat ini ada <span class="font-semibold text-ink">{{ $total }}</span> pesan tersimpan di tabel messages.
                @endif
            </p>
        </div>

        <div class="lg:col-span-3">
            @if (session('status'))
                <div role="status" class="mb-6 flex items-start gap-3 rounded-lg border border-[#1f7a4d]/30 bg-[#1f7a4d]/10 px-4 py-3 text-sm text-[#14613b]">
                    @include('partials.icon', ['name' => 'check', 'class' => 'mt-0.5 size-4 shrink-0'])
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" novalidate class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold">Nama</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name"
                           @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
                           @class([
                               'mt-1.5 block w-full rounded-lg border bg-white px-3.5 py-2.5 text-base text-ink',
                               'border-line' => ! $errors->has('name'),
                               'border-brand' => $errors->has('name'),
                           ])>
                    @error('name')
                        <p id="name-error" class="mt-1.5 text-sm text-brand">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email"
                           @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
                           @class([
                               'mt-1.5 block w-full rounded-lg border bg-white px-3.5 py-2.5 text-base text-ink',
                               'border-line' => ! $errors->has('email'),
                               'border-brand' => $errors->has('email'),
                           ])>
                    @error('email')
                        <p id="email-error" class="mt-1.5 text-sm text-brand">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="body" class="block text-sm font-semibold">Pesan</label>
                    <textarea id="body" name="body" rows="6"
                              @error('body') aria-invalid="true" aria-describedby="body-error" @enderror
                              @class([
                                  'mt-1.5 block w-full resize-y rounded-lg border bg-white px-3.5 py-2.5 text-base text-ink',
                                  'border-line' => ! $errors->has('body'),
                                  'border-brand' => $errors->has('body'),
                              ])>{{ old('body') }}</textarea>
                    @error('body')
                        <p id="body-error" class="mt-1.5 text-sm text-brand">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-ink px-5 py-3 text-sm font-semibold text-white transition-colors hover:bg-black">
                    @include('partials.icon', ['name' => 'send', 'class' => 'size-4'])
                    Kirim pesan
                </button>
            </form>
        </div>
    </section>
@endsection
