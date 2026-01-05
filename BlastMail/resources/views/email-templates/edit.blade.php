<x-layouts.app>
    <x-slot name="header">
        <x-h2>
            {{ __('Email Templates') }} > {{ __('Edit template') }} : {{ $emailTemplate->name }}
        </x-h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <x-form :patch="route('email-templates.update', $emailTemplate)">
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" class="mt-1 block w-full" :value="old('name', $emailTemplate->name)" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    
                    <div class="mb-4">
                        <x-input-label for="body" :value="__('Email Content (HTML)')" />
                        <textarea 
                            id="body" 
                            name="body" 
                            rows="10" 
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        >{{ old('body', $emailTemplate->body) }}</textarea>
                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    </div>

                    <div class="flex items-center space-x-4">
                        <x-secondary-button type="button" onclick="history.back()">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button type="submit">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </x-form>
            </x-card>
        </div>
    </div>
</x-layouts.app>
