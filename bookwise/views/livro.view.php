<div
    class="group rounded-xl border border-slate-800 bg-slate-800 p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
    <div class="flex gap-4">
        <div class="relative h-28 w-20 shrink-0 overflow-hidden rounded-md ring-1 ring-slate-700">
            <img src="<?= $livro['imagem'] ?>" alt="Capa do livro Clean Code" loading="lazy"
                class="h-full w-full object-cover" />
        </div>
        <div class="min-w-0">
            <h3 class="truncate font-semibold group-hover:text-white">
                <a href="/livro.php?id=<?= $livro['id'] ?>" rel="noopener noreferrer"
                    class="hover:underline focus:underline"><?= $livro['titulo'] ?>
                </a>
            </h3>
            </h3>
            <p class="text-sm text-slate-400"><?= $livro['autor'] ?></p>
            <div class="mt-2 flex items-center gap-1 text-amber-400">
                <span>★ ★ ★ ★ ☆</span>
                <span class="sr-only">4 de 5</span>
            </div>
            <p class="mt-2 text-sm text-slate-400">
                <?= $livro['descricao'] ?>
            </p>
            <!-- <div class="mt-3 flex flex-wrap gap-2 text-[10px] text-slate-300">
                                <span class="rounded-full bg-slate-700/60 px-2 py-0.5">Programação</span>
                                <span class="rounded-full bg-slate-700/60 px-2 py-0.5">Boas práticas</span>
                            </div> -->
        </div>
    </div>
</div>