@extends('layouts.app')

@section('content')
    <div class="min-h-screen px-4 py-12 flex flex-col items-center">
        <div class="w-full max-w-xl flex flex-col items-center text-center">
            <!-- Profile Section -->
            <header class="mb-10 w-full animate-in fade-in slide-in-from-bottom-4 duration-1000">
                <div class="mx-auto mb-6 flex h-28 w-28 items-center justify-center rounded-full border-2 border-white/10 bg-white/5 p-1 shadow-2xl">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="h-full w-full rounded-full object-cover">
                    @else
                        <div class="flex h-full w-full items-center justify-center rounded-full bg-white/5 text-slate-400">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                    @endif
                </div>
                
                <h1 class="mb-1 text-3xl font-bold tracking-tight text-white">{{ $user->name }}</h1>
                <span class="mb-4 block text-base font-medium text-sky-400">{{ $user->handler }}</span>
                
                @if($user->description)
                    <p class="mx-auto max-w-sm text-base leading-relaxed text-slate-400">
                        {{ $user->description }}
                    </p>
                @endif
            </header>

            <!-- Links List -->
            <main class="w-full space-y-4 mb-12">
                @forelse($user->links->sortBy('order_num') as $link)
                    <a href="{{ $link->link }}" target="_blank" rel="noopener noreferrer" 
                       class="flex w-full items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-6 py-4 text-center font-semibold text-white transition-all duration-300 hover:border-sky-400 hover:bg-white/10 hover:scale-[1.02] active:scale-[0.98] backdrop-blur-xl group">
                        {{ $link->name }}
                    </a>
                @empty
                    <p class="text-slate-400 opacity-70">Nenhum link adicionado ainda.</p>
                @endforelse
            </main>

            <!-- Footer -->
            <footer class="mt-auto flex items-center gap-1.5 text-sm text-slate-500 opacity-60">
                Criado com <a href="/" class="font-bold text-white/80 hover:text-sky-400 transition-colors">Biolinks</a>
            </footer>
        </div>
    </div>
@endsection
