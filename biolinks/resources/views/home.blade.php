@extends('layouts.app')

@section('content')
    <div class="min-h-[90vh] px-4 py-12 sm:px-6 lg:px-12">
        <div class="mx-auto flex max-w-6xl flex-col gap-10 rounded-[38px] border border-white/10 bg-gradient-to-br from-slate-900/60 via-slate-900/30 to-slate-950/70 p-8 shadow-[0_25px_90px_rgba(15,23,42,0.75)] lg:flex-row lg:items-center lg:justify-between">
            <div class="space-y-6 lg:max-w-xl">
                <p class="text-xs font-semibold uppercase tracking-[0.6em] text-sky-400">Biolinks</p>
                <h1 class="text-4xl font-semibold leading-tight text-white/90 sm:text-5xl">
                    Uma landing page que cabe no seu bolso e brilha na tela grande.
                </h1>
                <p class="text-base text-slate-300">
                    Crie um hub responsivo para reunir links, redes e conteúdos, com layout pensado para
                    telas pequenas, gestos e tipografia legível em qualquer resolução.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('register') }}" class="form-button text-base">Começar agora</a>
                    <a href="{{ route('login') }}"
                        class="rounded-2xl border border-white/20 px-6 py-3 font-semibold text-white/90 transition hover:border-sky-400 hover:text-sky-200">
                        Já sou membro
                    </a>
                </div>
            </div>

            <div class="w-full max-w-md space-y-6 rounded-3xl bg-white/5 p-6 text-sm text-slate-100 shadow-xl backdrop-blur-2xl lg:max-w-[380px]">
                <div class="flex items-center justify-between">
                    <p class="text-xs uppercase tracking-[0.4em] text-slate-400">Visão rápida</p>
                    <span class="rounded-full border border-white/20 px-3 py-1 text-[11px] font-semibold text-slate-200">mobile</span>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-sm text-slate-300">
                        <span>Links criados</span>
                        <span class="text-white">1.2k</span>
                    </div>
                    <div class="h-2 rounded-full bg-white/10">
                        <div class="h-full w-3/4 rounded-full bg-sky-500"></div>
                    </div>
                </div>
                <div class="space-y-4 pt-2 text-sm">
                    <p class="font-semibold text-white">Design adaptável</p>
                    <p class="text-slate-400">
                        Componentes deslizam sem esforço entre o modo retrato e paisagem do celular, mantendo botões grandes e áreas touch-friendly.
                    </p>
                </div>
                <div class="flex items-center gap-2 text-xs text-slate-400">
                    <span class="h-2 w-2 rounded-full bg-sky-500"></span>
                    <span>Layout preparado para desktop, tablet e mobile</span>
                </div>
            </div>
        </div>

        <div class="mx-auto mt-16 grid max-w-6xl gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <div class="glass-card space-y-4">
                <div class="flex items-center justify-between text-xs font-semibold uppercase tracking-[0.4em] text-sky-400">
                    <span>Mobile</span>
                    <span>100%</span>
                </div>
                <h3 class="text-xl font-semibold text-white/90">Bloqueio visual pensado para toque</h3>
                <p class="text-sm text-slate-300">
                    Botões amplos, espaçamentos generosos e contrastes altos garantem acessibilidade em telas pequenas.
                </p>
            </div>
            <div class="glass-card space-y-4">
                <div class="flex items-center justify-between text-xs font-semibold uppercase tracking-[0.4em] text-sky-400">
                    <span>Desktop</span>
                    <span>Pixel perfect</span>
                </div>
                <h3 class="text-xl font-semibold text-white/90">Grade fluida</h3>
                <p class="text-sm text-slate-300">
                    Layout em duas colunas que expande em desktops, com cards alinhados e animação suave de hover em links.
                </p>
            </div>
            <div class="glass-card space-y-4">
                <div class="flex items-center justify-between text-xs font-semibold uppercase tracking-[0.4em] text-sky-400">
                    <span>Performance</span>
                    <span>Leve</span>
                </div>
                <h3 class="text-xl font-semibold text-white/90">Assets otimizados</h3>
                <p class="text-sm text-slate-300">
                    CSS modular, imagens vetoriais e carregamento rápido para quem acessa por 4G ou redes limitadas.
                </p>
            </div>
            <div class="glass-card space-y-4">
                <div class="flex items-center justify-between text-xs font-semibold uppercase tracking-[0.4em] text-sky-400">
                    <span>Suporte</span>
                    <span>24/7</span>
                </div>
                <h3 class="text-xl font-semibold text-white/90">Central com métricas</h3>
                <p class="text-sm text-slate-300">
                    Dashboard responsivo mostra cliques por região, tempo médio e dispositivos mais usados.
                </p>
            </div>
        </div>
    </div>
@endsection
