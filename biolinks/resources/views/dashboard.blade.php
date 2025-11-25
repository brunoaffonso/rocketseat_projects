@extends('layouts.app')

@section('content')
    <div class="min-h-[90vh] px-4 py-12 sm:px-6 lg:px-12">
        <div class="mx-auto max-w-6xl space-y-8">
            <!-- Header -->
            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                <div class="space-y-2">
                    <p class="text-xs font-semibold uppercase tracking-[0.6em] text-sky-400">Dashboard</p>
                    <h1 class="text-3xl font-semibold text-white/90 sm:text-4xl">Meus Links</h1>
                    <p class="text-sm text-slate-300">Gerencie todos os seus links em um só lugar</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('links.create') }}"
                        class="inline-flex items-center justify-center rounded-2xl bg-sky-500 px-6 py-3 text-base font-semibold text-white shadow-[0_20px_60px_rgba(14,165,233,0.45)] transition duration-200 hover:bg-sky-400">
                        + Criar Link
                    </a>
                    <a href="{{ route('logout') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-white/20 px-6 py-3 text-base font-semibold text-white/90 transition hover:border-red-400 hover:text-red-400">
                        Sair
                    </a>
                </div>
            </div>

            <!-- Links Grid -->
            @if ($links->isEmpty())
                <div class="glass-card flex flex-col items-center justify-center space-y-4 py-16 text-center">
                    <div class="rounded-full bg-sky-500/10 p-6">
                        <svg class="h-12 w-12 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white/90">Nenhum link cadastrado</h3>
                    <p class="max-w-md text-sm text-slate-400">
                        Comece criando seu primeiro link para compartilhar com sua audiência
                    </p>
                    <a href="{{ route('links.create') }}"
                        class="mt-4 inline-flex items-center justify-center rounded-2xl bg-sky-500 px-6 py-3 text-base font-semibold text-white shadow-[0_20px_60px_rgba(14,165,233,0.45)] transition duration-200 hover:bg-sky-400">
                        Criar Primeiro Link
                    </a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($links as $link)
                        <div class="glass-card group transition-all duration-300 hover:border-sky-400/50 !p-3">
                            <div class="flex items-center gap-3">
                                <!-- Controles de Ordenação -->
                                <div class="flex items-center gap-1">
                                    @if (!$loop->first)
                                        <form action="{{ route('links.up', $link) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="rounded-lg bg-sky-500/10 p-2 text-sky-400 transition hover:bg-sky-500/20"
                                                title="Mover para cima">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 15l7-7 7 7" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <div class="w-10"></div>
                                    @endif
                                    {{-- <div>{{ $link->order_num }}</div> --}}
                                    @if (!$loop->last)
                                        <form action="{{ route('links.down', $link) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="rounded-lg bg-sky-500/10 p-2 text-sky-400 transition hover:bg-sky-500/20"
                                                title="Mover para baixo">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <div class="w-10"></div>
                                    @endif
                                </div>

                                <!-- Informações do Link -->
                                <div class="flex-1 space-y-2">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex-1">
                                            <h3
                                                class="text-lg font-semibold text-white/90 group-hover:text-sky-400 transition">
                                                {{ $link->name }}
                                            </h3>
                                            @if ($link->url)
                                                <p class="text-xs text-slate-400 break-all mt-1">
                                                    {{ Str::limit($link->url, 60) }}</p>
                                            @endif
                                            @if ($link->description)
                                                <p class="text-sm text-slate-300 mt-2 line-clamp-2">{{ $link->description }}
                                                </p>
                                            @endif
                                        </div>
                                        <span
                                            class="rounded-full bg-sky-500/10 px-3 py-1 text-xs font-semibold text-sky-400 whitespace-nowrap">
                                            ativo
                                        </span>
                                    </div>
                                </div>

                                <!-- Ações -->
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('links.edit', $link) }}"
                                        class="rounded-xl border border-white/20 px-4 py-2 text-sm font-semibold text-white/90 transition hover:border-sky-400 hover:text-sky-400">
                                        Editar
                                    </a>
                                    <form action="{{ route('links.destroy', $link) }}" method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja excluir este link?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-2 text-sm font-semibold text-red-400 transition hover:border-red-400 hover:bg-red-500/20">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
