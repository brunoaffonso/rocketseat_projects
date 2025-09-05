<div class="mx-auto max-w-screen-sm px-6 py-10">
    <section class="mb-6 text-center">
        <h1 class="text-2xl font-bold tracking-tight">Entrar</h1>
        <p class="text-slate-400 text-sm">Acesse sua conta para gerenciar seus livros.</p>
    </section>

    <form action="#" method="post" class="space-y-4 rounded-xl border border-slate-800 bg-slate-800/60 p-6 shadow">
        <div>
            <label for="email" class="block text-sm font-medium text-slate-300">E-mail</label>
            <input id="email" name="email" type="email" required
                class="mt-1 w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 focus:ring-offset-slate-900">
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-slate-300">Senha</label>
            <input id="password" name="password" type="password" required
                class="mt-1 w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 focus:ring-offset-slate-900">
        </div>
        <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2 text-sm text-slate-300">
                <input type="checkbox" name="remember"
                    class="size-4 rounded border-slate-700 bg-slate-900 text-emerald-500 focus:ring-emerald-400">
                Lembrar de mim
            </label>
            <a href="#" class="text-sm text-emerald-400 hover:text-emerald-300">Esqueci minha senha</a>
        </div>
        <button type="submit"
            class="w-full rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400">
            Entrar
        </button>
    </form>
</div>