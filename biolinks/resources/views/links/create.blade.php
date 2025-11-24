@extends('layouts.app')

@section('content')
    <div class="min-h-[90vh] px-4 py-12 sm:px-6 lg:px-12">
        <div class="mx-auto max-w-2xl space-y-8">
            <!-- Header -->
            <div class="space-y-2">
                <p class="text-xs font-semibold uppercase tracking-[0.6em] text-sky-400">Criar Link</p>
                <h1 class="text-3xl font-semibold text-white/90 sm:text-4xl">Adicionar novas informações</h1>
            </div>

            <!-- Form -->
            <form action="{{ route('links.store') }}" method="POST" class="glass-card">
                @csrf
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">
                            Nome
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-input"
                            placeholder="Ex: Loja, Podcast ou Portfólio" required>
                        @error('name')
                            <p class="text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="link" class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">
                            Link
                        </label>
                        <input type="url" id="link" name="link" value="{{ old('link') }}" required
                            class="form-input" placeholder="https://seusite.com">
                        @error('link')
                            <p class="text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="form-button">
                            Salvar alterações
                        </button>
                        <a href="{{ route('dashboard') }}"
                            class="flex-1 rounded-2xl border border-white/20 px-6 py-3 text-center text-base font-semibold text-white/90 transition hover:border-sky-400 hover:text-sky-400">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
