@extends('layouts.app')

@section('content')
    <div class="min-h-[90vh] px-4 py-12 sm:px-6 lg:px-12">
        <div class="mx-auto max-w-2xl space-y-8">
            <!-- Header -->
            <div class="space-y-2">
                <p class="text-xs font-semibold uppercase tracking-[0.6em] text-sky-400">Perfil</p>
                <h1 class="text-3xl font-semibold text-white/90 sm:text-4xl">Editar seu perfil</h1>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('profile') }}" class="glass-card">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">
                            Nome
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}"
                            class="form-input" placeholder="Seu nome" required>
                        @error('name')
                            <p class="text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="handler" class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">
                            Handler
                        </label>
                        <div class="flex items-center">
                            <span
                                class="rounded-l-2xl border border-r-0 border-white/10 bg-white/10 px-4 py-3 text-base text-slate-400">
                                biolinks.com.br/@
                            </span>
                            <input type="text" id="handler" name="handler"
                                value="{{ old('handler', $user->handler ?? '') }}"
                                class="form-input rounded-l-none border-l-0" placeholder="seulink" required>
                        </div>
                        @error('handler')
                            <p class="text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">
                            Sobre
                        </label>
                        <textarea id="description" name="description" rows="4" class="form-input resize-none"
                            placeholder="Conte um pouco sobre você..." required>{{ old('description', $user->description ?? '') }}</textarea>
                        @error('description')
                            <p class="text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="form-button">
                            Atualizar
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
