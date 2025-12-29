<x-layouts.app>
    <x-slot name="header">
        <x-h2>
            {{ __('Email List') }}
        </x-h2>
    </x-slot>

    <x-card>
        <div class="flex justify-center">
            <x-link-button href="{{ route('email-list.create') }}">
                {{ __('Create Email List') }}
            </x-link-button>
        </div>
        @forelse ($emailLists as $emailList)
            <div class="flex justify-between">
                <p>{{ $emailList->title }}</p>
            </div>
        @empty
            <div class="flex justify-center">
                <x-link-button href="{{ route('email-list.create') }}">
                    {{ __('Create Email List') }}
                </x-link-button>
            </div>
        @endforelse
    </x-card>
</x-layouts.app>
