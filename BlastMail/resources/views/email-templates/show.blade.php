<x-layouts.app>
    <x-slot name="header">
        <x-h2 class="mb-0">
            {{ __('Email Templates') }} > {{ __('Preview') }} : {{ $emailTemplate->name }}
        </x-h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <a href="{{ route('email-templates.index') }}"
                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Back to Templates') }}
                </a>
            </div>

            <div
                class="bg-white dark:bg-gray-900 shadow-xl rounded-lg border border-gray-200 dark:border-gray-800 overflow-hidden">
                <!-- Email Header Simulation -->
                <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50">
                    <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $emailTemplate->name }}</h1>
                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-400 flex flex-col gap-1">
                        <p><span class="font-semibold">{{ __('From') }}:</span> {{ config('app.name') }} &lt;noreply@{{
                            parse_url(config('app.url'), PHP_URL_HOST) }}&gt;</p>
                        <p><span class="font-semibold">{{ __('Subject') }}:</span> {{ $emailTemplate->name }}</p>
                    </div>
                </div>

                <!-- Email Content -->
                <div class="px-8 py-10 bg-white dark:bg-gray-900">
                    <div class="ql-editor !p-0 prose dark:prose-invert max-w-none">
                        {!! $emailTemplate->body !!}
                    </div>
                </div>

                <!-- Email Footer Simulation -->
                <div
                    class="px-8 py-6 border-t border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/50 text-center text-xs text-gray-400 dark:text-gray-500">
                    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}</p>
                    <p class="mt-2">{{ __('You received this email because you are a subscriber.') }}</p>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <style>
            /* Reset some Quill editor styles for preview */
            .ql-editor {
                height: auto;
                overflow-y: visible;
                cursor: default;
            }

            .ql-editor h1 {
                font-size: 2em;
                font-weight: bold;
                margin-bottom: 0.5em;
            }

            .ql-editor h2 {
                font-size: 1.5em;
                font-weight: bold;
                margin-bottom: 0.5em;
            }

            .ql-editor h3 {
                font-size: 1.17em;
                font-weight: bold;
                margin-bottom: 0.5em;
            }

            .ql-editor ul {
                list-style-type: disc;
                margin-left: 1.5em;
                margin-bottom: 1em;
            }

            .ql-editor ol {
                list-style-type: decimal;
                margin-left: 1.5em;
                margin-bottom: 1em;
            }

            .ql-editor blockquote {
                border-left: 4px solid #ccc;
                padding-left: 1em;
                margin-left: 0;
                font-style: italic;
            }
        </style>
    @endpush
</x-layouts.app>