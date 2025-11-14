@extends('layouts.app')

@section('content')
    <div class="flex min-h-[80vh] items-center justify-center px-4 py-12 sm:px-6">
        <div class="glass-card space-y-6">
            <div class="space-y-1 text-center">
                <p class="text-sm uppercase tracking-[0.4em] text-sky-400">Entrar</p>
                <h1 class="text-3xl font-semibold text-white/90">Bem-vindo de volta</h1>
                <p class="text-sm text-slate-400">Use as credenciais cadastradas para acessar seu painel.</p>
            </div>

            @if (session('message'))
                <div class="rounded-2xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-100">
                    {{ session('message') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="post" class="space-y-4">
                @csrf
                <label class="block space-y-2 text-sm font-semibold text-slate-300">
                    <span>E-mail</span>
                    <input type="text" name="email" placeholder="seu@email.com" class="form-input">
                    @error('email')
                        <span class="text-xs text-red-300">{{ $message }}</span>
                    @enderror
                </label>

                <label class="block space-y-2 text-sm font-semibold text-slate-300">
                    <span>Senha</span>
                    <input type="password" name="password" placeholder="••••••••" class="form-input">
                    @error('password')
                        <span class="text-xs text-red-300">{{ $message }}</span>
                    @enderror
                </label>

                <button type="submit" class="form-button">Entrar</button>
            </form>

            <p class="text-center text-xs text-slate-400">
                Ainda não tem conta?
                <a href="{{ route('register') }}" class="font-semibold text-sky-300 underline-offset-4 hover:text-sky-200">
                    Cadastre-se grátis
                </a>
            </p>
        </div>
    </div>
@endsection
