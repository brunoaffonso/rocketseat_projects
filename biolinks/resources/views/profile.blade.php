@extends('layouts.app')

@section('content')
    <div class="min-h-[90vh] px-4 py-12 sm:px-6 lg:px-12">
        <div class="mx-auto max-w-2xl space-y-8">
            <!-- Header -->
            <div class="space-y-2">
                <p class="text-xs font-semibold uppercase tracking-[0.6em] text-sky-400">Perfil</p>
                <h1 class="text-3xl font-semibold text-white/90 sm:text-4xl">Editar seu perfil</h1>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('profile') }}" class="glass-card" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex items-center gap-6 pb-6 border-b border-white/5 mb-6">
                    <div class="relative group">
                        <label for="photo" class="cursor-pointer">
                            <div id="photo-preview-container"
                                class="size-24 rounded-full overflow-hidden border-2 border-white/10 group-hover:border-sky-400 transition bg-white/5 flex items-center justify-center">
                                @if ($user->photo)
                                    <img id="photo-preview" src="storage/{{ $user->photo }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div id="photo-placeholder" class="flex items-center justify-center">
                                        <svg class="size-10 text-white/20 group-hover:text-sky-400 transition"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                                        </svg>
                                    </div>
                                    <img id="photo-preview" class="w-full h-full object-cover hidden">
                                @endif
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 size-8 rounded-full bg-sky-500 flex items-center justify-center text-white shadow-lg group-hover:bg-sky-400 transition">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                        </label>
                        <input type="file" name="photo" id="photo" class="hidden" accept="image/*">
                    </div>
                    <div class="space-y-1">
                        <label for="photo" class="text-sm font-semibold text-white/90 cursor-pointer">Foto de
                            perfil</label>
                        <p class="text-xs text-slate-400">JPG, PNG ou GIF. Máximo 2MB.</p>
                        @error('photo')
                            <p class="text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">
                            Nome
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}"
                            class="form-input" placeholder="Seu nome" required>
                        @error('name')
                            <p class="text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="handler" class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">
                            Handler
                        </label>
                        <div class="flex items-center">
                            <span
                                class="rounded-l-2xl border border-r-0 border-white/10 bg-white/10 px-4 py-3 text-base text-slate-400">
                                biolinks.com.br/@
                            </span>
                            <input type="text" id="handler" name="handler"
                                value="{{ old('handler', $user->handler ?? '') }}"
                                class="form-input rounded-l-none border-l-0" placeholder="seulink" required>
                        </div>
                        @error('handler')
                            <p class="text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">
                            Sobre
                        </label>
                        <textarea id="description" name="description" rows="4" class="form-input resize-none"
                            placeholder="Conte um pouco sobre você..." required>{{ old('description', $user->description ?? '') }}</textarea>
                        @error('description')
                            <p class="text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="form-button">
                            Atualizar
                        </button>
                        <a href="{{ route('dashboard') }}"
                            class="flex-1 rounded-2xl border border-white/20 px-6 py-3 text-center text-base font-semibold text-white/90 transition hover:border-sky-400 hover:text-sky-400">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('photo-preview');
                    const placeholder = document.getElementById('photo-placeholder');

                    preview.src = e.target.result;
                    preview.classList.remove('hidden');

                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
