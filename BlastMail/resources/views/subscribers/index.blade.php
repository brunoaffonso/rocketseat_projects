<x-layouts.app>
    <x-slot name="header">
        <x-h2 class="mb-0">
            {{ $emailList->title }} - {{ __('Subscribers') }}
        </x-h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-card class="p-0 overflow-hidden">
                <div class="p-4 bg-gray-50 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="flex gap-2">
                            <a href="{{ route('email-list.index') }}">
                                <x-secondary-button type="button">
                                    {{ __('Back to Lists') }}
                                </x-secondary-button>
                            </a>
                            <a href="{{ route('subscribers.create', $emailList) }}">
                                <x-primary-button type="button">
                                    {{ __('Add Subscriber') }}
                                </x-primary-button>
                            </a>
                        </div>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" 
                                name="show_deleted" 
                                value="1" 
                                {{ request('show_deleted') ? 'checked' : '' }}
                                onchange="this.form.submit()"
                                form="search-form"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            >
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Show Deleted') }}</span>
                        </label>
                    </div>

                    <form 
                        id="search-form"
                        x-data="{ 
                            search: '{{ request('search') }}',
                            submit() {
                                if (this.search.length === 0 || this.search.length >= 3) {
                                    $el.requestSubmit();
                                }
                            }
                        }"
                        action="{{ route('subscribers.index', $emailList) }}" 
                        method="GET" 
                        class="w-full max-w-md relative"
                    >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input 
                            name="search" 
                            x-model="search"
                            x-on:input.debounce.500ms="submit"
                            placeholder="{{ __('Search by name or email...') }}" 
                            class="w-full pl-10"
                        />
                    </form>
                </div>

                <x-table>
                    <x-table.thead>
                        <x-table.tr>
                            <x-table.th>{{ __('Name') }}</x-table.th>
                            <x-table.th>{{ __('Email') }}</x-table.th>
                            <x-table.th>{{ __('Created At') }}</x-table.th>
                            <x-table.th class="text-right">{{ __('Actions') }}</x-table.th>
                        </x-table.tr>
                    </x-table.thead>
                    <x-table.tbody>
                        @forelse ($subscribers as $subscriber)
                            <x-table.tr>
                                <x-table.td>{{ $subscriber->name }}</x-table.td>
                                <x-table.td>{{ $subscriber->email }}</x-table.td>
                                <x-table.td>{{ $subscriber->created_at->format('d/m/Y H:i') }}</x-table.td>
                                <x-table.td class="text-right">
                                    @if($subscriber->trashed())
                                        <x-danger-button type="button" disabled class="opacity-50 cursor-not-allowed">
                                            {{ __('Deleted') }}
                                        </x-danger-button>
                                    @else
                                        <form action="{{ route('subscribers.destroy', [$emailList, $subscriber]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit" onclick="return confirm('{{ __('Are you sure you want to delete this subscriber?') }}')">
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </form>
                                    @endif
                                </x-table.td>
                            </x-table.tr>
                        @empty
                            <x-table.tr>
                                <x-table.td colspan="4" class="text-center py-8 text-gray-500">
                                    {{ __('No subscribers found.') }}
                                </x-table.td>
                            </x-table.tr>
                        @endforelse
                    </x-table.tbody>
                </x-table>
            </x-card>

            <div class="mt-4">
                {{ $subscribers->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
