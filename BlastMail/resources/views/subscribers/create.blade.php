<x-layouts.app>
    <x-slot name="header">
        <x-h2 class="mb-0">
            {{ $emailList->title }} - {{ __('Add Subscriber') }}
        </x-h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <x-form :post="route('subscribers.store', $emailList)">
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Add Subscriber') }}</x-primary-button>
                            <a href="{{ route('subscribers.index', $emailList) }}">
                                <x-secondary-button type="button">{{ __('Cancel') }}</x-secondary-button>
                            </a>
                        </div>
                    </div>
                </x-form>
            </x-card>
        </div>
    </div>
</x-layouts.app>
