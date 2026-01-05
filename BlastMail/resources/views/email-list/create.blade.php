<x-layouts.app>
    <x-slot name="header">
        <x-h2>
            {{ __('Email List') }} > {{ __('Create new list') }}
        </x-h2>
    </x-slot>

    <x-card>
        <x-form :post="route('email-list.store')" has-file>
            <div class="mb-4">
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" class="mt-1 block w-full" :value="old('title')" autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div class="mb-4">
                <x-input-label for="listFile" :value="__('File List')" />
                <x-text-input id="listFile" name="listFile" class="mt-1 block w-full" type="file" accept=".csv" />
                <x-input-error :messages="$errors->get('listFile')" class="mt-2" />
            </div>
            <div class="flex items-center space-x-4">
                <x-secondary-button type="reset">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-primary-button type="submit">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </x-form>
    </x-card>
</x-layouts.app>