@extends('layouts.app')

@section('content')
    <div class="flex min-h-[80vh] items-center justify-center px-4 py-12 sm:px-6">
        <div class="glass-card space-y-6">
            <div class="space-y-1 text-center">
                <p class="text-xs uppercase tracking-[0.4em] text-sky-400">Registrar</p>
                <h1 class="text-3xl font-semibold text-white/90">Comece a criar suas biolinks</h1>
                <p class="text-sm text-slate-400">Sem burocracia: um perfil público com seus principais canais.</p>
            </div>

            @if (session('message'))
                <div class="rounded-2xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-100">
                    {{ session('message') }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <label class="block space-y-2 text-sm font-semibold text-slate-300">
                    <span>Nome completo</span>
                    <input type="text" id="name" name="name" required class="form-input" placeholder="Seu nome">
                    @error('name')
                        <span class="text-xs text-red-300">{{ $message }}</span>
                    @enderror
                </label>

                <label class="block space-y-2 text-sm font-semibold text-slate-300">
                    <span>E-mail</span>
                    <input type="email" id="email" name="email" required class="form-input" placeholder="email@exemplo.com">
                    @error('email')
                        <span class="text-xs text-red-300">{{ $message }}</span>
                    @enderror
                </label>

                <label class="block space-y-2 text-sm font-semibold text-slate-300">
                    <span>Confirmar e-mail</span>
                    <input type="email" id="email_confirmation" name="email_confirmation" required class="form-input" placeholder="Confirme o e-mail">
                    @error('email_confirmation')
                        <span class="text-xs text-red-300">{{ $message }}</span>
                    @enderror
                </label>

                <label class="block space-y-2 text-sm font-semibold text-slate-300">
                    <span>Senha</span>
                    <input type="password" id="password" name="password" required class="form-input" placeholder="••••••••">
                    @error('password')
                        <span class="text-xs text-red-300">{{ $message }}</span>
                    @enderror
                </label>

                <button type="submit" class="form-button">Criar conta</button>
            </form>

            <p class="text-center text-xs text-slate-400">
                Já possui conta?
                <a href="{{ route('login') }}" class="font-semibold text-sky-300 underline-offset-4 hover:text-sky-200">
                    Faça login
                </a>
            </p>
        </div>
    </div>
@endsection
