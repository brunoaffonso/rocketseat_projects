<x-layouts.app>
    <x-slot name="header">
        <x-h2 class="mb-0">
            {{ __('My Lists') }}
        </x-h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-card class="p-0 overflow-hidden">
                <div class="p-4 bg-gray-50 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 flex justify-between items-center">
                    <x-link-button href="{{ route('email-list.create') }}">
                        {{ __('Create Email List') }}
                    </x-link-button>

                    <form 
                        x-data="{ 
                            search: '{{ request('search') }}',
                            submit() {
                                if (this.search.length === 0 || this.search.length >= 3) {
                                    $el.requestSubmit();
                                }
                            }
                        }"
                        action="{{ route('email-list.index') }}" 
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
                            placeholder="{{ __('Search by title...') }}" 
                            class="w-full pl-10"
                        />
                    </form>
                </div>

                <x-table>
                <x-table.thead>
                    <x-table.tr>
                        <x-table.th>{{ __('Title') }}</x-table.th>
                        <x-table.th>{{ __('Subscribers') }}</x-table.th>
                        <x-table.th>{{ __('Created At') }}</x-table.th>
                        <x-table.th class="text-right">{{ __('Actions') }}</x-table.th>
                    </x-table.tr>
                </x-table.thead>
                <x-table.tbody>
                    @forelse ($emailLists as $emailList)
                        <x-table.tr>
                            <x-table.td>{{ $emailList->title }}</x-table.td>
                            <x-table.td>{{ $emailList->subscribers_count }}</x-table.td>
                            <x-table.td>{{ $emailList->created_at->format('d/m/Y H:i') }}</x-table.td>
                            <x-table.td class="text-right">
                                <a href="{{ route('subscribers.index', $emailList) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                    {{ __('View Subscribers') }}
                                </a>
                            </x-table.td>
                        </x-table.tr>
                    @empty
                        <x-table.tr>
                            <x-table.td colspan="4" class="text-center py-8 text-gray-500">
                                {{ __('No email lists found.') }}
                            </x-table.td>
                        </x-table.tr>
                    @endforelse
                </x-table.tbody>
            </x-table>
        </x-card>

        <div class="mt-4">
            {{ $emailLists->links() }}
        </div>
        </div>
    </div>
</x-layouts.app>
