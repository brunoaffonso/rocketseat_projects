<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Livros — Book Wise</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-slate-900 text-slate-200 antialiased">
    <header class="sticky top-0 z-20 bg-slate-900/80 backdrop-blur border-b border-slate-800">
        <nav class="mx-auto max-w-screen-lg flex items-center justify-between px-6 py-4">
            <a href="/" class="flex items-center gap-2">
                <span
                    class="inline-flex size-8 items-center justify-center rounded-md bg-emerald-500/10 text-emerald-400 ring-1 ring-inset ring-emerald-500/20">📚</span>
                <span class="font-extrabold tracking-tight">Book Wise</span>
            </a>
            <ul class="hidden md:flex items-center gap-6 font-medium">
                <li><a href="/" class="text-slate-300 hover:text-white transition-colors">Explorar</a></li>
                <li><a href="/meus-livros.php" class="text-emerald-400 hover:text-emerald-300 transition-colors">Meus
                        Livros</a></li>
            </ul>
            <div class="flex items-center gap-3">
                <a href="/login.php"
                    class="inline-flex items-center gap-2 rounded-md border border-slate-700 bg-slate-800 px-3 py-2 text-sm font-semibold text-slate-200 shadow-sm hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 focus:ring-offset-slate-900">Entrar</a>
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-screen-lg px-6 py-8">
        <section class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight">Meus Livros</h1>
            <p class="text-slate-400 text-sm">Acompanhe seus livros lidos e favoritos.</p>
        </section>

        <section class="rounded-xl border border-slate-800 bg-slate-800/50 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">Biblioteca</h2>
                <a href="#" class="text-sm text-emerald-400 hover:text-emerald-300">Adicionar livro</a>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <article class="col-span-full text-center text-slate-400">
                    <div
                        class="mx-auto mb-2 size-12 rounded-full bg-slate-800 ring-1 ring-slate-700 flex items-center justify-center">
                        📖</div>
                    <p>Nenhum livro adicionado ainda.</p>
                </article>
            </div>
        </section>
    </main>
</body>

</html>