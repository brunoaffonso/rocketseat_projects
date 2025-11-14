@extends('layouts.app')

@section('content')
    <div class="min-h-[90vh] px-4 py-12 sm:px-6 lg:px-12">
        <div
            class="mx-auto flex max-w-6xl flex-col gap-10 rounded-[38px] border border-white/10 bg-gradient-to-br from-slate-900/60 via-slate-900/30 to-slate-950/70 p-8 shadow-[0_25px_90px_rgba(15,23,42,0.75)] lg:flex-row lg:items-center lg:justify-between">
            <div class="space-y-6 lg:max-w-xl">
                <p class="text-xs font-semibold uppercase tracking-[0.6em] text-sky-400">Biolinks</p>
                <h1 class="text-3xl font-semibold leading-tight text-white/90 sm:text-4xl">
                    Crie um link one-click para sua bio e gerencie tudo em um painel elegante.
                </h1>
                <p class="text-base text-slate-300">
                    Organize links, redes e conteúdos em um só lugar com layout responsivo, tipografia legível e
                    botões touch-friendly.
                </p>
                <div class="flex flex-wrap gap-4">
                    <span
                        class="rounded-full border border-white/30 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-white/70">Link
                        único</span>
                    <span
                        class="rounded-full border border-white/30 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-white/70">HTTPS
                        pronto</span>
                </div>
            </div>

            <form action="{{ route('links.store') }}" method="POST"
                class="w-full rounded-3xl border border-white/10 bg-white/5 p-8 shadow-[0_20px_120px_rgba(15,23,42,0.65)] backdrop-blur-2xl lg:max-w-[420px]">
                @csrf
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">Nome
                            (opcional)</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-input"
                            placeholder="Ex: Loja, Podcast ou Portfólio">
                        @error('name')
                            <p class="text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="link"
                            class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">Link</label>
                        <input type="url" id="link" name="link" value="{{ old('link') }}" required
                            class="form-input" placeholder="https://seusite.com">
                        @error('link')
                            <p class="text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="form-button">Criar link</button>
                </div>
                <p class="mt-6 text-xs text-slate-500">
                    Ao criar o link você poderá adicioná-lo no Instagram, TikTok, WhatsApp e muito mais.
                </p>
            </form>
        </div>
    </div>
@endsection
