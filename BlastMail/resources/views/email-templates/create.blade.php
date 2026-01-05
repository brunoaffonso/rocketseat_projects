<x-layouts.app>
    <x-slot name="header">
        <x-h2>
            {{ __('Email Templates') }} > {{ __('Create new template') }}
        </x-h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <x-form :post="route('email-templates.store')" id="template-form">
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" class="mt-1 block w-full" :value="old('name')" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="body_editor" :value="__('Email Content (HTML)')" />
                        <div id="editor-container"
                            class="mt-1 block w-full bg-white dark:bg-gray-900 dark:text-gray-300 min-h-[300px] border-gray-300 dark:border-gray-700 rounded-md">
                            {!! old('body') !!}
                        </div>
                        <input type="hidden" name="body" id="body" value="{{ old('body') }}">
                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    </div>

                    <div class="flex items-center space-x-4">
                        <x-secondary-button type="button" onclick="history.back()">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button type="submit">
                            {{ __('Save') }}
                        </x-primary-button>
                    </div>
                </x-form>
            </x-card>
        </div>
    </div>

    @push('styles')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var quill = new Quill('#editor-container', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ 'header': [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            ['link', 'blockquote', 'code-block'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            ['clean']
                        ]
                    }
                });

                var form = document.querySelector('#template-form');
                form.onsubmit = function () {
                    var body = document.querySelector('input[name=body]');
                    body.value = quill.root.innerHTML;
                };
            });
        </script>
    @endpush
</x-layouts.app>