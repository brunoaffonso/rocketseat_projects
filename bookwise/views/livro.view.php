<?= $livro->titulo ?>
<div
    class="group mx-auto w-full max-w-5xl rounded-xl border border-slate-800 bg-slate-800 p-6 md:p-8 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
    <div class="flex flex-col gap-6 md:flex-row md:gap-8">
        <div
            class="relative h-72 w-48 md:h-96 md:w-64 lg:h-[28rem] lg:w-80 shrink-0 overflow-hidden rounded-md ring-1 ring-slate-700">
            <img src="<?= $livro->imagem ?>" alt="Capa do livro" loading="lazy" class="h-full w-full object-cover" />
        </div>
        <div class="min-w-0 flex-1">
            <h3 class="truncate font-semibold text-2xl md:text-3xl group-hover:text-white">
                <a href="/livro?id=<?= $livro->id ?>" rel="noopener noreferrer" class="hover:underline focus:underline">
                    <?= $livro->titulo ?>
                </a>
            </h3>
            <p class="text-base md:text-lg text-slate-400"><?= $livro->autor ?></p>
            <div class="mt-3 flex items-center gap-1 text-amber-400">
                <span>★ ★ ★ ★ ☆</span>
                <span class="sr-only">4 de 5</span>
            </div>
            <p class="mt-4 text-base md:text-lg text-slate-300">
                <?= $livro->descricao ?>
            </p>
        </div>
    </div>
</div>
<div class="flex flex-col sm:flex-row gap-4 justify-start p-4">
    <a href="/"
        class="inline-flex items-center justify-center gap-2 rounded-md bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 focus:ring-offset-slate-900 transition">
        Voltar para início
    </a>
</div>