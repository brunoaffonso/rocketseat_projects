<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Wise</title>
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
                <li>
                    <a href="/" aria-current="page"
                        class="text-emerald-400 hover:text-emerald-300 transition-colors">Explorar</a>
                </li>
                <li>
                    <a href="/meus-livros.php" class="text-slate-300 hover:text-white transition-colors">Meus Livros</a>
                </li>
            </ul>
            <div class="flex items-center gap-3">
                <a href="/login.php"
                    class="inline-flex items-center gap-2 rounded-md border border-slate-700 bg-slate-800 px-3 py-2 text-sm font-semibold text-slate-200 shadow-sm hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 focus:ring-offset-slate-900">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                        <path fill-rule="evenodd"
                            d="M11.078 2.25c-.917 0-1.699.663-1.85 1.57L9.05 4.5H6a.75.75 0 0 0 0 1.5h2.75l-.22 1.32H6a.75.75 0 0 0 0 1.5h2.3l-.79 4.74H4.5a.75.75 0 0 0 0 1.5h2.78l-.328 1.968a1.875 1.875 0 0 0 3.69.564l.265-1.532h4.045l-.328 1.968a1.875 1.875 0 1 0 3.69.564l.265-1.532H20a.75.75 0 0 0 0-1.5h-1.8l.79-4.74H20a.75.75 0 0 0 0-1.5h-1.55l.22-1.32H20a.75.75 0 0 0 0-1.5h-1.45l.178-1.068a1.875 1.875 0 0 0-3.693-.606L14.65 6H10.61l.178-1.068a1.875 1.875 0 0 0-1.85-2.682Zm-.727 7.77.22-1.32h4.04l-.22 1.32h-4.04Zm5.59 1.5-.79 4.74H11.11l.79-4.74h4.04Z"
                            clip-rule="evenodd" />
                    </svg>
                    Entrar
                </a>
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-screen-lg px-6 py-8">

        <?php require "views/{$view}.view.php" ?>

    </main>
</body>

</html>