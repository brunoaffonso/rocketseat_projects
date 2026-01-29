<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Campaign') }}
        </h2>
    </x-slot>

    <!-- Quill Styles -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


    <div class="py-12" x-data="campaignWizard()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card class="overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Steps Navigation -->
                    <div class="mb-8 border-b border-gray-200 dark:border-gray-700">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button @click="goToStep(1)"
                                :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': step === 1, 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300': step !== 1 }"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm w-1/3 text-center"
                                :disabled="step < 1"
                                >
                                1. Setup
                            </button>
                            <button
                                :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': step === 2, 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300': step !== 2 }"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm w-1/3 text-center"
                                :disabled="step < 2"
                                >
                                2. Email Body
                            </button>
                            <button
                                :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': step === 3, 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300': step !== 3 }"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm w-1/3 text-center"
                                :disabled="step < 3"
                                >
                                3. Schedule
                            </button>
                        </nav>
                    </div>

                    <form action="{{ route('campaigns.update', $campaign) }}" method="POST" id="campaign-form">
                        @csrf
                        @method('PUT')

                        <!-- Step 1: Setup -->
                        <div x-show="step === 1" x-transition>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="name" :value="__('Campaign Name')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" x-model="form.name" required autofocus />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <x-input-label for="subject" :value="__('Email Subject')" />
                                    <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" x-model="form.subject" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('subject')" />
                                </div>

                                <div>
                                    <x-input-label for="email_list_id" :value="__('Email List')" />
                                    <select id="email_list_id" name="email_list_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" x-model="form.email_list_id" required>
                                        <option value="">Select an Email List</option>
                                        @foreach($emailLists as $list)
                                            <option value="{{ $list->id }}">{{ $list->title }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('email_list_id')" />
                                </div>

                                <div>
                                    <x-input-label for="template_id" :value="__('Template (Optional)')" />
                                    <select id="template_id" name="template_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" x-model="form.template_id">
                                        <option value="">No Template</option>
                                        @foreach($templates as $template)
                                            <option value="{{ $template->id }}">{{ $template->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('template_id')" />
                                </div>

                                <div class="flex gap-4">
                                    <div class="block">
                                        <label for="track_click" class="inline-flex items-center">
                                            <input id="track_click" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600" name="track_click" value="1" x-model="form.track_click">
                                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Track Clicks') }}</span>
                                        </label>
                                    </div>
                                    <div class="block">
                                        <label for="track_open" class="inline-flex items-center">
                                            <input id="track_open" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600" name="track_open" value="1" x-model="form.track_open">
                                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Track Opens') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Email Body -->
                        <div x-show="step === 2" x-transition>
                             <div>
                                <x-input-label for="body" :value="__('Email Body')" />
                                <div id="editor-container" class="h-64 mt-1 bg-white dark:bg-gray-900 dark:text-gray-100"></div>
                                <input type="hidden" name="body" id="body" x-model="form.body">
                                <x-input-error class="mt-2" :messages="$errors->get('body')" />
                            </div>
                        </div>

                        <!-- Step 3: Schedule -->
                        <div x-show="step === 3" x-transition>
                            
                            <!-- Summary Config -->
                            <div class="mb-6 bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-3">{{ __('Campaign Summary') }}</h3>
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('From') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ config('mail.from.address') }}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('To') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 flex items-center gap-2">
                                            <span x-text="getListTitle(form.email_list_id)"></span>
                                            <span x-show="form.email_list_id" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                                <span x-text="getListCount(form.email_list_id)"></span>
                                                <span class="ml-1">emails</span>
                                            </span>
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Subject') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100" x-text="form.subject || 'No subject'"></dd>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Template') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                            <span x-show="form.template_id" x-text="getTemplateName(form.template_id)" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300"></span>
                                            <span x-show="!form.template_id">None</span>
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            <hr class="my-6 border-gray-200 dark:border-gray-700">

                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('Sending Options') }}</h3>
                                
                                <div class="space-y-4 mb-4">
                                    <div class="flex items-center">
                                        <input id="send_now" name="schedule_type" type="radio" value="now" x-model="form.schedule_type" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                        <label for="send_now" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            {{ __('Send Now') }}
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="send_later" name="schedule_type" type="radio" value="later" x-model="form.schedule_type" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                        <label for="send_later" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            {{ __('Send Later') }}
                                        </label>
                                    </div>
                                </div>

                                <div x-show="form.schedule_type === 'later'" x-transition>
                                    <x-input-label for="send_at" :value="__('Select Date and Time')" />
                                    <x-text-input id="send_at" name="send_at" type="datetime-local" class="mt-1 block w-full" x-model="form.send_at" />
                                    <x-input-error class="mt-2" :messages="$errors->get('send_at')" />
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Select a date and time in the future.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex justify-between mt-8">
                            <a href="{{ route('campaigns.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Cancel') }}
                            </a>
                            <div class="flex gap-2">
                                <button type="button" x-show="step > 1" @click="step--" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    {{ __('Back') }}
                                </button>
                                <button type="button" x-show="step < 3" @click="nextStep()" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    {{ __('Next') }}
                                </button>
                                <button type="submit" x-show="step === 3" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    {{ __('Update Campaign') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </x-card>
        </div>
    </div>

    <!-- Quill Script -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        function campaignWizard() {
            return {
                step: 1,
                lists: @json($emailLists->mapWithKeys(fn($item) => [$item->id => ['title' => $item->title, 'count' => $item->subscribers_count]])),
                templates: @json($templates->pluck('name', 'id')),
                form: {
                    name: '{{ old('name', $campaign->name) }}',
                    subject: '{{ old('subject', $campaign->subject) }}',
                    email_list_id: '{{ old('email_list_id', $campaign->email_list_id) }}',
                    template_id: '{{ old('template_id', $campaign->template_id) }}',
                    track_click: {{ old('track_click', $campaign->track_click) ? 'true' : 'false' }},
                    track_open: {{ old('track_open', $campaign->track_open) ? 'true' : 'false' }},
                    body: `{!! old('body', $campaign->body) !!}`,
                    schedule_type: '{{ old('schedule_type', 'later') }}',
                    send_at: '{{ old('send_at', $campaign->send_at ? $campaign->send_at->format('Y-m-d\TH:i') : '') }}'
                },
                editor: null,
                init() {
                    this.editor = new Quill('#editor-container', {
                        theme: 'snow'
                    });

                    // Sync Quill content with hidden input
                    this.editor.on('text-change', () => {
                        this.form.body = this.editor.root.innerHTML;
                        document.querySelector('#body').value = this.editor.root.innerHTML;
                    });
                    
                    if (this.form.body) {
                        this.editor.root.innerHTML = this.form.body;
                    }
                },
                 getListTitle(id) {
                    if (!id || !this.lists[id]) return 'Unknown List';
                    return this.lists[id].title;
                },
                getListCount(id) {
                    if (!id || !this.lists[id]) return 0;
                    return this.lists[id].count;
                },
                getTemplateName(id) {
                    return this.templates[id] || '';
                },
                nextStep() {
                    if (this.step === 1) {
                        if (!this.form.name || !this.form.subject || !this.form.email_list_id) {
                            alert('Please fill in all required fields.');
                            return;
                        }
                    }
                     if (this.step === 2) {
                        // Ensure body is not empty
                         if (!this.form.body || this.form.body === '<p><br></p>') {
                             alert('Please enter email body content.');
                             return;
                         }
                    }
                    this.step++;
                },
                goToStep(s) {
                   this.step = s;
                }
            }
        }
    </script>
</x-layouts.app>
