<section class="mb-6">
    <h1 class="text-2xl font-bold tracking-tight">Explorar</h1>
</section>
<form action="#" method="get" class="mb-8">
    <label for="q" class="sr-only">Buscar livros</label>
    <div class="relative max-w-xl">
        <span class="pointer-events-none absolute inset-y-0 left-3 inline-flex items-center text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                <path fill-rule="evenodd"
                    d="M10.5 3.75a6.75 6.75 0 1 0 4.096 12.164l3.245 3.245a.75.75 0 1 0 1.06-1.06l-3.245-3.245A6.75 6.75 0 0 0 10.5 3.75Zm-5.25 6.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Z"
                    clip-rule="evenodd" />
            </svg>
        </span>
        <input id="q" name="q" type="search" placeholder="Buscar livros..."
            class="w-full rounded-lg border border-slate-700 bg-slate-800 pl-10 pr-28 py-2.5 text-sm placeholder:text-slate-500 shadow-inner focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 focus:ring-offset-slate-900" />
        <button type="submit"
            class="absolute right-1 top-1/2 -translate-y-1/2 rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-semibold text-white shadow hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400">
            Buscar
        </button>
    </div>
</form>

<section aria-labelledby="destaques-title" class="space-y-4">
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

        <?php foreach ($livros as $livro): ?>
        <div
            class="group rounded-xl border border-slate-800 bg-slate-800 p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="flex gap-4">
                <div class="relative h-28 w-20 shrink-0 overflow-hidden rounded-md ring-1 ring-slate-700">
                    <img src="<?= $livro->imagem ?>" alt="Capa do livro Clean Code" loading="lazy"
                        class="h-full w-full object-cover" />
                </div>
                <div class="min-w-0">
                    <h3 class="truncate font-semibold group-hover:text-white">
                        <a href="/livro?id=<?= $livro->id ?>" rel="noopener noreferrer"
                            class="hover:underline focus:underline"><?= $livro->titulo ?>
                        </a>
                    </h3>
                    </h3>
                    <p class="text-sm text-slate-400"><?= $livro->autor ?></p>
                    <div class="mt-2 flex items-center gap-1 text-amber-400">
                        <span>★ ★ ★ ★ ☆</span>
                        <span class="sr-only">4 de 5</span>
                    </div>
                    <p class="mt-2 text-sm text-slate-400">
                        <?= $livro->descricao ?>
                    </p>
                    <!-- <div class="mt-3 flex flex-wrap gap-2 text-[10px] text-slate-300">
                        <span class="rounded-full bg-slate-700/60 px-2 py-0.5">Programação</span>
                        <span class="rounded-full bg-slate-700/60 px-2 py-0.5">Boas práticas</span>
                    </div> -->
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
    </div>
</section>